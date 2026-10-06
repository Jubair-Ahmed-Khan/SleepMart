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


                                {{-- =========================
                                     ACTIVATE / DEACTIVATE
                                ========================== --}}

                                @if($product->is_active)

                                    {{-- Deactivate Button --}}
                                    <button
                                        type="button"
                                        onclick="openProductStatusModal(
                                            'deactivate',
                                            '{{ $product->id }}',
                                            @js($product->name)
                                        )"
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

                                @else

                                    {{-- Activate Button --}}
                                    <button
                                        type="button"
                                        onclick="openProductStatusModal(
                                            'activate',
                                            '{{ $product->id }}',
                                            @js($product->name)
                                        )"
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
