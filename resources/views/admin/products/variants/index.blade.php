@extends('layouts.admin')

@section('page-title', 'Product Variants')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Product Variants
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $product->name }}
            </p>

        </div>

        <a
            href="{{ route('admin.products.show', $product) }}"
            class="px-4 py-2 rounded-xl
                   border border-gray-200
                   text-sm font-semibold
                   hover:bg-gray-50"
        >
            ← Product
        </a>

    </div>


    <!-- @if(session('success'))

        <div
            class="p-4 rounded-xl
                   bg-green-50
                   border border-green-200
                   text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif -->


    {{-- Add Variant --}}
    <div
        class="bg-white rounded-2xl
               border border-gray-100
               shadow-sm p-6"
    >

        <h2 class="text-lg font-bold text-gray-900">
            Add Variant
        </h2>


        <form
            method="POST"
            action="{{ route('admin.products.variants.store', $product) }}"
            class="mt-6"
        >

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Variant Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="5×6.5 ft - 6 inch"
                        required
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-semibold mb-2">
                        SKU
                    </label>

                    <input
                        type="text"
                        name="sku"
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Size
                    </label>

                    <input
                        type="text"
                        name="size"
                        placeholder="5×6.5 ft"
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Thickness
                    </label>

                    <input
                        type="text"
                        name="thickness"
                        placeholder="6 inch"
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Price (৳)
                    </label>

                    <input
                        type="number"
                        name="price"
                        step="0.01"
                        min="0"
                        required
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        min="0"
                        required
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >
                </div>

            </div>


            <label class="mt-5 flex items-center gap-3">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    checked
                    class="rounded border-gray-300
                           text-teal-600"
                >

                <span class="text-sm font-medium">
                    Active
                </span>

            </label>


            <button
                type="submit"
                class="mt-5 px-5 py-3
                       rounded-xl
                       bg-teal-600 text-white
                       font-semibold
                       hover:bg-teal-700"
            >
                Add Variant
            </button>

        </form>

    </div>


    {{-- Existing Variants --}}
    <div
        class="bg-white rounded-2xl
               border border-gray-100
               shadow-sm overflow-hidden"
    >

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-bold">
                Existing Variants
            </h2>

        </div>


        @if($variants->isNotEmpty())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Name
                            </th>

                            <th class="px-6 py-4 text-left">
                                Size
                            </th>

                            <th class="px-6 py-4 text-left">
                                Thickness
                            </th>

                            <th class="px-6 py-4 text-left">
                                Price
                            </th>

                            <th class="px-6 py-4 text-left">
                                Stock
                            </th>

                            <th class="px-6 py-4 text-left">
                                SKU
                            </th>

                            <th class="px-6 py-4 text-left">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($variants as $variant)

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

                                    @if($variant->is_active)

                                        <span class="text-green-600 font-semibold">
                                            Active
                                        </span>

                                    @else

                                        <span class="text-gray-500 font-semibold">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    <details>

                                        <summary
                                            class="cursor-pointer
                                                   text-teal-600
                                                   font-semibold"
                                        >
                                            Edit
                                        </summary>

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.products.variants.update',
                                                [$product, $variant]
                                            ) }}"
                                            class="mt-4 space-y-3"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ $variant->name }}"
                                                required
                                                class="w-full rounded-lg
                                                       border-gray-300"
                                            >

                                            <input
                                                type="text"
                                                name="sku"
                                                value="{{ $variant->sku }}"
                                                placeholder="SKU"
                                                class="w-full rounded-lg
                                                       border-gray-300"
                                            >

                                            <input
                                                type="text"
                                                name="size"
                                                value="{{ $variant->size }}"
                                                placeholder="Size"
                                                class="w-full rounded-lg
                                                       border-gray-300"
                                            >

                                            <input
                                                type="text"
                                                name="thickness"
                                                value="{{ $variant->thickness }}"
                                                placeholder="Thickness"
                                                class="w-full rounded-lg
                                                       border-gray-300"
                                            >

                                            <input
                                                type="number"
                                                name="price"
                                                value="{{ $variant->price }}"
                                                step="0.01"
                                                min="0"
                                                required
                                                class="w-full rounded-lg
                                                       border-gray-300"
                                            >

                                            <input
                                                type="number"
                                                name="stock"
                                                value="{{ $variant->stock }}"
                                                min="0"
                                                required
                                                class="w-full rounded-lg
                                                       border-gray-300"
                                            >

                                            <label class="flex items-center gap-2">

                                                <input
                                                    type="checkbox"
                                                    name="is_active"
                                                    value="1"
                                                    @checked($variant->is_active)
                                                >

                                                Active

                                            </label>

                                            <button
                                                type="submit"
                                                class="px-4 py-2
                                                       rounded-lg
                                                       bg-teal-600
                                                       text-white"
                                            >
                                                Save
                                            </button>

                                        </form>


                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.products.variants.destroy',
                                                [$product, $variant]
                                            ) }}"
                                            class="mt-3"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-600
                                                       font-semibold"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </details>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="p-10 text-center text-gray-500">
                No variants found.
            </div>

        @endif

    </div>

</div>

@endsection