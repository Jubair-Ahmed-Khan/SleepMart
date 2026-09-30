<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display cart.
     */
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $deliveryCharge = $subtotal > 0 ? 100 : 0;

        $grandTotal = $subtotal + $deliveryCharge;

        return view('cart.index', compact(
            'cart',
            'subtotal',
            'deliveryCharge',
            'grandTotal'
        ));
    }

    /**
     * Add product to cart.
     */
    public function add(
        Request $request,
        Product $product
    ): RedirectResponse {
        abort_unless($product->is_active, 404);

        $request->validate([
            'variant_id' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $quantity = (int) $request->quantity;

        $variant = null;

        if ($request->filled('variant_id')) {
            $variant = ProductVariant::query()
                ->where('product_id', $product->id)
                ->where('id', $request->variant_id)
                ->where('is_active', true)
                ->firstOrFail();
        }

        $price = $variant
            ? (float) $variant->price
            : (float) $product->selling_price;

        $stock = $variant
            ? $variant->stock
            : $product->stock;

        if ($stock <= 0) {
            return back()->with(
                'error',
                'This product is currently out of stock.'
            );
        }

        if ($quantity > $stock) {
            return back()->with(
                'error',
                "Only {$stock} item(s) are available."
            );
        }

        $cart = $request->session()->get('cart', []);

        $cartKey = $variant
            ? $product->id . '_' . $variant->id
            : $product->id . '_default';

        if (isset($cart[$cartKey])) {

            $newQuantity =
                $cart[$cartKey]['quantity'] + $quantity;

            if ($newQuantity > $stock) {
                return back()->with(
                    'error',
                    "Only {$stock} item(s) are available."
                );
            }

            $cart[$cartKey]['quantity'] = $newQuantity;

        } else {

            $cart[$cartKey] = [
                'product_id' => $product->id,
                'product_slug' => $product->slug,

                'variant_id' => $variant?->id,

                'name' => $product->name,

                'variant_name' => $variant?->name,

                'size' => $variant?->size,

                'thickness' => $variant?->thickness,

                'price' => $price,

                'quantity' => $quantity,

                'stock' => $stock,

                'thumbnail' => $product->thumbnail,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product added to your cart successfully.'
            );
    }

    /**
     * Update cart item quantity.
     */
    public function update(
        Request $request,
        string $cartKey
    ): RedirectResponse {
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:20',
            ],
        ]);

        $cart = $request->session()->get('cart', []);

        if (!isset($cart[$cartKey])) {
            return back()->with(
                'error',
                'Cart item not found.'
            );
        }

        $item = $cart[$cartKey];

        $quantity = (int) $request->quantity;

        /*
        |--------------------------------------------------------------------------
        | Check latest stock
        |--------------------------------------------------------------------------
        */

        if ($item['variant_id']) {
            $stock = ProductVariant::query()
                ->where('id', $item['variant_id'])
                ->where('product_id', $item['product_id'])
                ->where('is_active', true)
                ->value('stock');
        } else {
            $stock = Product::query()
                ->where('id', $item['product_id'])
                ->where('is_active', true)
                ->value('stock');
        }

        if ($stock === null || $stock <= 0) {
            unset($cart[$cartKey]);

            $request->session()->put('cart', $cart);

            return back()->with(
                'error',
                'This product is no longer available.'
            );
        }

        if ($quantity > $stock) {
            return back()->with(
                'error',
                "Only {$stock} item(s) are available."
            );
        }

        $cart[$cartKey]['quantity'] = $quantity;
        $cart[$cartKey]['stock'] = $stock;

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Cart updated successfully.'
        );
    }

    /**
     * Remove item from cart.
     */
    public function remove(
        Request $request,
        string $cartKey
    ): RedirectResponse {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
        }

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Item removed from cart.'
        );
    }

    /**
     * Clear entire cart.
     */
    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Your cart has been cleared.'
            );
    }
}