@props([
    'category',
])

<a
    href="{{ route('products.index', ['category' => $category->slug]) }}"
    class="group bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300"
>
    <div class="flex items-center justify-between">
        <div
            class="w-14 h-14 rounded-2xl bg-teal-50 flex items-center justify-center text-3xl group-hover:bg-teal-600 group-hover:scale-110 transition duration-300"
        >
            @if($category->slug === 'mattresses')
                🛏️
            @elseif($category->slug === 'pillows')
                💤
            @else
                🏠
            @endif
        </div>

        <span
            class="text-sm font-medium text-gray-400 group-hover:text-teal-600 transition"
        >
            →
        </span>
    </div>

    <h3
        class="mt-5 text-xl font-bold text-gray-900 group-hover:text-teal-600 transition"
    >
        {{ $category->name }}
    </h3>

    @if($category->description)
        <p class="mt-2 text-sm text-gray-500 line-clamp-2">
            {{ $category->description }}
        </p>
    @endif

    <div class="mt-4">
        <span class="text-sm font-semibold text-teal-600">
            {{ $category->products_count }}
            {{ $category->products_count == 1 ? 'product' : 'products' }}
        </span>
    </div>
</a>