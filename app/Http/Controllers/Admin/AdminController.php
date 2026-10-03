<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $productCount = Product::query()
            ->where('is_active', true)
            ->count();

        $categoryCount = Category::query()
            ->where('is_active', true)
            ->count();

        $customerCount = User::query()
            ->where('role', 'customer')
            ->count();

        $lowStockCount = Product::query()
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->count();

        return view(
            'admin.dashboard',
            compact(
                'productCount',
                'categoryCount',
                'customerCount',
                'lowStockCount'
            )
        );
    }
}