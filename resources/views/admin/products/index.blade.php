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


<!-- {{-- Success Message --}}
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

@endif -->


{{-- Product Table --}}
<div
    class="bg-white rounded-2xl
           border border-gray-100
           shadow-sm overflow-hidden"
>

    <div class="overflow-x-auto">

        <table class="w-full min-w-[1150px] table-fixed">
            <colgroup>
                <col style="width: 25%">
                <col style="width: 13%">
                <col style="width: 12%">
                <col style="width: 12%">
                <col style="width: 12%">
                <col style="width: 10%">
                <col style="width: 16%">
            </colgroup>

            {{-- Table Header --}}
            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>

                    {{-- Product --}}
                    <th
                        class="px-6 py-4 text-center text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Product
                    </th>

                    {{-- Category --}}
                    <th
                        class="px-6 py-4 text-center text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Category
                    </th>

                    {{-- Price --}}
                    <th
                        class="px-6 py-4 text-center text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Price
                    </th>

                    {{-- Stock --}}
                    <th
                        class="px-6 py-4 text-center text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Stock
                    </th>

                    {{-- Status --}}
                    <th
                        class="px-6 py-4 text-center text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Status
                    </th>

                    {{-- Images --}}
                    <th
                        class="px-6 py-4 text-center text-xs
                               font-semibold text-gray-500 uppercase
                               tracking-wider"
                    >
                        Images
                    </th>

                    {{-- Actions --}}
                    <th
                        class="px-6 py-4 text-center text-xs
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
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">

                            {{ $product->category?->name ?? 'N/A' }}

                        </td>


                        {{-- =========================
                             PRICE
                        ========================== --}}
                        <td class="px-6 py-4 text-center">

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
                        <td class="px-4 py-4 align-middle">

                            <div class="flex flex-col justify-center items-center gap-1.5">

                                @if($displayStock <= 0)

                                    <span class="inline-flex whitespace-nowrap rounded-full
                                                bg-red-50 px-3 py-1 text-xs font-semibold
                                                text-red-700">
                                        Out of Stock
                                    </span>

                                @elseif($displayStock <= 5)

                                    <span class="inline-flex whitespace-nowrap rounded-full
                                                bg-orange-50 px-3 py-1 text-xs font-semibold
                                                text-orange-700">
                                        {{ $displayStock }} left
                                    </span>

                                @else

                                    <span class="inline-flex whitespace-nowrap rounded-full
                                                {{ $variantCount > 0
                                                    ? 'bg-blue-50 text-blue-700'
                                                    : 'bg-green-50 text-green-700' }}
                                                px-3 py-1 text-xs font-semibold">
                                        {{ $displayStock }}
                                        {{ $variantCount > 0 ? 'total' : '' }}
                                    </span>

                                @endif

                                @if($variantCount > 0)
                                    <span class="whitespace-nowrap text-xs text-gray-400">
                                        {{ $variantCount }}
                                        {{ $variantCount === 1 ? 'variant' : 'variants' }}
                                    </span>
                                @endif

                            </div>

                        </td>


                        {{-- =========================
                             STATUS
                        ========================== --}}
                        <td class="px-6 py-4 text-center">

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
                        <td class="px-4 py-4 text-center"> 
                            <span class="inline-flex items-center justify-center whitespace-nowrap rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700"> 
                                {{ $product->images->count() }} 
                                {{ $product->images->count() === 1 ? 'image' : 'images' }} 
                            </span> 
                        </td>


                        {{-- =========================
                             ACTIONS
                        ========================== --}}
                        <td class="px-4 py-4 align-middle">

                            <div class="grid grid-cols-2 gap-2 w-fit mx-auto">

                                {{-- View --}}
                                <a
                                    href="{{ route('admin.products.show', $product) }}"
                                    title="View product"
                                    aria-label="View product"
                                    class="flex h-9 w-9 items-center justify-center
                                        rounded-lg bg-gray-100 text-gray-700
                                        transition hover:bg-gray-200"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>

                                {{-- Edit --}}
                                <a
                                    href="{{ route('admin.products.edit', $product) }}"
                                    title="Edit product"
                                    aria-label="Edit product"
                                    class="flex h-9 w-9 items-center justify-center
                                        rounded-lg bg-teal-50 text-teal-700
                                        transition hover:bg-teal-100"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                                    </svg>
                                </a>

                                {{-- Variants --}}
                                <a
                                    href="{{ route('admin.products.variants.index', $product) }}"
                                    title="Manage variants"
                                    aria-label="Manage variants"
                                    class="flex h-9 w-9 items-center justify-center
                                        rounded-lg bg-indigo-50 text-indigo-700
                                        transition hover:bg-indigo-100"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                                        <path d="m3 12 9 5 9-5"/>
                                        <path d="m3 16 9 5 9-5"/>
                                    </svg>
                                </a>

                                {{-- Gallery --}}
                                <a
                                    href="{{ route('admin.products.images.index', $product) }}"
                                    title="Manage images"
                                    aria-label="Manage images"
                                    class="flex h-9 w-9 items-center justify-center
                                        rounded-lg bg-purple-50 text-purple-700
                                        transition hover:bg-purple-100"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="m21 15-5-5L5 21"/>
                                    </svg>
                                </a>

                                {{-- Activate / Deactivate --}}
                                @if($product->is_active)

                                    <button
                                        type="button"
                                        onclick="openProductStatusModal(
                                            'deactivate',
                                            '{{ $product->id }}',
                                            @js($product->name)
                                        )"
                                        title="Deactivate product"
                                        aria-label="Deactivate product"
                                        class="flex h-9 w-9 items-center justify-center
                                            rounded-lg bg-orange-50 text-orange-700
                                            transition hover:bg-orange-100"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M12 2v10"/>
                                            <path d="M18.4 6.6a9 9 0 1 1-12.8 0"/>
                                        </svg>
                                    </button>

                                @else

                                    <button
                                        type="button"
                                        onclick="openProductStatusModal(
                                            'activate',
                                            '{{ $product->id }}',
                                            @js($product->name)
                                        )"
                                        title="Activate product"
                                        aria-label="Activate product"
                                        class="flex h-9 w-9 items-center justify-center
                                            rounded-lg bg-green-50 text-green-700
                                            transition hover:bg-green-100"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="m9 12 2 2 4-4"/>
                                        </svg>
                                    </button>

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


