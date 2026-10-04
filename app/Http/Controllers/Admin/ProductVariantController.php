<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductVariantController extends Controller
{
    /**
     * List variants.
     */
    public function index(Product $product): View
    {
        $variants = $product
            ->variants()
            ->latest()
            ->get();

        return view(
            'admin.products.variants.index',
            compact(
                'product',
                'variants'
            )
        );
    }


    /**
     * Store variant.
     */
    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
                'unique:product_variants,sku',
            ],

            'size' => [
                'nullable',
                'string',
                'max:100',
            ],

            'thickness' => [
                'nullable',
                'string',
                'max:100',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $product->variants()->create([
            'name' => $validated['name'],

            'sku' =>
                $validated['sku'] ?? null,

            'size' =>
                $validated['size'] ?? null,

            'thickness' =>
                $validated['thickness'] ?? null,

            'price' =>
                $validated['price'],

            'stock' =>
                $validated['stock'],

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        return back()->with(
            'success',
            'Variant added successfully.'
        );
    }


    /**
     * Update variant.
     */
    public function update(
        Request $request,
        Product $product,
        ProductVariant $variant
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
                'unique:product_variants,sku,' . $variant->id,
            ],

            'size' => [
                'nullable',
                'string',
                'max:100',
            ],

            'thickness' => [
                'nullable',
                'string',
                'max:100',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $variant->update([
            'name' => $validated['name'],

            'sku' =>
                $validated['sku'] ?? null,

            'size' =>
                $validated['size'] ?? null,

            'thickness' =>
                $validated['thickness'] ?? null,

            'price' =>
                $validated['price'],

            'stock' =>
                $validated['stock'],

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        return back()->with(
            'success',
            'Variant updated successfully.'
        );
    }


    /**
     * Delete variant.
     */
    public function destroy(
        Product $product,
        ProductVariant $variant
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id,
            404
        );

        $variant->delete();

        return back()->with(
            'success',
            'Variant deleted successfully.'
        );
    }
}