<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function index(): View
    {
        $coupons = Coupon::query()
            ->latest()
            ->paginate(15);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create(): View
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCoupon($request);

        $validated['code'] = strtoupper(trim($validated['code']));

        Coupon::create($validated);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon): View
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(
        Request $request,
        Coupon $coupon
    ): RedirectResponse {
        $validated = $this->validateCoupon($request, $coupon);

        $validated['code'] = strtoupper(trim($validated['code']));

        $coupon->update($validated);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        // Existing orders retain their coupon_code and discount_amount.
        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }

    private function validateCoupon(
        Request $request,
        ?Coupon $coupon = null
    ): array {
        return $request->validate([
            'code' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z0-9_-]+$/',
                Rule::unique('coupons', 'code')
                    ->ignore($coupon?->id),
            ],
            'discount_type' => [
                'required',
                Rule::in(['percentage', 'fixed']),
            ],
            'discount_value' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999999.99',
                $request->input('discount_type') === 'percentage'
                    ? 'lte:100'
                    : 'nullable',
            ],
            'minimum_order' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
            'maximum_discount' => [
                'nullable',
                'numeric',
                'gt:0',
                'max:99999999.99',
            ],
            'starts_at' => [
                'nullable',
                'date',
            ],
            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ], [
            'code.regex' => 'Use only letters, numbers, hyphens, and underscores in the coupon code.',
            'discount_value.lte' => 'A percentage discount cannot exceed 100%.',
            'ends_at.after_or_equal' => 'The end date must be on or after the start date.',
        ]);
    }
}
