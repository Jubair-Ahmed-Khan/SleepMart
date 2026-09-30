@extends('layouts.app')

@section('title', 'SleepMart - Premium Mattresses & Pillows')

@section('content')

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-teal-50 via-white to-amber-50">

        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 md:grid-cols-2 md:py-24">

            <div>

                <span
                    class="inline-flex rounded-full bg-teal-100 px-4 py-2 text-sm font-semibold text-teal-800"
                >
                    🇧🇩 Nationwide Delivery in Bangladesh
                </span>

                <h1
                    class="mt-6 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl"
                >
                    Sleep Better.
                    <span class="text-teal-700">
                        Live Better.
                    </span>
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                    Discover comfortable mattresses and premium pillows
                    designed to give you a better night's sleep.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">

                    <a
                        href="{{ route('products.index') }}"
                        class="rounded-xl bg-teal-700 px-6 py-3.5 font-semibold text-white shadow-lg shadow-teal-700/20 transition hover:bg-teal-800"
                    >
                        Shop Now
                    </a>

                    <a
                        href="{{ route('products.index') }}"
                        class="rounded-xl border border-slate-300 bg-white px-6 py-3.5 font-semibold text-slate-700 transition hover:border-teal-600 hover:text-teal-700"
                    >
                        Explore Mattresses
                    </a>

                </div>

                <div class="mt-8 flex flex-wrap gap-6 text-sm text-slate-600">

                    <div class="flex items-center gap-2">
                        <span class="text-lg">✓</span>
                        Quality Products
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-lg">✓</span>
                        COD Available
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-lg">✓</span>
                        Nationwide Delivery
                    </div>

                </div>

            </div>


            {{-- Hero Image Placeholder --}}
            <div
                class="relative flex min-h-[360px] items-center justify-center overflow-hidden rounded-3xl bg-teal-100"
            >

                <div class="text-center">

                    <div class="text-8xl">
                        🛏️
                    </div>

                    <p class="mt-4 text-lg font-semibold text-teal-800">
                        Premium Sleep Collection
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- Categories --}}
    <section class="mx-auto max-w-7xl px-4 py-16">

        <div class="text-center">

            <p class="font-semibold text-teal-700">
                SHOP BY CATEGORY
            </p>

            <h2 class="mt-2 text-3xl font-bold text-slate-900">
                Find Your Perfect Comfort
            </h2>

            <p class="mx-auto mt-3 max-w-2xl text-slate-500">
                Choose from our collection of mattresses and pillows
                designed for comfortable sleep.
            </p>

        </div>


        <div class="mt-10 grid gap-6 md:grid-cols-2">

            {{-- Mattress --}}
            <a
                href="{{ route('products.index') }}"
                class="group relative overflow-hidden rounded-3xl bg-slate-100 p-8 transition hover:-translate-y-1 hover:shadow-xl"
            >

                <div class="relative z-10">

                    <p class="text-sm font-semibold text-teal-700">
                        PREMIUM COLLECTION
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-slate-900">
                        Mattresses
                    </h3>

                    <p class="mt-3 max-w-sm text-slate-600">
                        Memory foam, orthopedic and premium mattresses
                        for restful nights.
                    </p>

                    <span class="mt-6 inline-block font-semibold text-teal-700">
                        Shop Mattresses →
                    </span>

                </div>

                <div
                    class="absolute -bottom-8 -right-4 text-9xl opacity-20 transition group-hover:scale-110"
                >
                    🛏️
                </div>

            </a>


            {{-- Pillows --}}
            <a
                href="{{ route('products.index') }}"
                class="group relative overflow-hidden rounded-3xl bg-amber-50 p-8 transition hover:-translate-y-1 hover:shadow-xl"
            >

                <div class="relative z-10">

                    <p class="text-sm font-semibold text-amber-700">
                        COMFORT COLLECTION
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-slate-900">
                        Pillows
                    </h3>

                    <p class="mt-3 max-w-sm text-slate-600">
                        Soft, supportive and premium pillows for
                        better neck and head support.
                    </p>

                    <span class="mt-6 inline-block font-semibold text-amber-700">
                        Shop Pillows →
                    </span>

                </div>

                <div
                    class="absolute -bottom-8 -right-4 text-9xl opacity-20 transition group-hover:scale-110"
                >
                    💤
                </div>

            </a>

        </div>

    </section>


    {{-- Why Choose Us --}}
    <section class="bg-white">

        <div class="mx-auto max-w-7xl px-4 py-16">

            <div class="text-center">

                <p class="font-semibold text-teal-700">
                    WHY SLEEPMART
                </p>

                <h2 class="mt-2 text-3xl font-bold text-slate-900">
                    Everything You Need for Better Sleep
                </h2>

            </div>


            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-2xl border border-slate-200 p-6 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-2xl">
                        ✓
                    </div>

                    <h3 class="mt-4 font-bold">
                        Quality Products
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Carefully selected products for comfortable sleep.
                    </p>

                </div>


                <div class="rounded-2xl border border-slate-200 p-6 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-2xl">
                        🚚
                    </div>

                    <h3 class="mt-4 font-bold">
                        Nationwide Delivery
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        We deliver across Bangladesh.
                    </p>

                </div>


                <div class="rounded-2xl border border-slate-200 p-6 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                        💳
                    </div>

                    <h3 class="mt-4 font-bold">
                        Easy Payment
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Cash on delivery and online payment options.
                    </p>

                </div>


                <div class="rounded-2xl border border-slate-200 p-6 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-2xl">
                        🤝
                    </div>

                    <h3 class="mt-4 font-bold">
                        Customer Support
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        We're here to help with your order.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection