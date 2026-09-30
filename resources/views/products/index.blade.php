@extends('layouts.app')

@section('title', 'Shop - SleepMart')

@section('content')

<div class="mx-auto max-w-7xl px-4 py-10 sm:py-14">

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">
            SleepMart Collection
        </p>

        <h1 class="mt-2 text-3xl font-bold text-slate-900 sm:text-4xl">
            Mattresses & Pillows
        </h1>

        <p class="mt-3 max-w-2xl text-slate-500">
            Find comfortable mattresses and pillows designed for
            better sleep.
        </p>

    </div>


    <div class="grid gap-8 lg:grid-cols-[250px_1fr]">


        {{-- Filters --}}
        <aside>

            <form
                method="GET"
                action="{{ route('products.index') }}"
                class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200"
            >

                <div class="flex items-center justify-between">

                    <h2 class="font-bold text-slate-900">
                        Filters
                    </h2>

                    <a
                        href="{{ route('products.index') }}"
                        class="text-xs font-medium text-teal-700"
                    >
                        Clear
                    </a>

                </div>


                {{-- Search --}}
                <div class="mt-6">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600"
                    >

                </div>


                {{-- Category --}}
                <div class="mt-5">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Category
                    </label>

                    <select
                        name="category"
                        class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600"
                    >

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->slug }}"
                                @selected(request('category') === $category->slug)
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Price --}}
                <div class="mt-5">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Price Range
                    </label>

                    <div class="grid grid-cols-2 gap-2">

                        <input
                            type="number"
                            name="min_price"
                            value="{{ request('min_price') }}"
                            placeholder="Min"
                            min="0"
                            class="w-full rounded-xl border-slate-300 px-3 py-3 text-sm"
                        >

                        <input
                            type="number"
                            name="max_price"
                            value="{{ request('max_price') }}"
                            placeholder="Max"
                            min="0"
                            class="w-full rounded-xl border-slate-300 px-3 py-3 text-sm"
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    class="mt-6 w-full rounded-xl bg-teal-700 px-4 py-3 font-semibold text-white transition hover:bg-teal-800"
                >
                    Apply Filters
                </button>

            </form>

        </aside>


        {{-- Products --}}
        <section>

            {{-- Toolbar --}}
            <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                <p class="text-sm text-slate-500">

                    Showing
                    <span class="font-semibold text-slate-900">
                        {{ $products->firstItem() ?? 0 }}
                    </span>

                    -
                    <span class="font-semibold text-slate-900">
                        {{ $products->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-semibold text-slate-900">
                        {{ $products->total() }}
                    </span>

                    products

                </p>


                <form
                    method="GET"
                    action="{{ route('products.index') }}"
                >

                    @foreach(request()->except('sort', 'page') as $key => $value)

                        <input
                            type="hidden"
                            name="{{ $key }}"
                            value="{{ $value }}"
                        >

                    @endforeach

                    <select
                        name="sort"
                        onchange="this.form.submit()"
                        class="rounded-xl border-slate-300 px-4 py-2.5 text-sm"
                    >

                        <option
                            value="latest"
                            @selected(request('sort', 'latest') === 'latest')
                        >
                            Latest
                        </option>

                        <option
                            value="price_low"
                            @selected(request('sort') === 'price_low')
                        >
                            Price: Low to High
                        </option>

                        <option
                            value="price_high"
                            @selected(request('sort') === 'price_high')
                        >
                            Price: High to Low
                        </option>

                        <option
                            value="rating"
                            @selected(request('sort') === 'rating')
                        >
                            Highest Rated
                        </option>

                    </select>

                </form>

            </div>


            {{-- Product grid --}}
            @if($products->count())

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

                    @foreach($products as $product)

                        <x-product-card :product="$product" />

                    @endforeach

                </div>


                {{-- Pagination --}}
                <div class="mt-10">

                    {{ $products->links() }}

                </div>

            @else

                <div class="rounded-2xl bg-white p-12 text-center shadow-sm ring-1 ring-slate-200">

                    <div class="text-6xl">
                        🔎
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-slate-900">
                        No products found
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Try changing your search or filters.
                    </p>

                    <a
                        href="{{ route('products.index') }}"
                        class="mt-6 inline-block rounded-xl bg-teal-700 px-5 py-3 font-semibold text-white"
                    >
                        View All Products
                    </a>

                </div>

            @endif

        </section>

    </div>

</div>

@endsection