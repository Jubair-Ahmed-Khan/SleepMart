<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:5', 'max:3000'],
        ]);

        $userId = $request->user()->id;

        /*
         * A review is allowed only when this customer has a delivered
         * order containing this product.
         *
         * The order ID comes from the database, never from the form.
         */
        $eligibleOrderId = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', $userId)
            ->where('orders.order_status', 'delivered')
            ->where('order_items.product_id', $product->id)
            ->orderByDesc('orders.id')
            ->value('orders.id');

        if (!$eligibleOrderId) {
            throw ValidationException::withMessages([
                'review' => 'You can review this product after your order has been delivered.',
            ]);
        }

        $alreadyReviewed = Review::query()
            ->where('user_id', $userId)
            ->where('product_id', $product->id)
            ->where('order_id', $eligibleOrderId)
            ->exists();

        if ($alreadyReviewed) {
            throw ValidationException::withMessages([
                'review' => 'You have already reviewed this product for this order.',
            ]);
        }

        Review::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'order_id' => $eligibleOrderId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false,
        ]);

        return redirect()
            ->to(url('/product/' . $product->slug) . '#reviews')
            ->with('success', 'Thank you! Your review has been submitted for approval.');
    }
}