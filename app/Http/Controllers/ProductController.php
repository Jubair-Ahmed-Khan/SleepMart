<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with([
                'category',
                'variants',
                'images',
            ])
            ->where('is_active', true)

            // Search
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->search);

                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('sku', 'like', "%{$search}%")
                            ->orWhere(
                                'short_description',
                                'like',
                                "%{$search}%"
                            );
                    });
                }
            )

            // Category filter
            ->when(
                $request->filled('category'),
                function ($query) use ($request) {
                    $query->whereHas(
                        'category',
                        function ($categoryQuery) use ($request) {
                            $categoryQuery->where(
                                'slug',
                                $request->category
                            );
                        }
                    );
                }
            )

            // Price filter
            ->when(
                $request->filled('min_price'),
                function ($query) use ($request) {
                    $query->where(
                        'selling_price',
                        '>=',
                        $request->min_price
                    );
                }
            )

            ->when(
                $request->filled('max_price'),
                function ($query) use ($request) {
                    $query->where(
                        'selling_price',
                        '<=',
                        $request->max_price
                    );
                }
            )

            // Sorting
            ->when(
                $request->sort === 'price_low',
                fn ($query) =>
                    $query->orderBy('selling_price', 'asc')
            )

            ->when(
                $request->sort === 'price_high',
                fn ($query) =>
                    $query->orderBy('selling_price', 'desc')
            )

            ->when(
                $request->sort === 'rating',
                fn ($query) =>
                    $query->orderBy('rating', 'desc')
            )

            ->when(
                $request->sort === 'latest' ||
                !$request->filled('sort'),
                fn ($query) =>
                    $query->latest()
            )

            ->paginate(12)

            ->withQueryString();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view(
            'products.index',
            compact(
                'products',
                'categories'
            )
        );
    }

    public function show(Product $product): View
    {
        abort_unless(
            $product->is_active,
            404
        );

        $product->load([
            'category',
            'variants',
            'images',
        ]);

        $relatedProducts = Product::query()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        return view(
            'products.show',
            compact(
                'product',
                'relatedProducts'
            )
        );
    }
}