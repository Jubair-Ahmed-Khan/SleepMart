@extends('layouts.app')

@section('title', 'Order Confirmed | SleepMart')

@section('content')

<div class="bg-gray-50 py-16">

    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

        <div class="rounded-3xl bg-white
                    border border-gray-200
                    p-8 text-center shadow-sm">

            {{-- Success Icon --}}
            <div class="mx-auto flex h-20 w-20
                        items-center justify-center
                        rounded-full bg-teal-100">

                <svg
                    class="h-10 w-10 text-teal-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

            </div>

            <h1 class="mt-6 text-3xl font-bold text-gray-900">
                Order Confirmed!
            </h1>

            <p class="mt-3 text-gray-600">
                Thank you for shopping with SleepMart.
                Your order has been received successfully.
            </p>

            {{-- Order Number --}}
            <div class="mt-8 rounded-2xl bg-gray-50 p-5">

                <p class="text-sm text-gray-500">
                    Your Order Number
                </p>

                <p class="mt-2 text-2xl font-bold text-teal-600">
                    {{ $order->order_number }}
                </p>

            </div>

            {{-- Order Info --}}
            <div class="mt-6 grid grid-cols-1
                        gap-4 sm:grid-cols-3">

                <div class="rounded-xl border border-gray-200 p-4">
                    <p class="text-xs text-gray-500">
                        Payment
                    </p>

                    <p class="mt-1 font-semibold text-gray-900">
                        Cash on Delivery
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 p-4">
                    <p class="text-xs text-gray-500">
                        Status
                    </p>

                    <p class="mt-1 font-semibold text-amber-600">
                        Pending
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 p-4">
                    <p class="text-xs text-gray-500">
                        Total
                    </p>

                    <p class="mt-1 font-semibold text-gray-900">
                        ৳{{ number_format(
                            $order->total,
                            2
                        ) }}
                    </p>
                </div>

            </div>

            {{-- Delivery --}}
            <div class="mt-8 text-left">

                <h2 class="text-lg font-bold text-gray-900">
                    Delivery Information
                </h2>

                <div class="mt-3 rounded-xl
                            border border-gray-200 p-5">

                    <p class="font-semibold text-gray-900">
                        {{ $order->name }}
                    </p>

                    <p class="mt-1 text-gray-600">
                        {{ $order->phone }}
                    </p>

                    @if($order->email)
                        <p class="text-gray-600">
                            {{ $order->email }}
                        </p>
                    @endif

                    <p class="mt-3 text-gray-700">
                        {{ $order->address }}
                    </p>

                    <p class="mt-1 text-gray-600">
                        {{ $order->upazila }},
                        {{ $order->district }},
                        {{ $order->division }}
                    </p>

                    @if($order->delivery_note)
                        <div class="mt-4 rounded-lg
                                    bg-gray-50 p-3">

                            <p class="text-xs font-semibold
                                      text-gray-500">
                                Delivery Note
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $order->delivery_note }}
                            </p>

                        </div>
                    @endif

                </div>

            </div>

            {{-- Items --}}
            <div class="mt-8 text-left">

                <h2 class="text-lg font-bold text-gray-900">
                    Order Items
                </h2>

                <div class="mt-3 divide-y
                            divide-gray-200
                            rounded-xl border
                            border-gray-200">

                    @foreach($order->items as $item)

                        <div class="flex items-center
                                    justify-between p-4">

                            <div>

                                <p class="font-medium text-gray-900">
                                    {{ $item->product_name }}
                                </p>

                                @if($item->variant_name)
                                    <p class="mt-1 text-sm
                                              text-gray-500">
                                        {{ $item->variant_name }}
                                    </p>
                                @endif

                                <p class="mt-1 text-sm text-gray-500">
                                    Qty: {{ $item->quantity }}
                                </p>

                            </div>

                            <p class="font-semibold text-gray-900">
                                ৳{{ number_format(
                                    $item->subtotal,
                                    2
                                ) }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Actions --}}
            <div class="mt-8 flex flex-col
                        gap-3 sm:flex-row
                        sm:justify-center">

                <a
                    href="{{ route('products.index') }}"
                    class="rounded-xl bg-teal-600
                           px-6 py-3 text-sm font-semibold
                           text-white
                           hover:bg-teal-700 transition"
                >
                    Continue Shopping
                </a>

                <a
                    href="{{ route('dashboard') }}"
                    class="rounded-xl border border-gray-300
                           px-6 py-3 text-sm font-semibold
                           text-gray-700
                           hover:bg-gray-50 transition"
                >
                    My Dashboard
                </a>

            </div>

        </div>

    </div>

</div>

@endsection