{{-- =========================================================
     PRODUCT STATUS MODAL
========================================================== --}}

<div
    id="productStatusModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="productStatusModalTitle"
    aria-modal="true"
    role="dialog"
>

    {{-- Overlay --}}
    <div
        id="productStatusModalOverlay"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="closeProductStatusModal()"
    ></div>


    {{-- Modal Container --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">

        <div
            id="productStatusModalContent"
            class="relative w-full max-w-md
                   bg-white rounded-2xl
                   shadow-2xl
                   overflow-hidden
                   transform transition-all"
        >

            {{-- Modal Header --}}
            <div class="px-6 pt-6 pb-4">

                <div class="flex items-start gap-4">

                    {{-- Icon --}}
                    <div
                        id="productStatusModalIcon"
                        class="flex-shrink-0
                               w-12 h-12 rounded-full
                               flex items-center justify-center"
                    >
                        <span
                            id="productStatusModalIconText"
                            class="text-xl"
                        >
                        </span>
                    </div>


                    {{-- Title / Description --}}
                    <div class="flex-1">

                        <h3
                            id="productStatusModalTitle"
                            class="text-lg font-bold text-gray-900"
                        >
                            Confirm Action
                        </h3>

                        <p
                            id="productStatusModalMessage"
                            class="mt-2 text-sm text-gray-500 leading-6"
                        >
                            Are you sure?
                        </p>

                    </div>


                    {{-- Close --}}
                    <button
                        type="button"
                        onclick="closeProductStatusModal()"
                        class="flex-shrink-0
                               w-8 h-8 rounded-lg
                               flex items-center justify-center
                               text-gray-400
                               hover:bg-gray-100
                               hover:text-gray-600
                               transition"
                        aria-label="Close"
                    >
                        <span class="text-xl leading-none">
                            &times;
                        </span>
                    </button>

                </div>

            </div>


            {{-- Modal Footer --}}
            <div
                class="px-6 py-4
                       bg-gray-50
                       border-t border-gray-100
                       flex items-center justify-end gap-3"
            >

                {{-- Cancel --}}
                <button
                    type="button"
                    onclick="closeProductStatusModal()"
                    class="px-4 py-2.5 rounded-lg
                           border border-gray-200
                           bg-white
                           text-gray-700
                           text-sm font-semibold
                           hover:bg-gray-50
                           transition"
                >
                    Cancel
                </button>


                {{-- Confirm --}}
                <form
                    id="productStatusModalForm"
                    method="POST"
                >

                    @csrf

                    @method('PATCH')

                    <button
                        id="productStatusModalConfirmButton"
                        type="submit"
                        class="px-4 py-2.5 rounded-lg
                               text-white
                               text-sm font-semibold
                               transition"
                    >
                        Confirm
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL JAVASCRIPT
========================================================== --}}

