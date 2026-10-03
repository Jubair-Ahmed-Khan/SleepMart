<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->where(
                'user_id',
                auth()->id()
            )
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view(
            'orders.index',
            compact('orders')
        );
    }

    public function show(Order $order): View
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load('items');

        return view(
            'orders.show',
            compact('order')
        );
    }
}