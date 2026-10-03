@extends('layouts.app')

@section('title', $product->name . ' - SleepMart')

@section('content')


<div class="bg-gray-50">

{{-- Flash Messages --}}
<div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">

    @if(session('success'))
        <div
            class="mb-4 rounded-xl border border-green-200
                   bg-green-50 px-5 py-4 text-sm text-green-700"
        >
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div
            class="mb-4 rounded-xl border border-red-200
                   bg-red-50 px-5 py-4 text-sm text-red-700"
        >
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div
            class="mb-4 rounded-xl border border-red-200
                   bg-red-50 px-5 py-4 text-sm text-red-700"
        >
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>


{{-- Breadcrumb --}}
<div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">

    <nav
        class="flex flex-wrap items-center gap-2 text-sm text-gray-500"
        aria-label="Breadcrumb"
    >

        <a
            href="{{ route('home') }}"
            class="hover:text-indigo-600"
        >
            Home
        </a>

        <span>/</span>

        <a
            href="{{ route('products.index') }}"
            class="hover:text-indigo-600"
        >
            Shop
        </a>

        <span>/</span>

        @if($product->category)
            <a
                href="{{ route(
                    'products.index',
                    ['category' => $product->category->slug]
                ) }}"
                class="hover:text-indigo-600"
            >
                {{ $product->category->name }}
            </a>

            <span>/</span>
        @endif

        <span class="font-medium text-gray-900">
            {{ $product->name }}
        </span>

    </nav>

</div>


