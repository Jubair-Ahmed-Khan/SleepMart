@php
    $editing = isset($coupon);
@endphp

@if($errors->any())
    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div>
        <label for="code" class="mb-1 block text-sm font-medium text-gray-700">
            Coupon Code *
        </label>
        <input
            id="code"
            name="code"
            value="{{ old('code', $coupon->code ?? '') }}"
            required
            maxlength="50"
            placeholder="SLEEP10"
            class="w-full rounded-lg border border-gray-300 px-4 py-3 uppercase focus:border-teal-500 focus:ring-teal-500"
        >
    </div>

    <div>
        <label for="discount_type" class="mb-1 block text-sm font-medium text-gray-700">
            Discount Type *
        </label>
        <select
            id="discount_type"
            name="discount_type"
            required
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3"
        >
            <option value="percentage" @selected(old('discount_type', $coupon->discount_type ?? 'percentage') === 'percentage')>
                Percentage (%)
            </option>
            <option value="fixed" @selected(old('discount_type', $coupon->discount_type ?? '') === 'fixed')>
                Fixed amount (৳)
            </option>
        </select>
    </div>

    <div>
        <label for="discount_value" class="mb-1 block text-sm font-medium text-gray-700">
            Discount Value *
        </label>
        <input
            id="discount_value"
            type="number"
            name="discount_value"
            min="0.01"
            step="0.01"
            value="{{ old('discount_value', $coupon->discount_value ?? '') }}"
            required
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
        <p class="mt-1 text-xs text-gray-500">
            For example, enter 10 for 10% or 500 for ৳500.
        </p>
    </div>

    <div>
        <label for="minimum_order" class="mb-1 block text-sm font-medium text-gray-700">
            Minimum Order (৳) *
        </label>
        <input
            id="minimum_order"
            type="number"
            name="minimum_order"
            min="0"
            step="0.01"
            value="{{ old('minimum_order', $coupon->minimum_order ?? 0) }}"
            required
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
    </div>

    <div>
        <label for="maximum_discount" class="mb-1 block text-sm font-medium text-gray-700">
            Maximum Discount (৳)
        </label>
        <input
            id="maximum_discount"
            type="number"
            name="maximum_discount"
            min="0.01"
            step="0.01"
            value="{{ old('maximum_discount', $coupon->maximum_discount ?? '') }}"
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
        <p class="mt-1 text-xs text-gray-500">
            Optional. Mainly useful for percentage coupons.
        </p>
    </div>

    <div>
        <label for="starts_at" class="mb-1 block text-sm font-medium text-gray-700">
            Start Date
        </label>
        <input
            id="starts_at"
            type="datetime-local"
            name="starts_at"
            value="{{ old('starts_at', isset($coupon) && $coupon->starts_at ? $coupon->starts_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
        <p class="mt-1 text-xs text-gray-500">Leave empty for immediate validity.</p>
    </div>

    <div>
        <label for="ends_at" class="mb-1 block text-sm font-medium text-gray-700">
            End Date
        </label>
        <input
            id="ends_at"
            type="datetime-local"
            name="ends_at"
            value="{{ old('ends_at', isset($coupon) && $coupon->ends_at ? $coupon->ends_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
    </div>

    <div>
        <label for="is_active" class="mb-1 block text-sm font-medium text-gray-700">
            Status *
        </label>
        <select
            id="is_active"
            name="is_active"
            required
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3"
        >
            <option value="1" @selected((string) old('is_active', isset($coupon) ? (int) $coupon->is_active : 1) === '1')>
                Active
            </option>
            <option value="0" @selected((string) old('is_active', isset($coupon) ? (int) $coupon->is_active : 1) === '0')>
                Inactive
            </option>
        </select>
    </div>

</div>

<div class="mt-7 flex flex-wrap gap-3">
    <button
        type="submit"
        class="rounded-lg bg-teal-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-teal-700"
    >
        {{ $editing ? 'Save Changes' : 'Create Coupon' }}
    </button>

    <a
        href="{{ route('admin.coupons.index') }}"
        class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50"
    >
        Cancel
    </a>
</div>
