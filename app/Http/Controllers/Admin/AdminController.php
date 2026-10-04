<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $productCount = Product::query()
            ->where('is_active', true)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categoryCount = Category::query()
            ->where('is_active', true)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $customerCount = User::query()
            ->where('role', 'customer')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Low Stock
        |--------------------------------------------------------------------------
        */

        $lowStockCount = Product::query()
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::query()->count();

        $pendingOrders = Order::query()
            ->where('order_status', 'pending')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Total Sales
        |--------------------------------------------------------------------------
        |
        | Cancelled orders are excluded.
        |
        */

        $totalSales = Order::query()
            ->whereNotIn('order_status', [
                'cancelled',
            ])
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::query()
            ->with('user')
            ->latest()
            ->take(8)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'productCount',
                'categoryCount',
                'customerCount',
                'lowStockCount',
                'totalOrders',
                'pendingOrders',
                'totalSales',
                'recentOrders'
            )
        );
    }
}