<script>

    function openProductStatusModal(action, productId, productName) {

        const modal = document.getElementById(
            'productStatusModal'
        );

        const form = document.getElementById(
            'productStatusModalForm'
        );

        const title = document.getElementById(
            'productStatusModalTitle'
        );

        const message = document.getElementById(
            'productStatusModalMessage'
        );

        const icon = document.getElementById(
            'productStatusModalIcon'
        );

        const iconText = document.getElementById(
            'productStatusModalIconText'
        );

        const confirmButton = document.getElementById(
            'productStatusModalConfirmButton'
        );


        /*
         * Deactivate
         */
        if (action === 'deactivate') {

            form.action =
                "{{ url('/admin/products') }}/"
                + productId
                + "/deactivate";

            title.textContent =
                'Deactivate Product';

            message.innerHTML =
                'Are you sure you want to deactivate '
                + '<strong class="text-gray-900">'
                + escapeHtml(productName)
                + '</strong>? '
                + 'This product will no longer be available '
                + 'to customers in the storefront.';

            icon.className =
                'flex-shrink-0 w-12 h-12 rounded-full '
                + 'flex items-center justify-center '
                + 'bg-red-100 text-red-600';

            iconText.textContent = '⚠️';

            confirmButton.textContent =
                'Yes, Deactivate';

            confirmButton.className =
                'px-4 py-2.5 rounded-lg '
                + 'bg-red-600 text-white '
                + 'text-sm font-semibold '
                + 'hover:bg-red-700 transition';

        }


        /*
         * Activate
         */
        else {

            form.action =
                "{{ url('/admin/products') }}/"
                + productId
                + "/activate";

            title.textContent =
                'Activate Product';

            message.innerHTML =
                'Are you sure you want to activate '
                + '<strong class="text-gray-900">'
                + escapeHtml(productName)
                + '</strong>? '
                + 'This product will become available '
                + 'to customers in the storefront.';

            icon.className =
                'flex-shrink-0 w-12 h-12 rounded-full '
                + 'flex items-center justify-center '
                + 'bg-green-100 text-green-600';

            iconText.textContent = '✓';

            confirmButton.textContent =
                'Yes, Activate';

            confirmButton.className =
                'px-4 py-2.5 rounded-lg '
                + 'bg-green-600 text-white '
                + 'text-sm font-semibold '
                + 'hover:bg-green-700 transition';

        }


        /*
         * Show modal
         */
        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');


        /*
         * Focus confirm button
         */
        setTimeout(function () {

            confirmButton.focus();

        }, 100);

    }


    function closeProductStatusModal() {

        const modal = document.getElementById(
            'productStatusModal'
        );

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    /*
     * Prevent HTML injection when product names
     * are inserted into modal text.
     */
    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;

    }


    /*
     * Close modal using Escape key.
     */
    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeProductStatusModal();

            }

        }
    );

</script>


@endsection
