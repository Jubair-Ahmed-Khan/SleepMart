<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

use App\Models\BdDistrict;
use App\Models\BdDivision;
use App\Models\BdUpazila;

class CheckoutController extends Controller
{
    private const SHIPPING_CHARGE = 100;

    public function index(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (int) $item['quantity'];
        });

        $shippingCharge = self::SHIPPING_CHARGE;
        $total = $subtotal + $shippingCharge;

        return view('checkout.index', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shippingCharge' => $shippingCharge,
            'total' => $total,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

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

        try {
            $order = DB::transaction(function () use (
                $cart,
                $validated,
                $division,
                $district,
                $upazila
            ) {
                $subtotal = 0;

                foreach ($cart as $item) {
                    $subtotal +=
                        (float) $item['price']
                        * (int) $item['quantity'];
                }

                $shippingCharge = self::SHIPPING_CHARGE;

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
                    'total' => $subtotal + $shippingCharge,

                    'payment_method' => 'cod',
                    'payment_status' => 'pending',
                    'order_status' => 'pending',
                ]);

                foreach ($cart as $item) {
                    $quantity = (int) $item['quantity'];

                    $product = Product::query()
                        ->lockForUpdate()
                        ->find($item['product_id']);

                    if (!$product) {
                        throw new \RuntimeException(
                            'A product in your cart is no longer available.'
                        );
                    }

                    $variant = null;

                    if (!empty($item['variant_id'])) {
                        $variant = ProductVariant::query()
                            ->lockForUpdate()
                            ->find($item['variant_id']);

                        if (!$variant) {
                            throw new \RuntimeException(
                                'A selected product option is no longer available.'
                            );
                        }

                        if (
                            !$variant->is_active ||
                            $variant->stock < $quantity
                        ) {
                            throw new \RuntimeException(
                                "Insufficient stock for {$product->name}."
                            );
                        }

                        $variant->decrement('stock', $quantity);
                    } else {
                        if ($product->stock < $quantity) {
                            throw new \RuntimeException(
                                "Insufficient stock for {$product->name}."
                            );
                        }

                        $product->decrement('stock', $quantity);
                    }

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
                            $variant?->sku ?? $product->sku,

                        'unit_price' =>
                            (float) $item['price'],

                        'quantity' => $quantity,

                        'subtotal' =>
                            (float) $item['price'] * $quantity,
                    ]);
                }

                return $order;
            });

            $request->session()->forget('cart');

            return redirect()
                ->route(
                    'checkout.success',
                    $order
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
}