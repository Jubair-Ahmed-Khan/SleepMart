@extends('layouts.admin')

@section('page-title', 'Product Details')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Product Details
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $product->name }}
            </p>
        </div>

        <a
            href="{{ route('admin.products.edit', $product) }}"
            class="px-5 py-2.5 rounded-xl
                   bg-teal-600 text-white
                   font-semibold
                   hover:bg-teal-700"
        >
            Edit Product
        </a>

    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Product --}}
        <div
            class="lg:col-span-2
                   bg-white rounded-2xl
                   border border-gray-100
                   shadow-sm p-6"
        >

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    @if($product->thumbnail)

                        <img
                            src="{{ asset('storage/' . $product->thumbnail) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-80 object-cover rounded-2xl"
                        >

                    @else

                        <div
                            class="w-full h-80 rounded-2xl
                                   bg-gray-100
                                   flex items-center justify-center
                                   text-6xl"
                        >
                            🛏️
                        </div>

                    @endif

                </div>


                <div>

                    <p class="text-sm text-teal-600 font-semibold">
                        {{ $product->category?->name }}
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $product->name }}
                    </h2>

                    <p class="mt-3 text-gray-500">
                        {{ $product->short_description }}
                    </p>


                    <div class="mt-6">

                        <span class="text-2xl font-bold text-gray-900">
                            ৳{{ number_format((float) $product->selling_price, 0) }}
                        </span>

                        @if($product->regular_price > $product->selling_price)

                            <span class="ml-2 text-gray-400 line-through">
                                ৳{{ number_format((float) $product->regular_price, 0) }}
                            </span>

                        @endif

                    </div>


                    <div class="mt-5 space-y-2 text-sm">

                        <p>
                            <strong>SKU:</strong>
                            {{ $product->sku ?: 'N/A' }}
                        </p>

                        <p>
                            <strong>Stock:</strong>
                            {{ $product->stock }}
                        </p>

                        <p>
                            <strong>Status:</strong>
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </p>

                        <p>
                            <strong>Featured:</strong>
                            {{ $product->is_featured ? 'Yes' : 'No' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Actions --}}
        <div class="space-y-6">

            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm p-6"
            >

                <h3 class="font-bold text-gray-900">
                    Product Management
                </h3>


                <a
                    href="{{ route('admin.products.images.index', $product) }}"
                    class="mt-4 w-full inline-flex
                           justify-center px-4 py-3
                           rounded-xl
                           bg-gray-900 text-white
                           font-semibold
                           hover:bg-gray-800"
                >
                    Manage Gallery
                </a>


                <a
                    href="{{ route('admin.products.variants.index', $product) }}"
                    class="mt-3 w-full inline-flex
                           justify-center px-4 py-3
                           rounded-xl
                           bg-teal-600 text-white
                           font-semibold
                           hover:bg-teal-700"
                >
                    Manage Variants
                </a>


                @if($product->is_active)

                    <form
                        method="POST"
                        action="{{ route('admin.products.deactivate', $product) }}"
                        class="mt-3"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="w-full px-4 py-3
                                   rounded-xl
                                   bg-red-50 text-red-600
                                   font-semibold
                                   hover:bg-red-100"
                        >
                            Deactivate Product
                        </button>

                    </form>

                @else

                    <form
                        method="POST"
                        action="{{ route('admin.products.activate', $product) }}"
                        class="mt-3"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="w-full px-4 py-3
                                   rounded-xl
                                   bg-green-50 text-green-700
                                   font-semibold
                                   hover:bg-green-100"
                        >
                            Activate Product
                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>


    {{-- Variants --}}
    <div
        class="bg-white rounded-2xl
               border border-gray-100
               shadow-sm overflow-hidden"
    >

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-bold">
                Variants
            </h2>

        </div>


        @if($product->variants->isNotEmpty())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50">

                        <tr>
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-left">Size</th>
                            <th class="px-6 py-4 text-left">Thickness</th>
                            <th class="px-6 py-4 text-left">Price</th>
                            <th class="px-6 py-4 text-left">Stock</th>
                            <th class="px-6 py-4 text-left">SKU</th>
                            <th class="px-6 py-4 text-left">Status</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach($product->variants as $variant)

                            <tr>

                                <td class="px-6 py-4 font-medium">
                                    {{ $variant->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->size ?: '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->thickness ?: '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    ৳{{ number_format((float) $variant->price, 0) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->stock }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->sku ?: '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->is_active ? 'Active' : 'Inactive' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="p-8 text-center text-gray-500">
                No variants added.
            </div>

        @endif

    </div>

</div>

@endsection