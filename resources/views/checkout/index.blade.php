@extends('layouts.app')

@section('title', 'Checkout | SleepMart')

@section('content')

<div class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="mt-2 text-gray-600">
                Complete your information to place your order.
            </p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        {{-- Checkout Steps --}}
        <div class="mb-8 overflow-hidden rounded-2xl border border-gray-200 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-4">
                @foreach([
                    ['number' => 1, 'label' => 'Information'],
                    ['number' => 2, 'label' => 'Delivery'],
                    ['number' => 3, 'label' => 'Payment'],
                    ['number' => 4, 'label' => 'Confirmation'],
                ] as $step)
                    <div class="flex items-center gap-3 border-b border-gray-200 p-4 md:border-b-0 md:border-r last:border-r-0">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full {{ $step['number'] < 4 ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-600' }} text-sm font-bold">
                            {{ $step['number'] }}
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Step {{ $step['number'] }}</p>
                            <p class="font-semibold text-gray-900">{{ $step['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- LEFT: CHECKOUT FORM --}}
            <div class="space-y-6 lg:col-span-2">

                <form
                    id="checkout-form"
                    method="POST"
                    action="{{ route('checkout.store') }}"
                >
                    @csrf

                    {{-- Customer Information --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6">
                        <h2 class="text-xl font-bold text-gray-900">
                            Customer Information
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Please provide your contact information.
                        </p>

                        <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required
                                    autocomplete="name"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="Enter your full name"
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone', '') }}"
                                    required
                                    maxlength="11"
                                    autocomplete="tel"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="01712345678"
                                >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email Address
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    autocomplete="email"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="you@example.com"
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Delivery Address --}}
                    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
                        <h2 class="text-xl font-bold text-gray-900">
                            Delivery Address
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Where should we deliver your order?
                        </p>

                        <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="division_id" class="block text-sm font-medium text-gray-700">
                                    Division <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="division_id"
                                    name="division_id"
                                    required
                                    data-old-value="{{ old('division_id', '') }}"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                >
                                    <option value="">Select Division</option>
                                </select>
                                @error('division_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="district_id" class="block text-sm font-medium text-gray-700">
                                    District <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="district_id"
                                    name="district_id"
                                    required
                                    disabled
                                    data-old-value="{{ old('district_id', '') }}"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500 disabled:bg-gray-100"
                                >
                                    <option value="">Select District</option>
                                </select>
                                @error('district_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="upazila_id" class="block text-sm font-medium text-gray-700">
                                    Upazila / Thana <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="upazila_id"
                                    name="upazila_id"
                                    required
                                    disabled
                                    data-old-value="{{ old('upazila_id', '') }}"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500 disabled:bg-gray-100"
                                >
                                    <option value="">Select Upazila</option>
                                </select>
                                @error('upazila_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">
                                    Full Address <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    required
                                    autocomplete="street-address"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="House/Road, Area, Landmark..."
                                >{{ old('address', '') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="delivery_note" class="block text-sm font-medium text-gray-700">
                                    Delivery Note <span class="text-gray-400">(Optional)</span>
                                </label>
                                <textarea
                                    id="delivery_note"
                                    name="delivery_note"
                                    rows="3"
                                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="Any special instructions for delivery?"
                                >{{ old('delivery_note', '') }}</textarea>
                                @error('delivery_note')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
                        <h2 class="text-xl font-bold text-gray-900">
                            Payment Method
                        </h2>

                        <div class="mt-5">
                            <label class="flex cursor-pointer items-start gap-4 rounded-xl border-2 border-teal-500 bg-teal-50 p-5">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cod"
                                    {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                                    class="mt-1 h-5 w-5 text-teal-600 focus:ring-teal-500"
                                >
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-semibold text-gray-900">
                                            Cash on Delivery
                                        </span>
                                        <span class="rounded-full bg-teal-100 px-2 py-1 text-xs font-semibold text-teal-700">
                                            COD
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Pay when your SleepMart order is delivered to you.
                                    </p>
                                </div>
                            </label>
                        </div>

                        @error('payment_method')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </form>

            </div>

            {{-- RIGHT: COUPON AND ORDER SUMMARY --}}
            <div class="space-y-6 lg:col-span-1">

                {{-- Coupon --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <h3 class="font-semibold text-gray-900">
                        Have a coupon?
                    </h3>

                    @if($coupon)
                        <div class="mt-4 rounded-xl border border-teal-200 bg-teal-50 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-bold text-teal-800">
                                        {{ $coupon->code }}
                                    </p>
                                    <p class="mt-1 text-sm text-teal-700">
                                        Coupon applied successfully.
                                    </p>
                                    <p class="mt-1 text-sm font-semibold text-teal-800">
                                        You save ৳{{ number_format($discountAmount, 2) }}
                                    </p>
                                </div>

                                <form
                                    id="remove-coupon-form"
                                    method="POST"
                                    action="{{ route('checkout.coupon.remove') }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-semibold text-red-600 hover:text-red-700"
                                    >
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <form
                            id="apply-coupon-form"
                            method="POST"
                            action="{{ route('checkout.coupon.apply') }}"
                            class="mt-4"
                        >
                            @csrf

                            <label for="coupon_code" class="sr-only">
                                Coupon code
                            </label>

                            <div class="flex flex-col gap-3 sm:flex-row">
                                <input
                                    id="coupon_code"
                                    type="text"
                                    name="coupon_code"
                                    value="{{ old('coupon_code') }}"
                                    placeholder="Enter coupon code"
                                    maxlength="50"
                                    required
                                    class="min-w-0 flex-1 rounded-lg border border-gray-300 px-4 py-3 uppercase focus:border-teal-500 focus:ring-teal-500"
                                >

                                <button
                                    type="submit"
                                    class="rounded-lg bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
                                >
                                    Apply Coupon
                                </button>
                            </div>

                            @error('coupon_code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </form>
                    @endif
                </div>

                {{-- Order Summary --}}
                <div class="sticky top-6 rounded-2xl border border-gray-200 bg-white p-6">
                    <h2 class="text-xl font-bold text-gray-900">
                        Order Summary
                    </h2>

                    <div class="mt-6 space-y-4">
                        @foreach($cart as $item)
                            <div class="flex gap-4">
                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100">
                                    @if(!empty($item['thumbnail']))
                                        <img
                                            src="{{ asset('storage/' . $item['thumbnail']) }}"
                                            alt="{{ $item['name'] }}"
                                            class="h-full w-full object-cover"
                                        >
                                    @endif
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $item['name'] }}
                                    </p>

                                    @if(!empty($item['variant_name']))
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item['variant_name'] }}
                                        </p>
                                    @endif

                                    <p class="mt-1 text-xs text-gray-500">
                                        Qty: {{ $item['quantity'] }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-900">
                                        ৳{{ number_format(
                                            (float) $item['price'] * (int) $item['quantity'],
                                            2
                                        ) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="my-6 border-t border-gray-200"></div>

                    {{-- Price Breakdown --}}
                    <div class="space-y-3">
                        <div class="flex justify-between gap-4 text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium text-gray-900">
                                ৳{{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 text-sm">
                            <span class="text-gray-600">Delivery Charge</span>
                            <span class="font-medium text-gray-900">
                                ৳{{ number_format($shippingCharge, 2) }}
                            </span>
                        </div>

                        @if($coupon && $discountAmount > 0)
                            <div class="flex justify-between gap-4 text-sm">
                                <span class="font-medium text-teal-700">
                                    Coupon ({{ $coupon->code }})
                                </span>
                                <span class="font-semibold text-teal-700">
                                    −৳{{ number_format($discountAmount, 2) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="my-5 border-t border-gray-200"></div>

                    <div class="flex items-center justify-between gap-4">
                        <span class="text-lg font-bold text-gray-900">
                            Total
                        </span>
                        <span class="text-2xl font-bold text-teal-600">
                            ৳{{ number_format($total, 2) }}
                        </span>
                    </div>

                    {{-- Place Order submits ONLY checkout-form --}}
                    <button
                        type="submit"
                        form="checkout-form"
                        class="mt-6 w-full rounded-xl bg-teal-600 px-6 py-4 text-sm font-bold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                    >
                        Place Order
                    </button>

                    <p class="mt-4 text-center text-xs text-gray-500">
                        By placing this order, you agree to SleepMart's
                        terms and delivery policy.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', async function () {
    const checkoutForm = document.getElementById('checkout-form');
    const divisionSelect = document.getElementById('division_id');
    const districtSelect = document.getElementById('district_id');
    const upazilaSelect = document.getElementById('upazila_id');

    const draftKey = 'sleepmart_checkout_draft_{{ auth()->id() }}';

    const oldValues = {
        name: @json(old('name')),
        phone: @json(old('phone')),
        email: @json(old('email')),
        address: @json(old('address')),
        delivery_note: @json(old('delivery_note')),
        payment_method: @json(old('payment_method')),
        division_id: @json(old('division_id')),
        district_id: @json(old('district_id')),
        upazila_id: @json(old('upazila_id'))
    };

    let draft = {};

    try {
        draft = JSON.parse(sessionStorage.getItem(draftKey) || '{}') || {};
    } catch (error) {
        draft = {};
    }

    /*
     * Laravel old() values take priority when present.
     * Otherwise, restore the browser's saved checkout draft.
     */
    function preferredValue(name) {
        if (
            Object.prototype.hasOwnProperty.call(oldValues, name) &&
            oldValues[name] !== null &&
            oldValues[name] !== ''
        ) {
            return oldValues[name];
        }

        return draft[name] ?? '';
    }

    function saveCheckoutDraft() {
        const data = { ...draft };

        checkoutForm.querySelectorAll('[name]').forEach(function (field) {
            if (field.name === '_token' || field.disabled) {
                return;
            }

            if (field.type === 'radio' || field.type === 'checkbox') {
                if (field.checked) {
                    data[field.name] = field.value;
                }
                return;
            }

            if (field.tagName === 'SELECT') {
                /*
                 * Never overwrite a previously saved location ID with an
                 * empty value while dependent dropdowns are being loaded.
                 */
                if (field.value !== '') {
                    data[field.name] = field.value;
                }
                return;
            }

            data[field.name] = field.value;
        });

        try {
            sessionStorage.setItem(draftKey, JSON.stringify(data));
            draft = data;
        } catch (error) {
            console.warn('Unable to save checkout draft.', error);
        }
    }

    function restoreRegularFields() {
        checkoutForm.querySelectorAll('[name]').forEach(function (field) {
            if (
                field.name === '_token' ||
                field.tagName === 'SELECT'
            ) {
                return;
            }

            const value = preferredValue(field.name);

            if (value === '' || value === null || value === undefined) {
                return;
            }

            if (field.type === 'radio' || field.type === 'checkbox') {
                field.checked = String(field.value) === String(value);
            } else {
                field.value = value;
            }
        });
    }

    function resetSelect(select, placeholder, disabled = true) {
        select.innerHTML = '';

        const option = document.createElement('option');
        option.value = '';
        option.textContent = placeholder;
        select.appendChild(option);

        select.disabled = disabled;
    }

    function addOptions(select, items, placeholder, selectedValue) {
        select.innerHTML = '';

        const placeholderOption = document.createElement('option');
        placeholderOption.value = '';
        placeholderOption.textContent = placeholder;
        select.appendChild(placeholderOption);

        items.forEach(function (item) {
            const option = document.createElement('option');

            option.value = String(item.id);
            option.textContent = item.name;

            select.appendChild(option);
        });

        select.disabled = false;

        if (
            selectedValue !== null &&
            selectedValue !== undefined &&
            selectedValue !== ''
        ) {
            select.value = String(selectedValue);
        }

        return select.value;
    }

    async function fetchJson(url) {
        const response = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error('Request failed: ' + response.status);
        }

        return await response.json();
    }

    async function loadDivisions(selectedDivisionId) {
        resetSelect(divisionSelect, 'Loading divisions...', true);
        resetSelect(districtSelect, 'Select District', true);
        resetSelect(upazilaSelect, 'Select Upazila', true);

        const divisions = await fetchJson(
            @json(route('locations.divisions'))
        );

        const selected = addOptions(
            divisionSelect,
            divisions,
            'Select Division',
            selectedDivisionId
        );

        return selected;
    }

    async function loadDistricts(divisionId, selectedDistrictId) {
        resetSelect(districtSelect, 'Loading districts...', true);
        resetSelect(upazilaSelect, 'Select Upazila', true);

        if (!divisionId) {
            resetSelect(districtSelect, 'Select District', true);
            return '';
        }

        const districts = await fetchJson(
            `/locations/divisions/${encodeURIComponent(divisionId)}/districts`
        );

        return addOptions(
            districtSelect,
            districts,
            'Select District',
            selectedDistrictId
        );
    }

    async function loadUpazilas(districtId, selectedUpazilaId) {
        resetSelect(upazilaSelect, 'Loading upazilas...', true);

        if (!districtId) {
            resetSelect(upazilaSelect, 'Select Upazila', true);
            return '';
        }

        const upazilas = await fetchJson(
            `/locations/districts/${encodeURIComponent(districtId)}/upazilas`
        );

        return addOptions(
            upazilaSelect,
            upazilas,
            'Select Upazila',
            selectedUpazilaId
        );
    }

    /*
     * Restore locations strictly in dependency order:
     * divisions -> districts -> upazilas.
     *
     * Each function finishes populating its dropdown before the next
     * request starts. This prevents asynchronous responses from resetting
     * a selection that was restored too early.
     */
    async function restoreLocationSelections() {
        const divisionId = preferredValue('division_id');
        const districtId = preferredValue('district_id');
        const upazilaId = preferredValue('upazila_id');

        const selectedDivisionId = await loadDivisions(divisionId);

        if (!selectedDivisionId) {
            return;
        }

        const selectedDistrictId = await loadDistricts(
            selectedDivisionId,
            districtId
        );

        if (!selectedDistrictId) {
            return;
        }

        await loadUpazilas(selectedDistrictId, upazilaId);
    }

    /*
     * Do not save drafts while the initial location restoration is in
     * progress. This prevents blank dropdowns from overwriting saved IDs.
     */
    let locationsReady = false;

    checkoutForm.addEventListener('input', function () {
        if (locationsReady) {
            saveCheckoutDraft();
        } else {
            saveRegularFieldsOnly();
        }
    });

    checkoutForm.addEventListener('change', function (event) {
        if (event.target === divisionSelect ||
            event.target === districtSelect ||
            event.target === upazilaSelect) {
            return;
        }

        if (locationsReady) {
            saveCheckoutDraft();
        } else {
            saveRegularFieldsOnly();
        }
    });

    function saveRegularFieldsOnly() {
        checkoutForm.querySelectorAll('[name]').forEach(function (field) {
            if (
                field.name === '_token' ||
                field.tagName === 'SELECT' ||
                field.type === 'radio' ||
                field.type === 'checkbox' ||
                field.disabled
            ) {
                return;
            }

            draft[field.name] = field.value;
        });

        checkoutForm.querySelectorAll(
            'input[type="radio"]:checked, input[type="checkbox"]:checked'
        ).forEach(function (field) {
            draft[field.name] = field.value;
        });

        try {
            sessionStorage.setItem(draftKey, JSON.stringify(draft));
        } catch (error) {
            console.warn('Unable to save checkout draft.', error);
        }
    }

    /*
     * Save before coupon submission. The form submission then navigates
     * normally, and the next checkout page restores the saved IDs.
     */
    [
        document.getElementById('apply-coupon-form'),
        document.getElementById('remove-coupon-form')
    ].forEach(function (form) {
        if (form) {
            form.addEventListener('submit', function () {
                saveCheckoutDraft();
            });
        }
    });

    divisionSelect.addEventListener('change', async function () {
        const divisionId = this.value;

        draft.division_id = divisionId;
        draft.district_id = '';
        draft.upazila_id = '';

        resetSelect(districtSelect, 'Select District', true);
        resetSelect(upazilaSelect, 'Select Upazila', true);

        try {
            const selectedDistrictId = await loadDistricts(divisionId, '');

            draft.district_id = selectedDistrictId || '';
        } catch (error) {
            console.error('Unable to load districts:', error);
            resetSelect(districtSelect, 'Unable to load districts', true);
        }

        saveCheckoutDraft();
    });

    districtSelect.addEventListener('change', async function () {
        const districtId = this.value;

        draft.district_id = districtId;
        draft.upazila_id = '';

        resetSelect(upazilaSelect, 'Select Upazila', true);

        try {
            const selectedUpazilaId = await loadUpazilas(districtId, '');

            draft.upazila_id = selectedUpazilaId || '';
        } catch (error) {
            console.error('Unable to load upazilas:', error);
            resetSelect(upazilaSelect, 'Unable to load upazilas', true);
        }

        saveCheckoutDraft();
    });

    upazilaSelect.addEventListener('change', function () {
        draft.upazila_id = this.value;
        saveCheckoutDraft();
    });

    /*
     * Initialization:
     * 1. Restore regular fields.
     * 2. Load and restore all location dropdowns.
     * 3. Enable draft saving only after restoration completes.
     */
    restoreRegularFields();

    try {
        await restoreLocationSelections();
    } catch (error) {
        console.error('Unable to restore delivery locations:', error);
    } finally {
        locationsReady = true;

        /*
         * Persist the restored values only when the dropdowns actually
         * contain the selected options. Never replace saved IDs with blanks.
         */
        if (
            divisionSelect.value &&
            districtSelect.value &&
            upazilaSelect.value
        ) {
            draft.division_id = divisionSelect.value;
            draft.district_id = districtSelect.value;
            draft.upazila_id = upazilaSelect.value;
        }

        saveCheckoutDraft();
    }
});
</script>
@endpush