@extends('layouts.app')

@section('title', 'My Orders | SleepMart')

@section('content')

<div class="bg-gray-50 py-10">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                My Orders
            </h1>

            <p class="mt-2 text-gray-600">
                View your SleepMart order history and order status.
            </p>
        </div>

        @if($orders->isEmpty())

            {{-- Empty State --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-12 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                    <span class="text-2xl">📦</span>
                </div>

                <h2 class="mt-5 text-xl font-bold text-gray-900">
                    No orders yet
                </h2>

                <p class="mt-2 text-gray-500">
                    You haven't placed any orders yet.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="mt-6 inline-flex items-center justify-center rounded-xl bg-teal-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-teal-700"
                >
                    Start Shopping
                </a>

            </div>

        @else

            {{-- Orders List --}}
            <div class="space-y-4">

                @foreach($orders as $order)

                    @php
                        $statusClasses = [
                            'pending' => 'bg-amber-100 text-amber-700',
                            'confirmed' => 'bg-blue-100 text-blue-700',
                            'processing' => 'bg-indigo-100 text-indigo-700',
                            'shipped' => 'bg-purple-100 text-purple-700',
                            'delivered' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                        ];

                        $status = strtolower($order->order_status ?? 'pending');

                        $statusLabels = [
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
                        ];
                    @endphp

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">

                        <div class="grid grid-cols-2 gap-x-4 gap-y-6
                                    md:grid-cols-3
                                    lg:grid-cols-[minmax(0,2fr)_minmax(55px,0.65fr)_minmax(145px,1.4fr)_minmax(100px,1fr)_minmax(125px,1.2fr)_auto]
                                    lg:items-center lg:gap-x-5 lg:gap-y-0">

                            {{-- Order Number --}}
                            <div class="min-w-0 col-span-2 md:col-span-1">

                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Order Number
                                </p>

                                <p
                                    class="mt-2 truncate text-base font-bold text-gray-900 sm:text-lg"
                                    title="{{ $order->order_number }}"
                                >
                                    {{ $order->order_number }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </p>

                            </div>

                            {{-- Items --}}
                            <div class="min-w-0">

                                <p class="text-xs text-gray-500">
                                    Items
                                </p>

                                <p class="mt-2 font-semibold text-gray-900">
                                    {{ $order->items_count }}
                                </p>

                            </div>

                            {{-- Payment --}}
                            <div class="min-w-0">

                                <p class="text-xs text-gray-500">
                                    Payment
                                </p>

                                <p class="mt-2 break-words text-sm font-semibold text-gray-900 sm:text-base">
                                    {{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'cod')) === 'Cod'
                                        ? 'Cash on Delivery'
                                        : ucwords(str_replace('_', ' ', $order->payment_method ?? 'cod')) }}
                                </p>

                            </div>

                            {{-- Status --}}
                            <div class="min-w-0">

                                <p class="text-xs text-gray-500">
                                    Status
                                </p>

                                <div class="mt-2">
                                    <span
                                        class="inline-flex max-w-full items-center justify-center whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-700' }}"
                                    >
                                        {{ $statusLabels[$status] ?? ucfirst($status) }}
                                    </span>
                                </div>

                            </div>

                            {{-- Total --}}
                            <div class="min-w-0">

                                <p class="text-xs text-gray-500">
                                    Total
                                </p>

                                <p class="mt-2 whitespace-nowrap text-base font-bold text-teal-600 sm:text-lg">
                                    ৳{{ number_format((float) $order->total, 2) }}
                                </p>

                            </div>

                            {{-- View Details --}}
                            <div class="col-span-2 md:col-span-1 md:col-start-3 lg:col-span-1 lg:col-start-auto">

                                <a
                                    href="{{ route('orders.show', $order) }}"
                                    class="inline-flex min-h-10 w-full items-center justify-center whitespace-nowrap rounded-xl border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 lg:w-auto"
                                >
                                    View Details
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
