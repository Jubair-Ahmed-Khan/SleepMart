@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900">
            Dashboard
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Overview of your SleepMart store.
        </p>
    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Total Sales --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Sales
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        ৳{{ number_format((float) $totalSales, 0) }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl
                           bg-green-100
                           flex items-center justify-center
                           text-2xl"
                >
                    ৳
                </div>

            </div>

        </div>


        {{-- Total Orders --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Orders
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($totalOrders) }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl
                           bg-blue-100
                           flex items-center justify-center
                           text-2xl"
                >
                    📦
                </div>

            </div>

        </div>


        {{-- Pending Orders --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Pending Orders
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($pendingOrders) }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl
                           bg-orange-100
                           flex items-center justify-center
                           text-2xl"
                >
                    ⏳
                </div>

            </div>

        </div>


        {{-- Customers --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Customers
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($customerCount) }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl
                           bg-purple-100
                           flex items-center justify-center
                           text-2xl"
                >
                    👥
                </div>

            </div>

        </div>

    </div>


    {{-- Second Statistics Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Products --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Active Products
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($productCount) }}
                    </p>
                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="text-sm font-semibold
                           text-teal-600
                           hover:text-teal-700"
                >
                    Manage →
                </a>

            </div>

        </div>


        {{-- Low Stock --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Low Stock Products
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($lowStockCount) }}
                    </p>
                </div>

                <span
                    class="px-3 py-1 rounded-full
                           bg-orange-100
                           text-orange-700
                           text-xs font-semibold"
                >
                    ≤ 5 items
                </span>

            </div>

        </div>

    </div>


    {{-- Recent Orders --}}
    <div
        class="bg-white rounded-2xl
               border border-gray-100
               shadow-sm overflow-hidden"
    >

        <div
            class="p-6 border-b border-gray-100
                   flex items-center justify-between"
        >

            <div>

                <h2 class="text-lg font-bold text-gray-900">
                    Recent Orders
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Latest customer orders.
                </p>

            </div>

            <a
                href="{{ route('orders.index') }}"
                class="text-sm font-semibold
                       text-teal-600
                       hover:text-teal-700"
            >
                View Orders →
            </a>

        </div>


        @if($recentOrders->isNotEmpty())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left font-semibold text-gray-600">
                                Order
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-gray-600">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-gray-600">
                                Total
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-gray-600">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-gray-600">
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($recentOrders as $order)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <span class="font-semibold text-gray-900">
                                        {{ $order->order_number }}
                                    </span>

                                </td>


                                <td class="px-6 py-4">

                                    <p class="font-medium text-gray-900">
                                        {{ $order->name }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $order->phone }}
                                    </p>

                                </td>


                                <td class="px-6 py-4 font-semibold">
                                    ৳{{ number_format((float) $order->total, 0) }}
                                </td>


                                <td class="px-6 py-4">

                                    @php
                                        $statusClasses = match ($order->order_status) {
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'confirmed' => 'bg-blue-100 text-blue-700',
                                            'processing' => 'bg-indigo-100 text-indigo-700',
                                            'shipped' => 'bg-purple-100 text-purple-700',
                                            'delivered' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span
                                        class="px-3 py-1 rounded-full
                                               text-xs font-semibold
                                               {{ $statusClasses }}"
                                    >
                                        {{ ucfirst($order->order_status) }}
                                    </span>

                                </td>


                                <td class="px-6 py-4 text-gray-500">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="p-10 text-center text-gray-500">
                No orders yet.
            </div>

        @endif

    </div>

</div>

@endsection