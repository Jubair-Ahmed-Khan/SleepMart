@extends('layouts.app')

@section('title', 'Order ' . $order->order_number . ' | SleepMart')

@section('content')

<div class="bg-gray-50 py-10">

    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-6">

            <a
                href="{{ route('orders.index') }}"
                class="text-sm font-medium text-teal-600
                       hover:text-teal-700"
            >
                ← Back to My Orders
            </a>

            <div class="mt-4 flex flex-col gap-3
                        sm:flex-row sm:items-center
                        sm:justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Order Number
                    </p>

                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $order->order_number }}
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $order->created_at->format(
                            'd M Y, h:i A'
                        ) }}
                    </p>

                </div>

                <span
                    class="inline-flex w-fit
                           rounded-full
                           bg-amber-100
                           px-4 py-2
                           text-sm font-semibold
                           text-amber-700"
                >
                    {{ ucfirst($order->order_status) }}
                </span>

            </div>

        </div>


        <div class="grid grid-cols-1
                    gap-6 lg:grid-cols-3">

            {{-- Items --}}
            <div class="lg:col-span-2">

                <div class="rounded-2xl bg-white
                            border border-gray-200">

                    <div class="border-b border-gray-200 p-6">

                        <h2 class="text-xl font-bold text-gray-900">
                            Order Items
                        </h2>

                    </div>

                    <div class="divide-y divide-gray-200">

                        @foreach($order->items as $item)

                            <div class="p-6">

                                <div class="flex items-start
                                            justify-between gap-4">

                                    <div>

                                        <h3 class="font-semibold
                                                   text-gray-900">
                                            {{ $item->product_name }}
                                        </h3>

                                        @if($item->variant_name)

                                            <p class="mt-1 text-sm
                                                      text-gray-500">
                                                {{ $item->variant_name }}
                                            </p>

                                        @endif

                                        @if($item->sku)

                                            <p class="mt-1 text-xs
                                                      text-gray-400">
                                                SKU: {{ $item->sku }}
                                            </p>

                                        @endif

                                        <p class="mt-2 text-sm
                                                  text-gray-500">
                                            ৳{{ number_format(
                                                $item->unit_price,
                                                2
                                            ) }}
                                            ×
                                            {{ $item->quantity }}
                                        </p>

                                    </div>

                                    <div class="text-right">

                                        <p class="font-bold
                                                  text-gray-900">
                                            ৳{{ number_format(
                                                $item->subtotal,
                                                2
                                            ) }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- Summary --}}
            <div class="space-y-6">

                <div class="rounded-2xl bg-white
                            border border-gray-200 p-6">

                    <h2 class="text-lg font-bold text-gray-900">
                        Order Summary
                    </h2>

                    <div class="mt-5 space-y-3">

                        <div class="flex justify-between">
                            <span class="text-gray-600">
                                Subtotal
                            </span>

                            <span class="font-medium">
                                ৳{{ number_format(
                                    $order->subtotal,
                                    2
                                ) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">
                                Delivery
                            </span>

                            <span class="font-medium">
                                ৳{{ number_format(
                                    $order->shipping_charge,
                                    2
                                ) }}
                            </span>
                        </div>

                        <div class="border-t border-gray-200 pt-3">

                            <div class="flex justify-between">

                                <span class="text-lg font-bold">
                                    Total
                                </span>

                                <span class="text-xl font-bold
                                             text-teal-600">
                                    ৳{{ number_format(
                                        $order->total,
                                        2
                                    ) }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Delivery Information --}}
                <div class="rounded-2xl bg-white
                            border border-gray-200 p-6">

                    <h2 class="text-lg font-bold text-gray-900">
                        Delivery Information
                    </h2>

                    <div class="mt-4 space-y-2 text-sm">

                        <p class="font-semibold text-gray-900">
                            {{ $order->name }}
                        </p>

                        <p class="text-gray-600">
                            {{ $order->phone }}
                        </p>

                        @if($order->email)
                            <p class="text-gray-600">
                                {{ $order->email }}
                            </p>
                        @endif

                        <p class="pt-2 text-gray-700">
                            {{ $order->address }}
                        </p>

                        <p class="text-gray-600">
                            {{ $order->upazila }},
                            {{ $order->district }},
                            {{ $order->division }}
                        </p>

                    </div>

                    @if($order->delivery_note)

                        <div class="mt-5 rounded-xl
                                    bg-gray-50 p-4">

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


                {{-- Payment --}}
                <div class="rounded-2xl bg-white
                            border border-gray-200 p-6">

                    <h2 class="text-lg font-bold text-gray-900">
                        Payment
                    </h2>

                    <div class="mt-4">

                        <p class="font-semibold text-gray-900">
                            Cash on Delivery
                        </p>

                        <p class="mt-1 text-sm text-gray-500">
                            Payment will be collected when your
                            order is delivered.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection