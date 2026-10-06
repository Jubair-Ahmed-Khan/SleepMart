<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display admin order list.
     */
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | Available order statuses
        |--------------------------------------------------------------------------
        */
        $statuses = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ];

        /*
        |--------------------------------------------------------------------------
        | Orders query
        |--------------------------------------------------------------------------
        */
        $orders = Order::query()
            ->with([
                'user',
            ])

            /*
            |--------------------------------------------------------------------------
            | Filter by order status
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Your database column is "order_status",
            | not "status".
            |
            |--------------------------------------------------------------------------
            */
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where(
                        'order_status',
                        $request->status
                    );
                }
            )

            /*
            |--------------------------------------------------------------------------
            | Search
            |--------------------------------------------------------------------------
            |
            | Your Order model has "name", not "customer_name".
            |
            |--------------------------------------------------------------------------
            */
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->search);

                    $query->where(function ($query) use ($search) {
                        $query
                            ->where(
                                'order_number',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'phone',
                                'like',
                                "%{$search}%"
                            );
                    });
                }
            )

            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.orders.index',
            compact(
                'orders',
                'statuses'
            )
        );
    }

    /**
     * Display order details.
     */
    public function show(Order $order): View
    {
        $order->load([
            'user',
            'items',
            'items.product',
            'items.variant',
        ]);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }

    /**
     * Update order status.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Validate new status
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,shipped,delivered,cancelled',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Current and new status
        |--------------------------------------------------------------------------
        */
        $currentStatus = $order->order_status;
        $newStatus = $validated['status'];

        /*
        |--------------------------------------------------------------------------
        | Prevent unnecessary update
        |--------------------------------------------------------------------------
        */
        if ($currentStatus === $newStatus) {
            return back()->with(
                'error',
                'The order is already in this status.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Allowed status transitions
        |--------------------------------------------------------------------------
        |
        | Pending
        |    ↓
        | Confirmed
        |    ↓
        | Processing
        |    ↓
        | Shipped
        |    ↓
        | Delivered
        |
        | Cancellation is allowed before completion.
        |
        |--------------------------------------------------------------------------
        */
        $allowedTransitions = [
            'pending' => [
                'confirmed',
                'cancelled',
            ],

            'confirmed' => [
                'processing',
                'cancelled',
            ],

            'processing' => [
                'shipped',
                'cancelled',
            ],

            'shipped' => [
                'delivered',
                'cancelled',
            ],

            'delivered' => [],

            'cancelled' => [],
        ];

        /*
        |--------------------------------------------------------------------------
        | Check whether transition is allowed
        |--------------------------------------------------------------------------
        */
        if (
            !in_array(
                $newStatus,
                $allowedTransitions[$currentStatus] ?? [],
                true
            )
        ) {
            return back()->with(
                'error',
                "Order cannot be changed from "
                . ucfirst($currentStatus)
                . " to "
                . ucfirst($newStatus)
                . "."
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update order status
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Your database column is "order_status".
        |
        |--------------------------------------------------------------------------
        */
        $order->update([
            'order_status' => $newStatus,
        ]);

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }
}

