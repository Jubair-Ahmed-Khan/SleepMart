<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
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
}