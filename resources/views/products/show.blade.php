@extends('layouts.app')

@section('title', $product->name . ' - SleepMart')

@section('content')

<div class="mx-auto max-w-7xl px-4 py-10 sm:py-14">

    {{-- Breadcrumb --}}
    <nav class="mb-8 text-sm text-slate-500">

        <a
            href="{{ route('home') }}"
            class="hover:text-teal-700"
        >
            Home
        </a>

        <span class="mx-2">
            /
        </span>

        <a
            href="{{ route('products.index') }}"
            class="hover:text-teal-700"
        >
            Shop
        </a>

        <span class="mx-2">
            /
        </span>

        <span class="text-slate-900">
            {{ $product->name }}
        </span>

    </nav>


    {{-- Product --}}
    <div class="grid gap-10 lg:grid-cols-2">


        {{-- Product Image --}}
        <div>

            <div class="aspect-square overflow-hidden rounded-3xl bg-slate-100">

                @if($product->thumbnail)

                    <img
                        src="{{ asset('storage/' . $product->thumbnail) }}"
                        alt="{{ $product->name }}"
                        class="h-full w-full object-cover"
                    >

                @else

                    <div class="flex h-full items-center justify-center">

                        @if($product->category->slug === 'mattresses')
                            <span class="text-[150px]">
                                🛏️
                            </span>
                        @else
                            <span class="text-[150px]">
                                💤
                            </span>
                        @endif

                    </div>

                @endif

            </div>

        </div>


        {{-- Information --}}
        <div>

            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">
                {{ $product->category->name }}
            </p>


            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                {{ $product->name }}
            </h1>


            {{-- Rating --}}
            <div class="mt-4 flex items-center gap-2">

                <span class="text-lg text-amber-500">
                    ★★★★★
                </span>

                <span class="font-semibold">
                    {{ number_format($product->rating, 1) }}
                </span>

                <span class="text-slate-400">
                    ({{ $product->reviews_count }} reviews)
                </span>

            </div>


            {{-- Price --}}
            <div class="mt-6 flex items-center gap-3">

                <span class="text-3xl font-bold text-slate-900">
                    ৳{{ number_format($product->selling_price) }}
                </span>

                @if($product->regular_price > $product->selling_price)

                    <span class="text-lg text-slate-400 line-through">
                        ৳{{ number_format($product->regular_price) }}
                    </span>

                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-bold text-red-600">
                        -{{ $product->discount_percentage }}%
                    </span>

                @endif

            </div>


            {{-- Description --}}
            <div class="mt-6 border-t border-slate-200 pt-6">

                <p class="leading-7 text-slate-600">
                    {{ $product->short_description }}
                </p>

            </div>


            {{-- Variants --}}
            @if($product->variants->count())

                <div class="mt-6">

                    <h2 class="font-semibold text-slate-900">
                        Select Size / Variant
                    </h2>

                    <div class="mt-3 grid gap-3 sm:grid-cols-2">

                        @foreach($product->variants as $variant)

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="variant_id"
                                    value="{{ $variant->id }}"
                                    class="peer sr-only"
                                    @checked($loop->first)
                                >

                                <div
                                    class="rounded-xl border border-slate-300 p-4 transition peer-checked:border-teal-700 peer-checked:bg-teal-50"
                                >

                                    <div class="font-semibold text-slate-900">
                                        {{ $variant->name }}
                                    </div>

                                    <div class="mt-1 text-sm text-slate-500">
                                        SKU: {{ $variant->sku }}
                                    </div>

                                    <div class="mt-2 font-bold text-teal-700">
                                        ৳{{ number_format($variant->price) }}
                                    </div>

                                    @if($variant->stock > 0)

                                        <div class="mt-1 text-xs text-emerald-600">
                                            In Stock
                                        </div>

                                    @else

                                        <div class="mt-1 text-xs text-red-600">
                                            Out of Stock
                                        </div>

                                    @endif

                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- Quantity --}}
            <div class="mt-6">

                <label class="mb-2 block font-semibold text-slate-900">
                    Quantity
                </label>

                <div class="flex w-32 items-center rounded-xl border border-slate-300">

                    <button
                        type="button"
                        class="flex h-11 w-10 items-center justify-center text-lg"
                    >
                        −
                    </button>

                    <input
                        type="number"
                        value="1"
                        min="1"
                        class="h-11 w-12 border-0 p-0 text-center focus:ring-0"
                    >

                    <button
                        type="button"
                        class="flex h-11 w-10 items-center justify-center text-lg"
                    >
                        +
                    </button>

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-6 flex flex-col gap-3 sm:flex-row">

                <button
                    type="button"
                    class="flex-1 rounded-xl bg-teal-700 px-6 py-4 font-semibold text-white transition hover:bg-teal-800"
                >
                    🛒 Add to Cart
                </button>

                <button
                    type="button"
                    class="flex h-14 w-14 items-center justify-center rounded-xl border border-slate-300 text-2xl transition hover:border-teal-700 hover:text-teal-700"
                >
                    ♡
                </button>

            </div>


            {{-- Delivery information --}}
            <div class="mt-8 rounded-2xl bg-slate-50 p-5">

                <div class="flex gap-4">

                    <div class="text-2xl">
                        🚚
                    </div>

                    <div>

                        <h3 class="font-semibold text-slate-900">
                            Delivery Across Bangladesh
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Cash on Delivery available.
                            Delivery charges will be calculated during checkout.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Description --}}
    <div class="mt-16 border-t border-slate-200 pt-12">

        <h2 class="text-2xl font-bold text-slate-900">
            Product Description
        </h2>

        <div class="mt-5 max-w-4xl leading-8 text-slate-600">
            {{ $product->description }}
        </div>

    </div>


    {{-- Related products --}}
    @if($relatedProducts->count())

        <section class="mt-16 border-t border-slate-200 pt-12">

            <h2 class="text-2xl font-bold text-slate-900">
                You May Also Like
            </h2>

            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                @foreach($relatedProducts as $relatedProduct)

                    <x-product-card :product="$relatedProduct" />

                @endforeach

            </div>

        </section>

    @endif

</div>

@endsection