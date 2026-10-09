<?php

namespace App\Http\Controllers;

use App\Models\BdDistrict;
use App\Models\BdDivision;
use App\Models\BdUpazila;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    private const SHIPPING_CHARGE = 100;

    /**
     * Display the checkout page.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return (float) $item['price']
                * (int) $item['quantity'];
        });

        $shippingCharge = self::SHIPPING_CHARGE;
        // $total = $subtotal + $shippingCharge;

        $coupon = null; 
        $discountAmount = 0; 
        
        $couponCode = $request->session()->get('coupon_code');

        if ($couponCode) { 
            $coupon = Coupon::query() ->validNow() ->where('code', $couponCode) ->first(); 
            if ( !$coupon || $subtotal < (float) $coupon->minimum_order ) { 
                $request->session()->forget('coupon_code'); $coupon = null; 
            } else { 
                $discountAmount = $coupon->calculateDiscount( (float) $subtotal ); 
            } 
        }

        $total = max( 0, $subtotal + $shippingCharge - $discountAmount );

        return view('checkout.index', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shippingCharge' => $shippingCharge,
            'total' => $total,
            'coupon' => $coupon,
            'discountAmount' => $discountAmount,
        ]);
    }

    /**
     * Create a new order from the current cart.
     */
    public function store(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validate checkout information
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                'regex:/^(01[3-9]\d{8})$/',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'division_id' => [
                'required',
                'integer',
                'exists:bd_divisions,id',
            ],

            'district_id' => [
                'required',
                'integer',
                'exists:bd_districts,id',
            ],

            'upazila_id' => [
                'required',
                'integer',
                'exists:bd_upazilas,id',
            ],

            'address' => [
                'required',
                'string',
                'max:1000',
            ],

            'delivery_note' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'payment_method' => [
                'required',
                'in:cod',
            ],
        ], [
            'phone.regex' =>
                'Please enter a valid Bangladesh mobile number, for example 01712345678.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Bangladesh location hierarchy
        |--------------------------------------------------------------------------
        |
        | The normal "exists" validation only checks whether the IDs exist.
        | These additional queries make sure:
        |
        | Division
        |    ↓
        | District belongs to Division
        |    ↓
        | Upazila belongs to District
        |
        |--------------------------------------------------------------------------
        */
        $division = BdDivision::query()
            ->where('id', $validated['division_id'])
            ->where('is_active', true)
            ->firstOrFail();

        $district = BdDistrict::query()
            ->where('id', $validated['district_id'])
            ->where('division_id', $division->id)
            ->where('is_active', true)
            ->firstOrFail();

        $upazila = BdUpazila::query()
            ->where('id', $validated['upazila_id'])
            ->where('district_id', $district->id)
            ->where('is_active', true)
            ->firstOrFail();

        $couponCode = $request->session()->get('coupon_code');

        try {
            $order = DB::transaction(function () use (
                $cart,
                $validated,
                $division,
                $district,
                $upazila,
                $couponCode
            ) {
                /*
                |--------------------------------------------------------------------------
                | Calculate subtotal from cart
                |--------------------------------------------------------------------------
                */
                $subtotal = 0;

                foreach ($cart as $item) {
                    $subtotal +=
                        (float) $item['price']
                        * (int) $item['quantity'];
                }

                $shippingCharge = self::SHIPPING_CHARGE;

                $coupon = null;
                $discountAmount = 0;

                if ($couponCode) {
                    $coupon = Coupon::query()
                        ->validNow()
                        ->where('code', $couponCode)
                        ->first();

                    if (!$coupon) {
                        throw new \RuntimeException(
                            'Your coupon is no longer valid. Please apply it again.'
                        );
                    }

                    if ($subtotal < (float) $coupon->minimum_order) {
                        throw new \RuntimeException(
                            'Your order no longer meets the minimum amount for this coupon.'
                        );
                    }

                    $discountAmount = $coupon->calculateDiscount(
                        (float) $subtotal
                    );
                }

                $total = max(0, $subtotal + $shippingCharge - $discountAmount);



                /*
                |--------------------------------------------------------------------------
                | Create order
                |--------------------------------------------------------------------------
                */
                $order = Order::create([
                    'user_id' => auth()->id(),

                    'order_number' => $this->generateOrderNumber(),

                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'email' => $validated['email'] ?? null,

                    'division' => $division->name,
                    'district' => $district->name,
                    'upazila' => $upazila->name,
                    'address' => $validated['address'],

                    'delivery_note' =>
                        $validated['delivery_note'] ?? null,

                    'subtotal' => $subtotal,

                    'shipping_charge' => $shippingCharge,

                    'total' => $total,

                    'payment_method' => 'cod',

                    'payment_status' => 'pending',

                    'order_status' => 'pending',
                    'coupon_id' => $coupon?->id,
                    'coupon_code' => $coupon?->code,
                    'discount_amount' => $discountAmount,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Create order items and reduce stock
                |--------------------------------------------------------------------------
                */
                foreach ($cart as $item) {
                    $quantity = (int) $item['quantity'];

                    if ($quantity <= 0) {
                        throw new \RuntimeException(
                            'Invalid product quantity.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Lock product row
                    |--------------------------------------------------------------------------
                    */
                    $product = Product::query()
                        ->lockForUpdate()
                        ->find($item['product_id']);

                    if (!$product || !$product->is_active) {
                        throw new \RuntimeException(
                            'A product in your cart is no longer available.'
                        );
                    }

                    $variant = null;

                    /*
                    |--------------------------------------------------------------------------
                    | Variant product
                    |--------------------------------------------------------------------------
                    */
                    if (!empty($item['variant_id'])) {
                        $variant = ProductVariant::query()
                            ->lockForUpdate()
                            ->where('id', $item['variant_id'])
                            ->where('product_id', $product->id)
                            ->first();

                        if (!$variant || !$variant->is_active) {
                            throw new \RuntimeException(
                                "The selected option for {$product->name} is no longer available."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Validate variant stock
                        |--------------------------------------------------------------------------
                        */
                        if ($variant->stock < $quantity) {
                            throw new \RuntimeException(
                                "Insufficient stock for {$product->name}."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Validate current variant price
                        |--------------------------------------------------------------------------
                        |
                        | The cart price should not be trusted blindly because
                        | the product price may have changed after the item
                        | was added to the cart.
                        |
                        |--------------------------------------------------------------------------
                        */
                        $currentPrice = (float) $variant->price;
                        $cartPrice = (float) $item['price'];

                        if (abs($currentPrice - $cartPrice) > 0.001) {
                            throw new \RuntimeException(
                                "The price of {$product->name} has changed. Please review your cart before placing the order."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Reduce variant stock
                        |--------------------------------------------------------------------------
                        */
                        $variant->decrement(
                            'stock',
                            $quantity
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Product without variant
                    |--------------------------------------------------------------------------
                    */
                    else {
                        if ($product->stock < $quantity) {
                            throw new \RuntimeException(
                                "Insufficient stock for {$product->name}."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Validate current product price
                        |--------------------------------------------------------------------------
                        */
                        $currentPrice = (float) $product->selling_price;
                        $cartPrice = (float) $item['price'];

                        if (abs($currentPrice - $cartPrice) > 0.001) {
                            throw new \RuntimeException(
                                "The price of {$product->name} has changed. Please review your cart before placing the order."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Reduce product stock
                        |--------------------------------------------------------------------------
                        */
                        $product->decrement(
                            'stock',
                            $quantity
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Create order item
                    |--------------------------------------------------------------------------
                    */
                    OrderItem::create([
                        'order_id' => $order->id,

                        'product_id' => $product->id,

                        'product_variant_id' =>
                            $variant?->id,

                        'product_name' =>
                            $product->name,

                        'variant_name' =>
                            $variant?->name,

                        'sku' =>
                            $variant?->sku
                            ?? $product->sku,

                        'unit_price' =>
                            (float) $item['price'],

                        'quantity' => $quantity,

                        'subtotal' =>
                            (float) $item['price']
                            * $quantity,
                    ]);
                }

                return $order;
            });

            /*
            |--------------------------------------------------------------------------
            | Clear cart only after successful transaction
            |--------------------------------------------------------------------------
            */
            $request->session()->forget('cart');
            $request->session()->forget(['cart', 'coupon_code',]);

            return redirect()
                ->route(
                    'checkout.success', ['order' => $order->id]
                    // $order
                )
                ->with(
                    'success',
                    'Your order has been placed successfully.'
                );
        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /**
     * Display order success page.
     */
    public function success(Order $order): View
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load('items');

        return view(
            'checkout.success',
            compact('order')
        );
    }

    /**
     * Generate a unique SleepMart order number.
     */
    private function generateOrderNumber(): string
    {
        do {
            $number =
                'SM-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(
                    Str::random(6)
                );
        } while (
            Order::where(
                'order_number',
                $number
            )->exists()
        );

        return $number;
    }


    public function applyCoupon(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'coupon_code' => [
                'required',
                'string',
                'max:50',
            ],
        ]);

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (int) $item['quantity'];
        });

        $code = strtoupper(trim($validated['coupon_code']));

        $coupon = Coupon::query()
            ->validNow()
            ->where('code', $code)
            ->first();

        if (!$coupon) {
            return back()->withErrors([
                'coupon_code' => 'This coupon is invalid, inactive, or expired.',
            ])->withInput();
        }

        if ($subtotal < (float) $coupon->minimum_order) {
            return back()->withErrors([
                'coupon_code' => 'Your order must be at least ৳'
                    . number_format((float) $coupon->minimum_order, 2)
                    . ' to use this coupon.',
            ])->withInput();
        }

        $discount = $coupon->calculateDiscount((float) $subtotal);

        if ($discount <= 0) {
            return back()->withErrors([
                'coupon_code' => 'This coupon cannot be applied to your order.',
            ])->withInput();
        }

        $request->session()->put('coupon_code', $coupon->code);

        return redirect()
            ->route('checkout.index')
            ->with('success', 'Coupon ' . $coupon->code . ' applied successfully.');
    }

    public function removeCoupon(Request $request): RedirectResponse
    {
        $request->session()->forget('coupon_code');

        return redirect()
            ->route('checkout.index')
            ->with('success', 'Coupon removed.');
    }

}
