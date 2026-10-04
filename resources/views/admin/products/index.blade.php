@extends('layouts.admin')

@section('title', 'Products | SleepMart')

@section('page-title', 'Products')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Products
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Manage your SleepMart products, variants and images.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">

            {{-- View Store --}}
            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5 rounded-lg
                       border border-gray-200
                       bg-white text-gray-700
                       text-sm font-semibold
                       hover:bg-gray-50 transition"
            >
                🌐 View Store
            </a>

            {{-- Add Product --}}
            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5 rounded-lg
                       bg-teal-600 text-white
                       text-sm font-semibold
                       hover:bg-teal-700 transition"
            >
                <span class="text-lg leading-none">+</span>
                Add Product
            </a>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div
            class="mb-6 rounded-xl
                   border border-green-200
                   bg-green-50
                   px-4 py-3
                   text-sm text-green-700"
        >
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div
            class="mb-6 rounded-xl
                   border border-red-200
                   bg-red-50
                   px-4 py-3
                   text-sm text-red-700"
        >
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div
            class="mb-6 rounded-xl
                   border border-red-200
                   bg-red-50
                   px-4 py-3"
        >
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Product Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                {{-- Table Header --}}
                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        {{-- Product --}}
                        <th
                            class="px-6 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Product
                        </th>

                        {{-- Category --}}
                        <th
                            class="px-6 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Category
                        </th>

                        {{-- Price --}}
                        <th
                            class="px-6 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Price
                        </th>

                        {{-- Stock --}}
                        <th
                            class="px-6 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Stock
                        </th>

                        {{-- Status --}}
                        <th
                            class="px-6 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Status
                        </th>

                        {{-- Images --}}
                        <th
                            class="px-6 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Images
                        </th>

                        {{-- Actions --}}
                        <th
                            class="px-6 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider"
                        >
                            Actions
                        </th>

                    </tr>

                </thead>


                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse($products as $product)

                        @php

                            /*
                             * Calculate active variant stock.
                             */
                            $activeVariants = $product->variants
                                ->where('is_active', true);

                            $totalVariantStock = $activeVariants
                                ->sum('stock');

                            $variantCount = $activeVariants->count();

                            /*
                             * Product can use either:
                             * 1. Variant stock
                             * 2. Product stock
                             */
                            $displayStock = $variantCount > 0
                                ? $totalVariantStock
                                : $product->stock;

                        @endphp


                        <tr class="hover:bg-gray-50 transition">


                            {{-- =========================
                                 PRODUCT
                            ========================== --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-4">

                                    {{-- Thumbnail --}}
                                    <div
                                        class="w-14 h-14 rounded-xl
                                               bg-gray-100 overflow-hidden
                                               flex-shrink-0"
                                    >

                                        @if($product->thumbnail)

                                            <img
                                                src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-cover"
                                            >

                                        @else

                                            <div
                                                class="w-full h-full
                                                       flex items-center
                                                       justify-center
                                                       text-xl"
                                            >
                                                🛏️
                                            </div>

                                        @endif

                                    </div>


                                    {{-- Product Information --}}
                                    <div class="min-w-0">

                                        <div
                                            class="font-semibold text-gray-900
                                                   truncate max-w-xs"
                                        >
                                            {{ $product->name }}
                                        </div>

                                        <div class="text-xs text-gray-400 mt-1">
                                            SKU:
                                            {{ $product->sku ?: 'N/A' }}
                                        </div>

                                        @if($product->is_featured)

                                            <span
                                                class="inline-flex items-center
                                                       mt-2 px-2 py-0.5
                                                       rounded-full
                                                       bg-yellow-50
                                                       text-yellow-700
                                                       text-xs font-semibold"
                                            >
                                                ⭐ Featured
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =========================
                                 CATEGORY
                            ========================== --}}
                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ $product->category?->name ?? 'N/A' }}

                            </td>


                            {{-- =========================
                                 PRICE
                            ========================== --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-900">
                                    ৳{{ number_format((float) $product->selling_price, 0) }}
                                </div>

                                @if(
                                    $product->regular_price &&
                                    $product->regular_price > $product->selling_price
                                )

                                    <div
                                        class="text-xs text-gray-400
                                               line-through"
                                    >
                                        ৳{{ number_format((float) $product->regular_price, 0) }}
                                    </div>

                                    @if($product->discount_percentage > 0)

                                        <div
                                            class="text-xs text-green-600
                                                   font-semibold mt-1"
                                        >
                                            {{ $product->discount_percentage }}%
                                            OFF
                                        </div>

                                    @endif

                                @endif

                            </td>


                            {{-- =========================
                                 STOCK
                            ========================== --}}
                            <td class="px-6 py-4">

                                @if($variantCount > 0)

                                    {{-- Variant Based Stock --}}

                                    @if($displayStock <= 0)

                                        <span
                                            class="inline-flex px-3 py-1
                                                   rounded-full
                                                   bg-red-50 text-red-700
                                                   text-xs font-semibold"
                                        >
                                            Out of Stock
                                        </span>

                                    @elseif($displayStock <= 5)

                                        <span
                                            class="inline-flex px-3 py-1
                                                   rounded-full
                                                   bg-orange-50 text-orange-700
                                                   text-xs font-semibold"
                                        >
                                            {{ $displayStock }} left
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex px-3 py-1
                                                   rounded-full
                                                   bg-blue-50 text-blue-700
                                                   text-xs font-semibold"
                                        >
                                            {{ $displayStock }} total
                                        </span>

                                    @endif

                                    <div
                                        class="mt-1 text-xs text-gray-400"
                                    >
                                        {{ $variantCount }}
                                        {{ $variantCount === 1 ? 'variant' : 'variants' }}
                                    </div>

                                @else

                                    {{-- Normal Product Stock --}}

                                    @if($displayStock <= 0)

                                        <span
                                            class="inline-flex px-3 py-1
                                                   rounded-full
                                                   bg-red-50 text-red-700
                                                   text-xs font-semibold"
                                        >
                                            Out of Stock
                                        </span>

                                    @elseif($displayStock <= 5)

                                        <span
                                            class="inline-flex px-3 py-1
                                                   rounded-full
                                                   bg-orange-50 text-orange-700
                                                   text-xs font-semibold"
                                        >
                                            {{ $displayStock }} left
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex px-3 py-1
                                                   rounded-full
                                                   bg-green-50 text-green-700
                                                   text-xs font-semibold"
                                        >
                                            {{ $displayStock }}
                                        </span>

                                    @endif

                                @endif

                            </td>


                            {{-- =========================
                                 STATUS
                            ========================== --}}
                            <td class="px-6 py-4">

                                @if($product->is_active)

                                    <span
                                        class="inline-flex items-center gap-1
                                               px-3 py-1 rounded-full
                                               bg-green-50 text-green-700
                                               text-xs font-semibold"
                                    >
                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-green-500"
                                        ></span>

                                        Active
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1
                                               px-3 py-1 rounded-full
                                               bg-gray-100 text-gray-600
                                               text-xs font-semibold"
                                    >
                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-gray-400"
                                        ></span>

                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- =========================
                                 IMAGES
                            ========================== --}}
                            <td class="px-6 py-4">

                                <span
                                    class="inline-flex items-center
                                           px-3 py-1 rounded-full
                                           bg-gray-100 text-gray-700
                                           text-xs font-semibold"
                                >
                                    {{ $product->images->count() }}

                                    {{ $product->images->count() === 1
                                        ? 'image'
                                        : 'images'
                                    }}
                                </span>

                            </td>


                            {{-- =========================
                                 ACTIONS
                            ========================== --}}
                            <td class="px-6 py-4">

                                <div
                                    class="flex items-center justify-end
                                           gap-2 flex-wrap"
                                >

                                    {{-- View --}}
                                    <a
                                        href="{{ route(
                                            'admin.products.show',
                                            $product
                                        ) }}"
                                        class="inline-flex items-center
                                               px-3 py-2 rounded-lg
                                               bg-gray-100
                                               text-gray-700
                                               text-xs font-semibold
                                               hover:bg-gray-200
                                               transition"
                                    >
                                        View
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route(
                                            'admin.products.edit',
                                            $product
                                        ) }}"
                                        class="inline-flex items-center
                                               px-3 py-2 rounded-lg
                                               bg-teal-50
                                               text-teal-700
                                               text-xs font-semibold
                                               hover:bg-teal-100
                                               transition"
                                    >
                                        Edit
                                    </a>


                                    {{-- Variants --}}
                                    <a
                                        href="{{ route(
                                            'admin.products.variants.index',
                                            $product
                                        ) }}"
                                        class="inline-flex items-center
                                               px-3 py-2 rounded-lg
                                               bg-indigo-50
                                               text-indigo-700
                                               text-xs font-semibold
                                               hover:bg-indigo-100
                                               transition"
                                    >
                                        Variants
                                    </a>


                                    {{-- Gallery --}}
                                    <a
                                        href="{{ route(
                                            'admin.products.images.index',
                                            $product
                                        ) }}"
                                        class="inline-flex items-center
                                               px-3 py-2 rounded-lg
                                               bg-purple-50
                                               text-purple-700
                                               text-xs font-semibold
                                               hover:bg-purple-100
                                               transition"
                                    >
                                        Gallery
                                    </a>

                                    {{-- Activate / Deactivate --}}
                                    @if($product->is_active)

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.products.deactivate',
                                                $product
                                            ) }}"
                                            class="inline"
                                            onsubmit="return confirm(
                                                'Are you sure you want to deactivate this product?'
                                            )"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center
                                                    px-3 py-2 rounded-lg
                                                    bg-red-50
                                                    text-red-700
                                                    text-xs font-semibold
                                                    hover:bg-red-100
                                                    transition"
                                            >
                                                Deactivate
                                            </button>

                                        </form>

                                    @else

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.products.activate',
                                                $product
                                            ) }}"
                                            class="inline"
                                            onsubmit="return confirm(
                                                'Are you sure you want to activate this product?'
                                            )"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center
                                                    px-3 py-2 rounded-lg
                                                    bg-green-50
                                                    text-green-700
                                                    text-xs font-semibold
                                                    hover:bg-green-100
                                                    transition"
                                            >
                                                Activate
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-5xl">
                                    🛍️
                                </div>

                                <h3
                                    class="mt-4 text-lg font-bold
                                           text-gray-900"
                                >
                                    No products found
                                </h3>

                                <p
                                    class="mt-2 text-sm text-gray-500"
                                >
                                    There are no products in your catalog yet.
                                </p>

                                <a
                                    href="{{ route('admin.products.create') }}"
                                    class="inline-flex items-center
                                           gap-2
                                           mt-5 px-4 py-2 rounded-lg
                                           bg-teal-600 text-white
                                           text-sm font-semibold
                                           hover:bg-teal-700 transition"
                                >
                                    <span class="text-lg leading-none">+</span>
                                    Add Product
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($products->hasPages())

            <div
                class="px-6 py-4
                       border-t border-gray-100"
            >
                {{ $products->links() }}
            </div>

        @endif

    </div>

@endsection