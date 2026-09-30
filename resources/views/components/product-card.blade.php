@props(['product'])

<div
    class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
>

    {{-- Image --}}
    <a
        href="{{ route('products.show', $product->slug) }}"
        class="relative block aspect-square overflow-hidden bg-slate-100"
    >

        @if($product->thumbnail)
            <img
                src="{{ asset('storage/' . $product->thumbnail) }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
            >
        @else

            <div class="flex h-full items-center justify-center bg-gradient-to-br from-teal-50 to-slate-100">

                @if($product->category->slug === 'mattresses')
                    <span class="text-8xl">
                        🛏️
                    </span>
                @else
                    <span class="text-8xl">
                        💤
                    </span>
                @endif

            </div>

        @endif


        {{-- Discount --}}
        @if($product->discount_percentage > 0)

            <span
                class="absolute left-3 top-3 rounded-full bg-red-500 px-3 py-1 text-xs font-bold text-white"
            >
                -{{ $product->discount_percentage }}%
            </span>

        @endif


        {{-- Wishlist --}}
        <button
            type="button"
            class="absolute right-3 top-3 flex h-10 w-10 items-center justify-center rounded-full bg-white text-xl shadow-md transition hover:bg-teal-50 hover:text-teal-700"
            title="Add to wishlist"
        >
            ♡
        </button>

    </a>


    {{-- Content --}}
    <div class="p-4">

        <p class="text-xs font-semibold uppercase tracking-wide text-teal-700">
            {{ $product->category->name }}
        </p>


        <a
            href="{{ route('products.show', $product->slug) }}"
            class="mt-1 block"
        >

            <h3
                class="line-clamp-2 min-h-[3rem] font-semibold text-slate-900 transition hover:text-teal-700"
            >
                {{ $product->name }}
            </h3>

        </a>


        {{-- Rating --}}
        <div class="mt-2 flex items-center gap-1 text-sm">

            <span class="text-amber-500">
                ★
            </span>

            <span class="font-medium">
                {{ number_format($product->rating, 1) }}
            </span>

            <span class="text-slate-400">
                ({{ $product->reviews_count }})
            </span>

        </div>


        {{-- Price --}}
        <div class="mt-3 flex flex-wrap items-center gap-2">

            <span class="text-xl font-bold text-slate-900">
                ৳{{ number_format($product->selling_price) }}
            </span>

            @if($product->regular_price > $product->selling_price)

                <span class="text-sm text-slate-400 line-through">
                    ৳{{ number_format($product->regular_price) }}
                </span>

            @endif

        </div>


        {{-- Stock --}}
        <div class="mt-2">

            @if($product->stock > 0)

                <span class="text-xs font-medium text-emerald-600">
                    ✓ In Stock
                </span>

            @else

                <span class="text-xs font-medium text-red-600">
                    Out of Stock
                </span>

            @endif

        </div>


        {{-- Cart button --}}
        <button
            type="button"
            class="mt-4 w-full rounded-xl bg-teal-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-teal-800"
        >
            Add to Cart
        </button>

    </div>

</div>