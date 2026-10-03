@props([
    'product',
])

@php
    $hasVariants = $product->variants->isNotEmpty();

    $availableVariants = $product->variants->filter(function ($variant) {
        return $variant->is_active && $variant->stock > 0;
    });

    $hasAvailableVariant = $availableVariants->isNotEmpty();

    $canAddDirectly =
        !$hasVariants &&
        $product->stock > 0;

    $isOutOfStock =
        (!$hasVariants && $product->stock <= 0) ||
        ($hasVariants && !$hasAvailableVariant);

    if ($hasVariants && $hasAvailableVariant) {
        $startingPrice = $availableVariants->min('price');
    } else {
        $startingPrice = $product->selling_price;
    }
@endphp


{{-- Product Card --}}
<div
    class="bg-white rounded-2xl overflow-hidden
           border border-gray-100
           hover:shadow-xl transition duration-300
           flex flex-col h-full"
>

    {{-- Product Image --}}
    <a
        href="{{ route('products.show', $product->slug) }}"
        class="block shrink-0"
    >

        <div class="relative h-64 bg-gray-100 overflow-hidden">

            @if($product->primary_image_url)

                <img
                    src="{{ $product->primary_image_url }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover
                           hover:scale-105
                           transition duration-500"
                >

            @elseif($product->thumbnail)

                <img
                    src="{{ asset('storage/' . $product->thumbnail) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover
                           hover:scale-105
                           transition duration-500"
                >

            @else

                <div
                    class="w-full h-full flex items-center
                           justify-center text-6xl"
                >
                    🛏️
                </div>

            @endif


            {{-- Featured Badge --}}
            @if($product->is_featured)

                <span
                    class="absolute top-3 left-3
                           px-3 py-1 rounded-full
                           bg-teal-600 text-white
                           text-xs font-semibold"
                >
                    Featured
                </span>

            @endif


            {{-- Discount Badge --}}
            @if($product->discount_percentage > 0)

                <span
                    class="absolute top-3 right-3
                           px-3 py-1 rounded-full
                           bg-red-500 text-white
                           text-xs font-bold"
                >
                    -{{ $product->discount_percentage }}%
                </span>

            @endif

        </div>

    </a>


    {{-- Product Information --}}
    <div class="p-5 flex flex-col flex-1">

        {{-- Category --}}
        @if($product->category)

            <p
                class="text-xs font-semibold
                       text-teal-600 uppercase
                       tracking-wide"
            >
                {{ $product->category->name }}
            </p>

        @else

            {{-- Keep category area consistent --}}
            <div class="h-4"></div>

        @endif


        {{-- Product Name --}}
        <a
            href="{{ route('products.show', $product->slug) }}"
            class="block"
        >

            <h3
                class="mt-2 text-lg font-bold
                       text-gray-900
                       hover:text-teal-600
                       transition
                       line-clamp-2
                       min-h-[3.5rem]"
            >
                {{ $product->name }}
            </h3>

        </a>


        {{-- Short Description --}}
        @if($product->short_description)

            <p
                class="mt-2 text-sm text-gray-500
                       line-clamp-2
                       min-h-[2.5rem]"
            >
                {{ $product->short_description }}
            </p>

        @else

            <div class="mt-2 min-h-[2.5rem]"></div>

        @endif


        {{-- Rating --}}
        <div class="mt-3 flex items-center gap-2">

            <div class="flex items-center text-yellow-400">
                ★★★★★
            </div>

            <span class="text-xs text-gray-500">
                {{ number_format((float) $product->rating, 1) }}
                ({{ $product->reviews_count }})
            </span>

        </div>


        {{-- Price --}}
        <div class="mt-4">

            @if($hasVariants)

                <span class="text-xs text-gray-500">
                    From
                </span>

            @endif

            <span class="text-xl font-bold text-gray-900">
                ৳{{ number_format((float) $startingPrice, 0) }}
            </span>


            {{-- Regular Price --}}
            @if(
                !$hasVariants &&
                $product->regular_price > $product->selling_price
            )

                <span
                    class="ml-2 text-sm text-gray-400
                           line-through"
                >
                    ৳{{ number_format((float) $product->regular_price, 0) }}
                </span>

            @endif

        </div>


        {{-- Stock Status --}}
        @if(!$isOutOfStock)

            @if(!$hasVariants && $product->stock <= 5)

                <p class="mt-2 text-xs text-orange-600 font-medium">
                    Only {{ $product->stock }} left in stock
                </p>

            @elseif($hasVariants)

                <p class="mt-2 text-xs text-green-600 font-medium">
                    Available
                </p>

            @else

                {{-- Keep stock area consistent --}}
                <div class="mt-2 h-4"></div>

            @endif

        @else

            <p class="mt-2 text-xs text-red-500 font-medium">
                Currently unavailable
            </p>

        @endif


        {{-- Action --}}
        <div class="mt-auto pt-5">

            {{-- Product without variants --}}
            @if($canAddDirectly)

                <form
                    action="{{ route('cart.add', $product->slug) }}"
                    method="POST"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="quantity"
                        value="1"
                    >

                    <button
                        type="submit"
                        class="w-full inline-flex
                               items-center justify-center
                               gap-2 px-4 py-3
                               bg-teal-600 text-white
                               rounded-xl font-semibold
                               hover:bg-teal-700
                               transition"
                    >
                        🛒 Add to Cart
                    </button>

                </form>


            {{-- Product with available variants --}}
            @elseif($hasAvailableVariant)

                <a
                    href="{{ route('products.show', $product->slug) }}"
                    class="w-full inline-flex
                           items-center justify-center
                           gap-2 px-4 py-3
                           bg-teal-600 text-white
                           rounded-xl font-semibold
                           hover:bg-teal-700
                           transition"
                >
                    🛒 Add to Cart
                </a>


            {{-- Out of stock --}}
            @else

                <button
                    type="button"
                    disabled
                    class="w-full px-4 py-3
                           bg-gray-200 text-gray-500
                           rounded-xl font-semibold
                           cursor-not-allowed"
                >
                    Out of Stock
                </button>

            @endif

        </div>

    </div>

</div>