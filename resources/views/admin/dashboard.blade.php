@extends('layouts.admin')

@section('title', 'Admin Dashboard | SleepMart')

@section('page-title', 'Dashboard')

@section('content')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">
            Welcome to SleepMart Admin
        </h2>

        <p class="mt-1 text-gray-500">
            Manage your store from this dashboard.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Products -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Active Products
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $productCount }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-teal-100
                           flex items-center justify-center text-2xl"
                >
                    🛍️
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Active Categories
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $categoryCount }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-cyan-100
                           flex items-center justify-center text-2xl"
                >
                    📂
                </div>
            </div>
        </div>

        <!-- Customers -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Customers
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $customerCount }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-blue-100
                           flex items-center justify-center text-2xl"
                >
                    👥
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Low Stock
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $lowStockCount }}
                    </p>
                </div>

                <div
                    class="w-12 h-12 rounded-xl bg-orange-100
                           flex items-center justify-center text-2xl"
                >
                    ⚠️
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

        <h3 class="text-lg font-bold text-gray-900">
            Quick Actions
        </h3>

        <p class="mt-1 text-sm text-gray-500">
            Quickly access common store management tasks.
        </p>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

            <a
                href="{{ route('admin.products.index') }}"
                class="group flex items-center gap-4 p-5
                       rounded-xl border border-gray-200
                       hover:border-teal-300 hover:bg-teal-50
                       transition"
            >
                <div
                    class="w-12 h-12 rounded-xl bg-teal-100
                           flex items-center justify-center text-2xl
                           group-hover:bg-teal-200 transition"
                >
                    🛍️
                </div>

                <div>
                    <h4 class="font-semibold text-gray-900">
                        Manage Products
                    </h4>

                    <p class="text-sm text-gray-500">
                        View products and manage product images.
                    </p>
                </div>
            </a>

            <a
                href="{{ route('products.index') }}"
                class="group flex items-center gap-4 p-5
                       rounded-xl border border-gray-200
                       hover:border-cyan-300 hover:bg-cyan-50
                       transition"
            >
                <div
                    class="w-12 h-12 rounded-xl bg-cyan-100
                           flex items-center justify-center text-2xl
                           group-hover:bg-cyan-200 transition"
                >
                    🌐
                </div>

                <div>
                    <h4 class="font-semibold text-gray-900">
                        View Store
                    </h4>

                    <p class="text-sm text-gray-500">
                        Open the customer-facing storefront.
                    </p>
                </div>
            </a>

        </div>

    </div>

@endsection