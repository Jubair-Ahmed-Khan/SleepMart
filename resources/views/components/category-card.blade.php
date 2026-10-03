@props([
    'category',
])

<a
    href="{{ route('products.index', ['category' => $category->slug]) }}"
    class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300"
>
    {{-- Category Image --}}
    <div class="relative h-48 bg-gradient-to-br from-teal-50 to-cyan-50 overflow-hidden">

        @if($category->image)
            <img
                src="{{ $category->image_url }}"
                alt="{{ $category->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
            >
        @else
            <div class="w-full h-full flex items-center justify-center">
                <span
                    class="text-7xl group-hover:scale-110 transition duration-300"
                >
                    {{ $category->icon ?? '🛍️' }}
                </span>
            </div>
        @endif

        {{-- Product count --}}
        <div
            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-sm"
        >
            <span class="text-xs font-semibold text-gray-700">
                {{ $category->products_count }}
                {{ $category->products_count == 1 ? 'product' : 'products' }}
            </span>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5">

        <div class="flex items-center justify-between gap-4">

            <div>
                <h3
                    class="text-xl font-bold text-gray-900 group-hover:text-teal-600 transition"
                >
                    {{ $category->name }}
                </h3>

                @if($category->description)
                    <p class="mt-2 text-sm text-gray-500 line-clamp-2">
                        {{ $category->description }}
                    </p>
                @endif
            </div>

            <span
                class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition"
            >
                →
            </span>

        </div>

        <div class="mt-4">
            <span class="text-sm font-semibold text-teal-600">
                Shop {{ $category->name }}
            </span>
        </div>

    </div>
</a>