{{-- Product Details --}}
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    <div
        class="grid grid-cols-1 gap-10 rounded-2xl
               bg-white p-5 shadow-sm
               lg:grid-cols-2 lg:p-8"
    >

        {{-- ========================================================= --}}
        {{-- LEFT: PRODUCT IMAGE --}}
        {{-- ========================================================= --}}

        <!-- <div>

            <div
                class="relative overflow-hidden rounded-2xl
                       bg-gray-100"
            >

                {{-- Discount Badge --}}
                @if($product->discount_percentage > 0)
                    <span
                        class="absolute left-4 top-4 z-10
                               rounded-full bg-red-500
                               px-3 py-1.5 text-xs font-bold
                               text-white"
                    >
                        {{ $product->discount_percentage }}% OFF
                    </span>
                @endif


                {{-- Product Image --}}
                @if($product->thumbnail)

                    <img
                        id="mainProductImage"
                        src="{{ asset(
                            'storage/' . $product->thumbnail
                        ) }}"
                        alt="{{ $product->name }}"
                        class="h-[420px] w-full object-cover
                               sm:h-[500px]"
                    >

                @else

                    <div
                        class="flex h-[420px] items-center
                               justify-center text-gray-400
                               sm:h-[500px]"
                    >
                        <div class="text-center">

                            <div class="text-6xl">
                                🛏️
                            </div>

                            <p class="mt-3 text-sm">
                                No image available
                            </p>

                        </div>
                    </div>

                @endif

            </div>


            {{-- Additional Images --}}
            @if($product->images->count())

                <div class="mt-4 grid grid-cols-4 gap-3">

                    {{-- Main Thumbnail --}}
                    @if($product->thumbnail)

                        <button
                            type="button"
                            onclick="changeProductImage(
                                '{{ asset(
                                    'storage/' .
                                    $product->thumbnail
                                ) }}'
                            )"
                            class="overflow-hidden rounded-xl
                                   border-2 border-indigo-500
                                   bg-gray-100"
                        >
                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $product->thumbnail
                                ) }}"
                                alt="{{ $product->name }}"
                                class="h-20 w-full object-cover"
                            >
                        </button>

                    @endif


                    @foreach($product->images as $image)

                        <button
                            type="button"
                            onclick="changeProductImage(
                                '{{ $image->url }}'
                            )"
                            class="overflow-hidden rounded-xl
                                   border-2 border-transparent
                                   bg-gray-100 hover:border-indigo-400"
                        >

                            <img
                                src="{{ $image->url }}"
                                alt="{{ $product->name }}"
                                class="h-20 w-full object-cover"
                            >

                        </button>

                    @endforeach

                </div>

            @endif

        </div> -->
        <div>

            {{-- Main Image --}}
            <div class="aspect-square rounded-3xl overflow-hidden bg-gray-100">
                @if($product->images->count())
                    @php
                        $primaryImage = $product->images
                            ->firstWhere('is_primary', true)
                            ?? $product->images->first();
                    @endphp

                    <img
                        id="mainProductImage"
                        src="{{ $primaryImage->url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                    >
                @elseif($product->thumbnail)
                    <img
                        id="mainProductImage"
                        src="{{ asset('storage/' . $product->thumbnail) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center text-7xl">
                        🛏️
                    </div>
                @endif
            </div>

            {{-- Thumbnails --}}
            @if($product->images->count() > 1)

                <div class="mt-4 grid grid-cols-5 sm:grid-cols-6 gap-3">

                    @foreach($product->images as $image)

                        <button
                            type="button"
                            onclick="changeProductImage('{{ $image->url }}')"
                            class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-teal-500 transition"
                        >
                            <img
                                src="{{ $image->url }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >
                        </button>

                    @endforeach

                </div>

            @endif

        </div>


        {{-- ========================================================= --}}
        {{-- RIGHT: PRODUCT INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col">

            {{-- Category --}}
            @if($product->category)

                <a
                    href="{{ route(
                        'products.index',
                        ['category' => $product->category->slug]
                    ) }}"
                    class="text-sm font-semibold
                           text-indigo-600 hover:text-indigo-700"
                >
                    {{ $product->category->name }}
                </a>

            @endif


            {{-- Product Name --}}
            <h1
                class="mt-2 text-3xl font-bold
                       tracking-tight text-gray-900
                       sm:text-4xl"
            >
                {{ $product->name }}
            </h1>


            {{-- Rating --}}
            <div class="mt-4 flex flex-wrap items-center gap-3">

                <div class="flex items-center">

                    @php
                        $rating = (float) $product->rating;
                        $fullStars = floor($rating);
                    @endphp

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= $fullStars)
                            <span class="text-lg text-yellow-400">
                                ★
                            </span>
                        @else
                            <span class="text-lg text-gray-300">
                                ★
                            </span>
                        @endif

                    @endfor

                </div>

                <span class="text-sm font-semibold text-gray-700">
                    {{ number_format($product->rating, 1) }}
                </span>

                <span class="text-sm text-gray-500">
                    ({{ $product->reviews_count }} reviews)
                </span>

            </div>


            {{-- Short Description --}}
            @if($product->short_description)

                <p
                    class="mt-5 leading-7 text-gray-600"
                >
                    {{ $product->short_description }}
                </p>

            @endif


            {{-- Price --}}
            <div class="mt-6">

                <div class="flex flex-wrap items-center gap-3">

                    <span
                        class="text-3xl font-bold
                               text-indigo-600"
                    >
                        ৳{{ number_format(
                            $product->selling_price,
                            0
                        ) }}
                    </span>


                    @if(
                        $product->regular_price >
                        $product->selling_price
                    )

                        <span
                            class="text-lg text-gray-400
                                   line-through"
                        >
                            ৳{{ number_format(
                                $product->regular_price,
                                0
                            ) }}
                        </span>

                        <span
                            class="rounded-full bg-red-100
                                   px-3 py-1 text-xs
                                   font-bold text-red-600"
                        >
                            Save ৳{{ number_format(
                                $product->regular_price -
                                $product->selling_price,
                                0
                            ) }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- Divider --}}
            <div class="my-6 border-t border-gray-200"></div>


            {{-- ===================================================== --}}
            {{-- ADD TO CART FORM --}}
            {{-- ===================================================== --}}

            @php
                $hasVariants = $product->variants->isNotEmpty();

                $availableVariants = $product->variants
                    ->filter(function ($variant) {
                        return $variant->is_active && $variant->stock > 0;
                    });

                $hasAvailableVariant = $availableVariants->isNotEmpty();

                $canAddToCart = $hasVariants
                    ? $hasAvailableVariant
                    : $product->stock > 0;
            @endphp
            
            <form
                action="{{ route('cart.add', ['product' => $product->slug]) }}"
                method="POST"
                class="space-y-5"
            >
                @csrf


                {{-- ================================================= --}}
                {{-- VARIANT --}}
                {{-- ================================================= --}}

                @if($hasVariants)

                    <div>

                        <label
                            for="variant_id"
                            class="mb-2 block text-sm font-semibold text-gray-900"
                        >
                            Choose Size
                        </label>

                        <select
                            name="variant_id"
                            id="variant_id"
                            {{ $hasAvailableVariant ? 'required' : 'disabled' }}
                            class="w-full rounded-xl border border-gray-300
                                  px-4 py-3 text-sm
                                  focus:border-indigo-500
                                  focus:ring-indigo-500
                                  disabled:cursor-not-allowed
                                  disabled:bg-gray-100
                                  disabled:text-gray-500"
                        >

                            @if($hasAvailableVariant)

                                <option value="">
                                    Select a size
                                </option>

                                @foreach($availableVariants as $variant)

                                    <option
                                        value="{{ $variant->id }}"
                                    >
                                        {{ $variant->name }}

                                        @if($variant->size)
                                            — {{ $variant->size }}
                                        @endif

                                        @if($variant->thickness)
                                            — {{ $variant->thickness }}
                                        @endif

                                        — ৳{{ number_format($variant->price, 0) }}

                                        @if($variant->stock <= 5)
                                            — Only {{ $variant->stock }} left
                                        @endif
                                    </option>

                                @endforeach

                            @else

                                <option value="">
                                    All sizes are currently out of stock
                                </option>

                            @endif

                        </select>

                        @if($hasAvailableVariant)

                            <p class="mt-2 text-xs text-gray-500">
                                Please select your preferred size.
                            </p>

                        @endif

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- QUANTITY --}}
                {{-- ================================================= --}}

                <div>

                    <label
                        for="quantity"
                        class="mb-2 block text-sm font-semibold text-gray-900"
                    >
                        Quantity
                    </label>

                    <div
                        class="flex w-fit items-center overflow-hidden
                              rounded-xl border border-gray-300
                              {{ !$canAddToCart ? 'opacity-50' : '' }}"
                    >

                        <button
                            type="button"
                            onclick="decreaseQuantity()"
                            {{ !$canAddToCart ? 'disabled' : '' }}
                            class="px-4 py-3 text-lg font-bold text-gray-600
                                  hover:bg-gray-100
                                  disabled:cursor-not-allowed"
                        >
                            −
                        </button>


                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="1"
                            min="1"
                            max="20"
                            {{ !$canAddToCart ? 'disabled' : '' }}
                            class="w-16 border-x border-gray-300
                                  text-center
                                  focus:border-indigo-500
                                  focus:ring-0
                                  disabled:cursor-not-allowed
                                  disabled:bg-gray-100"
                        >


                        <button
                            type="button"
                            onclick="increaseQuantity()"
                            {{ !$canAddToCart ? 'disabled' : '' }}
                            class="px-4 py-3 text-lg font-bold text-gray-600
                                  hover:bg-gray-100
                                  disabled:cursor-not-allowed"
                        >
                            +
                        </button>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- STOCK MESSAGE --}}
                {{-- ================================================= --}}

                @if($hasVariants)

                    @if($hasAvailableVariant)

                        <div
                            class="rounded-xl border border-green-200
                                  bg-green-50 px-4 py-3"
                        >
                            <p
                                class="text-sm font-semibold text-green-700"
                            >
                                ✓ In Stock
                            </p>

                            <p
                                class="mt-1 text-xs text-green-600"
                            >
                                Available sizes can be selected above.
                            </p>
                        </div>

                    @else

                        <div
                            class="rounded-xl border border-red-200
                                  bg-red-50 px-4 py-3"
                        >
                            <p
                                class="text-sm font-semibold text-red-700"
                            >
                                Currently Out of Stock
                            </p>

                            <p
                                class="mt-1 text-xs text-red-600"
                            >
                                All available sizes are currently out of stock.
                            </p>
                        </div>

                    @endif

                @else

                    @if($product->stock > 0)

                        <div
                            class="rounded-xl border border-green-200
                                  bg-green-50 px-4 py-3"
                        >
                            <p
                                class="text-sm font-semibold text-green-700"
                            >
                                ✓ In Stock
                            </p>

                            <p
                                class="mt-1 text-xs text-green-600"
                            >
                                {{ $product->stock }} item(s) available.
                            </p>
                        </div>

                    @else

                        <div
                            class="rounded-xl border border-red-200
                                  bg-red-50 px-4 py-3"
                        >
                            <p
                                class="text-sm font-semibold text-red-700"
                            >
                                Currently Out of Stock
                            </p>
                        </div>

                    @endif

                @endif


                {{-- ================================================= --}}
                {{-- ADD TO CART BUTTON --}}
                {{-- ================================================= --}}

                @if($canAddToCart)

                    <button
                        type="submit"
                        class="flex w-full items-center justify-center
                              gap-2 rounded-xl bg-indigo-600
                              px-6 py-4 text-sm font-bold text-white
                              shadow-sm transition
                              hover:bg-indigo-700
                              focus:outline-none
                              focus:ring-2
                              focus:ring-indigo-500
                              focus:ring-offset-2"
                    >
                        <span class="text-lg">
                            🛒
                        </span>

                        Add to Cart
                    </button>

                @else

                    <button
                        type="button"
                        disabled
                        class="flex w-full cursor-not-allowed
                              items-center justify-center
                              gap-2 rounded-xl bg-gray-300
                              px-6 py-4 text-sm font-bold
                              text-gray-500"
                    >
                        <span class="text-lg">
                            🚫
                        </span>

                        Out of Stock
                    </button>

                @endif

            </form>


            {{-- ===================================================== --}}
            {{-- DELIVERY INFORMATION --}}
            {{-- ===================================================== --}}

            <div class="mt-6 space-y-3">

                <div
                    class="flex items-start gap-3
                           rounded-xl bg-green-50 p-4"
                >

                    <div class="text-xl">
                        🚚
                    </div>

                    <div>

                        <p
                            class="text-sm font-semibold
                                   text-green-800"
                        >
                            Delivery Across Bangladesh
                        </p>

                        <p
                            class="mt-1 text-xs
                                   leading-5 text-green-700"
                        >
                            Home delivery is available
                            throughout Bangladesh.
                        </p>

                    </div>

                </div>


                <div
                    class="flex items-start gap-3
                           rounded-xl bg-blue-50 p-4"
                >

                    <div class="text-xl">
                        💵
                    </div>

                    <div>

                        <p
                            class="text-sm font-semibold
                                   text-blue-800"
                        >
                            Cash on Delivery
                        </p>

                        <p
                            class="mt-1 text-xs
                                   leading-5 text-blue-700"
                        >
                            Pay when your order arrives.
                        </p>

                    </div>

                </div>


                <div
                    class="flex items-start gap-3
                           rounded-xl bg-gray-50 p-4"
                >

                    <div class="text-xl">
                        🔄
                    </div>

                    <div>

                        <p
                            class="text-sm font-semibold
                                   text-gray-800"
                        >
                            Easy Customer Support
                        </p>

                        <p
                            class="mt-1 text-xs
                                   leading-5 text-gray-600"
                        >
                            Contact our support team for
                            product or delivery assistance.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- PRODUCT DESCRIPTION --}}
    {{-- ============================================================= --}}

    <div
        class="mt-10 rounded-2xl bg-white
               p-6 shadow-sm sm:p-8"
    >

        <h2
            class="text-2xl font-bold text-gray-900"
        >
            Product Description
        </h2>


        <div
            class="prose prose-gray mt-5 max-w-none
                   leading-7 text-gray-600"
        >

            @if($product->description)

                {!! nl2br(e($product->description)) !!}

            @else

                <p>
                    No detailed description is available
                    for this product.
                </p>

            @endif

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- PRODUCT INFORMATION --}}
    {{-- ============================================================= --}}

    <div
        class="mt-6 rounded-2xl bg-white
               p-6 shadow-sm sm:p-8"
    >

        <h2
            class="text-2xl font-bold text-gray-900"
        >
            Product Information
        </h2>


        <div
            class="mt-6 grid grid-cols-1 gap-4
                   sm:grid-cols-2 lg:grid-cols-3"
        >

            @if($product->sku)

                <div
                    class="rounded-xl bg-gray-50 p-4"
                >
                    <p
                        class="text-xs font-medium
                               uppercase tracking-wide
                               text-gray-500"
                    >
                        SKU
                    </p>

                    <p
                        class="mt-1 text-sm font-semibold
                               text-gray-900"
                    >
                        {{ $product->sku }}
                    </p>
                </div>

            @endif


            @if($product->category)

                <div
                    class="rounded-xl bg-gray-50 p-4"
                >
                    <p
                        class="text-xs font-medium
                               uppercase tracking-wide
                               text-gray-500"
                    >
                        Category
                    </p>

                    <p
                        class="mt-1 text-sm font-semibold
                               text-gray-900"
                    >
                        {{ $product->category->name }}
                    </p>
                </div>

            @endif


            @if($product->weight)

                <div
                    class="rounded-xl bg-gray-50 p-4"
                >
                    <p
                        class="text-xs font-medium
                               uppercase tracking-wide
                               text-gray-500"
                    >
                        Weight
                    </p>

                    <p
                        class="mt-1 text-sm font-semibold
                               text-gray-900"
                    >
                        {{ $product->weight }} kg
                    </p>
                </div>

            @endif

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- RELATED PRODUCTS --}}
    {{-- ============================================================= --}}

    @if($relatedProducts->count())

        <section class="mt-12">

            <div
                class="mb-6 flex items-end
                       justify-between gap-4"
            >

                <div>

                    <p
                        class="text-sm font-semibold
                               text-indigo-600"
                    >
                        You may also like
                    </p>

                    <h2
                        class="mt-1 text-2xl font-bold
                               text-gray-900"
                    >
                        Related Products
                    </h2>

                </div>


                <a
                    href="{{ route(
                        'products.index',
                        [
                            'category' =>
                                $product->category?->slug
                        ]
                    ) }}"
                    class="hidden text-sm font-semibold
                           text-indigo-600
                           hover:text-indigo-700
                           sm:block"
                >
                    View All
                </a>

            </div>


            <div
                class="grid grid-cols-1 gap-6
                       sm:grid-cols-2
                       lg:grid-cols-4"
            >

                @foreach($relatedProducts as $relatedProduct)

                    <x-product-card
                        :product="$relatedProduct"
                    />

                @endforeach

            </div>

        </section>

    @endif

</div>


</div>

{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>
    function increaseQuantity() {
        const input = document.getElementById('quantity');

        if (!input || input.disabled) {
            return;
        }

        let current = parseInt(input.value) || 1;
        const max = parseInt(input.max) || 20;

        if (current < max) {
            input.value = current + 1;
        }
    }


    function decreaseQuantity() {
        const input = document.getElementById('quantity');

        if (!input || input.disabled) {
            return;
        }

        let current = parseInt(input.value) || 1;
        const min = parseInt(input.min) || 1;

        if (current > min) {
            input.value = current - 1;
        }
    }


    function changeProductImage(imageUrl) {
        const mainImage =
            document.getElementById('mainProductImage');

        if (mainImage) {
            mainImage.src = imageUrl;
        }
    }
</script>

@endsection
