<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Product list.
     */
    public function index(): View
    {
        $products = Product::query()
            ->with([
                'category',
                'variants',
                'images',
            ])
            ->latest()
            ->paginate(15);

        return view(
            'admin.products.index',
            compact('products')
        );
    }


    /**
     * Create product form.
     */
    public function create(): View
    {

        $product = new Product();
        
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.products.create',
            compact('product', 'categories')
        );
    }


    /**
     * Store product.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,slug',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
                'unique:products,sku',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'regular_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'cost_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'weight' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'rating' => [
                'nullable',
                'numeric',
                'min:0',
                'max:5',
            ],

            'reviews_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $slug = $validated['slug']
            ?: Str::slug($validated['name']);

        $product = Product::create([
            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'slug' => $slug,

            'sku' => $validated['sku'] ?? null,

            'short_description' =>
                $validated['short_description'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'regular_price' =>
                $validated['regular_price'],

            'selling_price' =>
                $validated['selling_price'],

            'cost_price' =>
                $validated['cost_price'] ?? null,

            'stock' =>
                $validated['stock'],

            'weight' =>
                $validated['weight'] ?? null,

            'rating' =>
                $validated['rating'] ?? 0,

            'reviews_count' =>
                $validated['reviews_count'] ?? 0,

            'is_featured' =>
                $request->boolean('is_featured'),

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        if ($request->hasFile('thumbnail')) {

            $path = $request
                ->file('thumbnail')
                ->store(
                    "products/{$product->id}",
                    'public'
                );

            $product->update([
                'thumbnail' => $path,
            ]);
        }

        return redirect()
            ->route(
                'admin.products.edit',
                $product
            )
            ->with(
                'success',
                'Product created successfully.'
            );
    }


    /**
     * View product.
     */
    public function show(Product $product): View
    {
        $product->load([
            'category',
            'variants',
            'images',
        ]);

        return view(
            'admin.products.show',
            compact('product')
        );
    }


    /**
     * Edit product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $product->load([
            'category',
            'variants',
            'images',
        ]);

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }


    /**
     * Update product.
     */
    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,slug,' . $product->id,
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
                'unique:products,sku,' . $product->id,
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'regular_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'cost_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'weight' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'rating' => [
                'nullable',
                'numeric',
                'min:0',
                'max:5',
            ],

            'reviews_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $product->update([
            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'slug' =>
                $validated['slug']
                ?: Str::slug($validated['name']),

            'sku' =>
                $validated['sku'] ?? null,

            'short_description' =>
                $validated['short_description'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'regular_price' =>
                $validated['regular_price'],

            'selling_price' =>
                $validated['selling_price'],

            'cost_price' =>
                $validated['cost_price'] ?? null,

            'stock' =>
                $validated['stock'],

            'weight' =>
                $validated['weight'] ?? null,

            'rating' =>
                $validated['rating'] ?? 0,

            'reviews_count' =>
                $validated['reviews_count'] ?? 0,

            'is_featured' =>
                $request->boolean('is_featured'),

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        if ($request->hasFile('thumbnail')) {

            if ($product->thumbnail) {
                Storage::disk('public')
                    ->delete($product->thumbnail);
            }

            $path = $request
                ->file('thumbnail')
                ->store(
                    "products/{$product->id}",
                    'public'
                );

            $product->update([
                'thumbnail' => $path,
            ]);
        }

        return redirect()
            ->route(
                'admin.products.edit',
                $product
            )
            ->with(
                'success',
                'Product updated successfully.'
            );
    }


    /**
     * Deactivate product.
     */
    public function deactivate(
        Product $product
    ): RedirectResponse {
        $product->update([
            'is_active' => false,
        ]);

        return back()->with(
            'success',
            'Product has been deactivated.'
        );
    }


    /**
     * Activate product.
     */
    public function activate(
        Product $product
    ): RedirectResponse {
        $product->update([
            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Product has been activated.'
        );
    }
}