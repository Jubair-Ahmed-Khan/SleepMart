@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <div class="flex items-center gap-3">

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="text-gray-500 hover:text-gray-900"
                >
                    ←
                </a>

                <h1 class="text-2xl font-bold text-gray-900">
                    Order #{{ $order->order_number }}
                </h1>

            </div>

            <p class="mt-1 text-sm text-gray-500">
                Placed on {{ $order->created_at->format('d M Y, h:i A') }}
            </p>

        </div>


        @php
            $statusClasses = [
                'pending' =>
                    'bg-yellow-100 text-yellow-700',

                'confirmed' =>
                    'bg-blue-100 text-blue-700',

                'processing' =>
                    'bg-indigo-100 text-indigo-700',

                'shipped' =>
                    'bg-purple-100 text-purple-700',

                'delivered' =>
                    'bg-green-100 text-green-700',

                'cancelled' =>
                    'bg-red-100 text-red-700',
            ];

            $statusLabels = [
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled',
            ];
        @endphp


        <span
            class="inline-flex self-start px-4 py-2 rounded-full text-sm font-semibold
                {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700' }}"
        >
            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
        </span>

    </div>


    <!-- {{-- Alerts --}}
    @if(session('success'))

        <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>

    @endif -->


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left --}}
        <div class="lg:col-span-2 space-y-6">


            {{-- Products --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <h2 class="text-lg font-bold text-gray-900">
                        Order Items
                    </h2>

                </div>


                <div class="divide-y divide-gray-100">

                    @foreach($order->items as $item)

                        <div class="p-6 flex gap-4">

                            {{-- Image --}}
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">

                                @if($item->thumbnail)

                                    <img
                                        src="{{ asset('storage/' . $item->thumbnail) }}"
                                        alt="{{ $item->product_name }}"
                                        class="w-full h-full object-cover"
                                    >

                                @else

                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        📦
                                    </div>

                                @endif

                            </div>


                            {{-- Info --}}
                            <div class="flex-1">

                                <h3 class="font-semibold text-gray-900">
                                    {{ $item->product_name }}
                                </h3>


                                @if($item->variant_name)

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $item->variant_name }}
                                    </p>

                                @endif


                                <div class="flex flex-wrap gap-3 text-xs text-gray-500 mt-2">

                                    @if($item->size)

                                        <span>
                                            Size: {{ $item->size }}
                                        </span>

                                    @endif

                                    @if($item->thickness)

                                        <span>
                                            Thickness: {{ $item->thickness }}
                                        </span>

                                    @endif

                                </div>


                                <p class="text-sm text-gray-600 mt-2">

                                    ৳{{ number_format($item->price, 2) }}
                                    ×
                                    {{ $item->quantity }}

                                </p>

                            </div>


                            {{-- Subtotal --}}
                            <div class="text-right">

                                <p class="font-bold text-gray-900">
                                    ৳{{ number_format($item->subtotal, 2) }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- Price Summary --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                <h2 class="text-lg font-bold text-gray-900 mb-5">
                    Order Summary
                </h2>


                <div class="space-y-3 text-sm">

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Subtotal
                        </span>

                        <span class="font-medium">
                            ৳{{ number_format($order->subtotal, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Delivery Charge
                        </span>

                        <span class="font-medium">
                            ৳{{ number_format($order->delivery_charge, 2) }}
                        </span>

                    </div>


                    <div class="border-t border-gray-100 pt-3 flex justify-between">

                        <span class="text-base font-bold">
                            Total
                        </span>

                        <span class="text-xl font-bold text-blue-600">
                            ৳{{ number_format($order->total, 2) }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Right --}}
        <div class="space-y-6">


            {{-- Customer --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                <h2 class="text-lg font-bold text-gray-900 mb-5">
                    Customer
                </h2>

                <div class="space-y-4">

                    <div>

                        <p class="text-xs text-gray-500">
                            Name
                        </p>

                        <p class="font-medium text-gray-900 mt-1">
                            {{ $order->customer_name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-gray-500">
                            Phone
                        </p>

                        <p class="font-medium text-gray-900 mt-1">
                            {{ $order->phone }}
                        </p>

                    </div>


                    @if($order->user)

                        <div>

                            <p class="text-xs text-gray-500">
                                Email
                            </p>

                            <p class="font-medium text-gray-900 mt-1 break-all">
                                {{ $order->user->email }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Delivery --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                <h2 class="text-lg font-bold text-gray-900 mb-5">
                    Delivery Address
                </h2>

                <div class="space-y-3 text-sm">

                    <p class="text-gray-700">
                        {{ $order->address }}
                    </p>


                    <p class="text-gray-600">

                        {{ $order->upazila }},
                        {{ $order->district }},
                        {{ $order->division }}

                    </p>

                </div>

            </div>


            {{-- Payment --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                <h2 class="text-lg font-bold text-gray-900 mb-5">
                    Payment
                </h2>

                <div class="space-y-4">

                    <div>

                        <p class="text-xs text-gray-500">
                            Method
                        </p>

                        <p class="font-medium text-gray-900 mt-1">
                            {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-gray-500">
                            Payment Status
                        </p>

                        <p class="font-medium text-gray-900 mt-1">
                            {{ ucfirst($order->payment_status) }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Update Status --}}
            @if(
                !in_array(
                    $order->status,
                    ['delivered', 'cancelled']
                )
            )

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                    <h2 class="text-lg font-bold text-gray-900 mb-5">
                        Update Status
                    </h2>

                    <form
                        method="POST"
                        action="{{ route('admin.orders.status.update', $order) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <select
                            name="status"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white focus:ring-2 focus:ring-blue-500 outline-none"
                        >

                            @foreach([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ] as $value => $label)

                                @php
                                    $allowedTransitions = [
                                        'pending' => ['confirmed', 'cancelled'],
                                        'confirmed' => ['processing', 'cancelled'],
                                        'processing' => ['shipped', 'cancelled'],
                                        'shipped' => ['delivered', 'cancelled'],
                                    ];
                                @endphp

                                @if(
                                    in_array(
                                        $value,
                                        $allowedTransitions[$order->order_status] ?? [],
                                        true
                                    )
                                )

                                    <option value="{{ $value }}">
                                        {{ $label }}
                                    </option>

                                @endif

                            @endforeach

                        </select>


                        <button
                            type="submit"
                            class="w-full mt-4 px-5 py-3 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition"
                        >
                            Update Order Status
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection