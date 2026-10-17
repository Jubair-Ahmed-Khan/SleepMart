<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'pending');

        $allowedStatuses = ['pending', 'approved', 'rejected'];

        if (!in_array($status, $allowedStatuses, true)) {
            $status = 'pending';
        }

        $reviews = Review::query()
            ->with([
                'user:id,name',
                'product:id,name,slug',
                'order:id',
            ])
            ->where('status', $status)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'pending' => Review::where('status', 'pending')->count(),
            'approved' => Review::where('status', 'approved')->count(),
            'rejected' => Review::where('status', 'rejected')->count(),
        ];

        return view('admin.reviews.index', compact(
            'reviews',
            'status',
            'counts'
        ));
    }

    public function approve(Review $review): RedirectResponse
    {
        $review->update([
            'status' => 'approved',
            'is_approved' => true,
        ]);

        return back()->with(
            'success',
            'Review approved successfully.'
        );
    }

    public function reject(Review $review): RedirectResponse
    {
        $review->update([
            'status' => 'rejected',
            'is_approved' => false,
        ]);

        return back()->with(
            'success',
            'Review rejected successfully. It will not appear publicly.'
        );
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return back()->with(
            'success',
            'Review deleted permanently.'
        );
    }
}