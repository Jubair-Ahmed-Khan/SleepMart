@extends('layouts.app')

@section('title', 'My Dashboard | SleepMart')

@section('content')

<div class="bg-gray-50 min-h-screen">

    {{-- Welcome Section --}}
    <section class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between gap-6">

                <div>

                    <p class="text-teal-100 text-sm font-medium">
                        Welcome back
                    </p>

                    <h1 class="mt-1 text-3xl sm:text-4xl font-bold">
                        {{ auth()->user()->name }}
                    </h1>

                    <p class="mt-2 text-teal-50">
                        Manage your SleepMart account and orders.
                    </p>

                </div>


                <div
                    class="w-16 h-16 rounded-2xl
                           bg-white/20 backdrop-blur-sm
                           flex items-center justify-center
                           text-2xl font-bold"
                >
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </div>

    </section>


    {{-- Dashboard Content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Shop --}}
            <a
                href="{{ route('products.index') }}"
                class="group bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm p-6
                       hover:shadow-lg hover:-translate-y-1
                       transition duration-300"
            >

                <div
                    class="w-12 h-12 rounded-xl
                           bg-teal-50 text-teal-600
                           flex items-center justify-center
                           text-2xl
                           group-hover:bg-teal-600
                           group-hover:text-white transition"
                >
                    🛍️
                </div>

                <h2
                    class="mt-5 text-lg font-bold text-gray-900
                           group-hover:text-teal-600 transition"
                >
                    Continue Shopping
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Browse mattresses, pillows and other sleep products.
                </p>

                <div class="mt-4 text-sm font-semibold text-teal-600">
                    Shop Now →
                </div>

            </a>


            {{-- Cart --}}
            <a
                href="{{ route('cart.index') }}"
                class="group bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm p-6
                       hover:shadow-lg hover:-translate-y-1
                       transition duration-300"
            >

                <div
                    class="w-12 h-12 rounded-xl
                           bg-cyan-50 text-cyan-600
                           flex items-center justify-center
                           text-2xl
                           group-hover:bg-cyan-600
                           group-hover:text-white transition"
                >
                    🛒
                </div>

                <h2
                    class="mt-5 text-lg font-bold text-gray-900
                           group-hover:text-cyan-600 transition"
                >
                    My Cart
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    View your selected products and proceed to checkout.
                </p>

                <div class="mt-4 text-sm font-semibold text-cyan-600">
                    View Cart →
                </div>

            </a>

            {{-- Orders --}}
            <a
                href="{{ route('orders.index') }}"
                class="group rounded-2xl border border-gray-200
                    bg-white p-6 shadow-sm
                    hover:-translate-y-1
                    hover:border-teal-200
                    hover:shadow-md transition"
            >

                <div class="flex h-12 w-12 items-center
                            justify-center rounded-xl
                            bg-teal-50 text-2xl">
                    📦
                </div>

                <h3 class="mt-5 text-lg font-bold text-gray-900">
                    My Orders
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    View your order history and track order status.
                </p>

                <span class="mt-4 inline-block text-sm
                            font-semibold text-teal-600">
                    View Orders →
                </span>

            </a>


            {{-- Profile --}}
            <a
                href="{{ route('profile.edit') }}"
                class="group bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm p-6
                       hover:shadow-lg hover:-translate-y-1
                       transition duration-300"
            >

                <div
                    class="w-12 h-12 rounded-xl
                           bg-blue-50 text-blue-600
                           flex items-center justify-center
                           text-2xl
                           group-hover:bg-blue-600
                           group-hover:text-white transition"
                >
                    👤
                </div>

                <h2
                    class="mt-5 text-lg font-bold text-gray-900
                           group-hover:text-blue-600 transition"
                >
                    My Profile
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Update your name, email and account information.
                </p>

                <div class="mt-4 text-sm font-semibold text-blue-600">
                    Manage Profile →
                </div>

            </a>

        </div>


        {{-- Account Information --}}
        <div
            class="mt-8 bg-white rounded-2xl
                   border border-gray-100
                   shadow-sm p-6 sm:p-8"
        >

            <div class="flex items-center gap-4">

                <div
                    class="w-12 h-12 rounded-full
                           bg-teal-100 text-teal-700
                           flex items-center justify-center
                           font-bold text-lg"
                >
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>

                    <h2 class="text-lg font-bold text-gray-900">
                        Account Information
                    </h2>

                    <p class="text-sm text-gray-500">
                        Your SleepMart account details.
                    </p>

                </div>

            </div>


            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div>
                    <p class="text-xs font-semibold
                              uppercase tracking-wide text-gray-400">
                        Name
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ auth()->user()->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-semibold
                              uppercase tracking-wide text-gray-400">
                        Email
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Help / Information --}}
        <div
            class="mt-8 rounded-2xl
                   bg-teal-50 border border-teal-100
                   p-6"
        >

            <div class="flex gap-4">

                <div class="text-2xl">
                    💡
                </div>

                <div>

                    <h3 class="font-bold text-gray-900">
                        Need help?
                    </h3>

                    <p class="mt-1 text-sm text-gray-600">
                        For questions about your SleepMart order,
                        delivery or products, please contact our
                        customer service team.
                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
