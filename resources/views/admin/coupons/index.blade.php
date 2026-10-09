@extends('layouts.admin')

@section('title', 'Coupons | SleepMart')
@section('page-title', 'Coupons')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Coupons</h2>
            <p class="mt-1 text-sm text-gray-500">
                Manage promotional codes and discounts.
            </p>
        </div>

        <a
            href="{{ route('admin.coupons.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-teal-600 px-4 py-3 text-sm font-semibold text-white hover:bg-teal-700"
        >
            + Create Coupon
        </a>
    </div>

    <!-- @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif -->

    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] table-fixed divide-y divide-gray-100">
                <colgroup>
                    <col style="width: 17%">
                    <col style="width: 15%">
                    <col style="width: 13%">
                    <col style="width: 14%">
                    <col style="width: 18%">
                    <col style="width: 10%">
                    <col style="width: 13%">
                </colgroup>

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Code</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Discount</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Minimum</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Maximum</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Validity</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Status</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold uppercase text-gray-500">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($coupons as $coupon)
                        <tr class="hover:bg-gray-50">

                            <td class="px-5 py-4 text-center">
                                <span class="block truncate font-bold text-gray-900" title="{{ $coupon->code }}">
                                    {{ $coupon->code }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-sm font-semibold text-gray-800 text-center">
                                @if($coupon->discount_type === 'percentage')
                                    {{ rtrim(rtrim(number_format((float) $coupon->discount_value, 2), '0'), '.') }}% OFF
                                @else
                                    ৳{{ number_format((float) $coupon->discount_value, 2) }} OFF
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-700 text-center">
                                ৳{{ number_format((float) $coupon->minimum_order, 2) }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-700 text-center">
                                {{ $coupon->maximum_discount !== null
                                    ? '৳' . number_format((float) $coupon->maximum_discount, 2)
                                    : 'No limit' }}
                            </td>

                            <td class="px-5 py-4 text-xs text-gray-600  text-center">
                                <div>
                                    From:
                                    {{ $coupon->starts_at?->format('d M Y, h:i A') ?? 'Any time' }}
                                </div>
                                <div class="mt-1">
                                    Until:
                                    {{ $coupon->ends_at?->format('d M Y, h:i A') ?? 'No expiry' }}
                                </div>
                            </td>

                            <td class="px-5 py-4 text-center">
                                @php
                                    $now = now();
                                    $expired = $coupon->ends_at && $coupon->ends_at->lt($now);
                                    $scheduled = $coupon->starts_at && $coupon->starts_at->gt($now);
                                @endphp

                                @if(!$coupon->is_active)
                                    <span class="whitespace-nowrap rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Inactive</span>
                                @elseif($expired)
                                    <span class="whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Expired</span>
                                @elseif($scheduled)
                                    <span class="whitespace-nowrap rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Scheduled</span>
                                @else
                                    <span class="whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Active</span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a
                                        href="{{ route('admin.coupons.edit', $coupon) }}"
                                        title="Edit coupon"
                                        aria-label="Edit coupon"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-teal-50 text-teal-700 hover:bg-teal-100"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                                        </svg>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.coupons.destroy', $coupon) }}"
                                        onsubmit="return confirm('Delete coupon {{ $coupon->code }}?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete coupon"
                                            aria-label="Delete coupon"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-700 hover:bg-red-100"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="m19 6-1 14H6L5 6"/>
                                                <path d="M10 11v5"/>
                                                <path d="M14 11v5"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <p class="font-semibold text-gray-900">No coupons yet</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Create your first coupon to start offering discounts.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($coupons->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">
                {{ $coupons->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
