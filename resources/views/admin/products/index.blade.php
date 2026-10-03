@extends('layouts.admin')

@section('title', 'Products | SleepMart')

@section('page-title', 'Products')

@section('content')


<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">
            Products
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Manage your SleepMart products and images.
        </p>
    </div>

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

</div>


{{-- Product Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>

                    <th
                        class="px-6 py-4 text-left text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Product
                    </th>

                    <th
                        class="px-6 py-4 text-left text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Category
                    </th>

                    <th
                        class="px-6 py-4 text-left text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Price
                    </th>

                    <th
                        class="px-6 py-4 text-left text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Stock
                    </th>

                    <th
                        class="px-6 py-4 text-left text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Images
                    </th>

                    <th
                        class="px-6 py-4 text-right text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Action
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse($products as $product)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- Product --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-4">

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

                                </div>

                            </div>

                        </td>


                        {{-- Category --}}
                        <td class="px-6 py-4 text-sm text-gray-600">

                            {{ $product->category?->name ?? 'N/A' }}

                        </td>


                        {{-- Price --}}
                        <td class="px-6 py-4">

                            <div class="font-semibold text-gray-900">
                                ৳{{ number_format((float) $product->selling_price, 0) }}
                            </div>

                            @if(
                                $product->regular_price &&
                                $product->regular_price > $product->selling_price
                            )

                                <div class="text-xs text-gray-400 line-through">
                                    ৳{{ number_format((float) $product->regular_price, 0) }}
                                </div>

                            @endif

                        </td>


                        {{-- Stock --}}
                        <td class="px-6 py-4">

                            @if($product->variants->isNotEmpty())

                                @php
                                    $activeVariants = $product->variants
                                        ->where('is_active', true);

                                    $totalVariantStock = $activeVariants
                                        ->sum('stock');
                                @endphp

                                @if($totalVariantStock <= 0)

                                    <span
                                        class="inline-flex px-3 py-1
                                               rounded-full
                                               bg-red-50 text-red-700
                                               text-xs font-semibold"
                                    >
                                        Out of Stock
                                    </span>

                                @elseif($totalVariantStock <= 5)

                                    <span
                                        class="inline-flex px-3 py-1
                                               rounded-full
                                               bg-orange-50 text-orange-700
                                               text-xs font-semibold"
                                    >
                                        {{ $totalVariantStock }} left
                                    </span>

                                @else

                                    <span
                                        class="inline-flex px-3 py-1
                                               rounded-full
                                               bg-blue-50 text-blue-700
                                               text-xs font-semibold"
                                    >
                                        {{ $totalVariantStock }} total
                                    </span>

                                @endif

                                <div class="mt-1 text-xs text-gray-400">
                                    {{ $activeVariants->count() }}
                                    {{ $activeVariants->count() === 1 ? 'variant' : 'variants' }}
                                </div>

                            @elseif($product->stock <= 0)

                                <span
                                    class="inline-flex px-3 py-1
                                           rounded-full
                                           bg-red-50 text-red-700
                                           text-xs font-semibold"
                                >
                                    Out of Stock
                                </span>

                            @elseif($product->stock <= 5)

                                <span
                                    class="inline-flex px-3 py-1
                                           rounded-full
                                           bg-orange-50 text-orange-700
                                           text-xs font-semibold"
                                >
                                    {{ $product->stock }} left
                                </span>

                            @else

                                <span
                                    class="inline-flex px-3 py-1
                                           rounded-full
                                           bg-green-50 text-green-700
                                           text-xs font-semibold"
                                >
                                    {{ $product->stock }}
                                </span>

                            @endif

                        </td>


                        {{-- Images --}}
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


                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">

                            <a
                                href="{{ route(
                                    'admin.products.images.index',
                                    $product
                                ) }}"
                                class="inline-flex items-center gap-2
                                       px-4 py-2 rounded-lg
                                       bg-teal-600 text-white
                                       text-sm font-semibold
                                       hover:bg-teal-700
                                       transition"
                            >
                                🖼️
                                Manage Images
                            </a>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="6"
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
                                href="{{ route('products.index') }}"
                                class="inline-flex items-center
                                       mt-5 px-4 py-2 rounded-lg
                                       bg-teal-600 text-white
                                       text-sm font-semibold
                                       hover:bg-teal-700 transition"
                            >
                                View Store
                            </a>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($products->hasPages())

        <div class="px-6 py-4 border-t border-gray-100">

            {{ $products->links() }}

        </div>

    @endif

</div>


@endsection
