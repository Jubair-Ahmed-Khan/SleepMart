@extends('layouts.admin')

@section('title', 'Manage Images | SleepMart')

@section('page-title', 'Product Images')

@section('content')


{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>

        <div class="flex items-center gap-3">

            <a
                href="{{ route('admin.products.index') }}"
                class="w-9 h-9 rounded-lg
                       bg-white border border-gray-200
                       flex items-center justify-center
                       text-gray-600
                       hover:bg-gray-50 transition"
            >
                ←
            </a>

            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Product Images
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage images for
                    <span class="font-semibold text-gray-700">
                        {{ $product->name }}
                    </span>
                </p>
            </div>

        </div>

    </div>

</div>


{{-- Upload Images --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">

    <div class="mb-5">

        <h3 class="text-lg font-bold text-gray-900">
            Upload Images
        </h3>

        <p class="mt-1 text-sm text-gray-500">
            Upload one or multiple product images.
        </p>

    </div>


    <form
        method="POST"
        action="{{ route(
            'admin.products.images.store',
            $product
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf

        <div
            class="border-2 border-dashed border-gray-200
                   rounded-xl p-8 text-center
                   hover:border-teal-400
                   transition"
        >

            <div class="text-4xl mb-3">
                🖼️
            </div>

            <label
                for="images"
                class="cursor-pointer"
            >

                <span class="text-sm font-semibold text-teal-600">
                    Choose images
                </span>

                <span class="text-sm text-gray-500">
                    or drag and drop
                </span>

            </label>

            <input
                id="images"
                name="images[]"
                type="file"
                multiple
                accept="image/jpeg,image/png,image/webp"
                class="block w-full mt-4 text-sm text-gray-500
                       file:mr-4 file:py-2.5 file:px-4
                       file:rounded-lg file:border-0
                       file:text-sm file:font-semibold
                       file:bg-teal-50 file:text-teal-700
                       hover:file:bg-teal-100"
            >

            <p class="mt-3 text-xs text-gray-400">
                JPG, PNG or WebP. Multiple images are allowed.
            </p>

        </div>


        <div class="mt-5 flex justify-end">

            <button
                type="submit"
                class="inline-flex items-center gap-2
                       px-5 py-2.5 rounded-lg
                       bg-teal-600 text-white
                       text-sm font-semibold
                       hover:bg-teal-700 transition"
            >
                ⬆️ Upload Images
            </button>

        </div>

    </form>

</div>


{{-- Existing Images --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="text-lg font-bold text-gray-900">
                Product Gallery
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                {{ $product->images->count() }}
                {{ $product->images->count() === 1 ? 'image' : 'images' }}
            </p>

        </div>

    </div>


    @if($product->images->isEmpty())

        {{-- Empty State --}}
        <div class="py-16 text-center">

            <div class="text-5xl">
                🖼️
            </div>

            <h3 class="mt-4 text-lg font-bold text-gray-900">
                No images yet
            </h3>

            <p class="mt-2 text-sm text-gray-500">
                Upload images using the form above.
            </p>

        </div>

    @else

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($product->images as $image)

                <div
                    class="group border border-gray-200
                           rounded-xl overflow-hidden
                           bg-white"
                >

                    {{-- Image --}}
                    <div class="relative aspect-square bg-gray-100">

                        <img
                            src="{{ $image->url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >


                        {{-- Primary Badge --}}
                        @if($image->is_primary)

                            <div
                                class="absolute top-3 left-3
                                       px-3 py-1 rounded-full
                                       bg-teal-600 text-white
                                       text-xs font-semibold"
                            >
                                ⭐ Primary
                            </div>

                        @endif

                    </div>


                    {{-- Image Details --}}
                    <div class="p-4">

                        <div class="flex items-center justify-between">

                            <span class="text-xs text-gray-500">
                                Order:
                                {{ $image->sort_order }}
                            </span>

                            @if(!$image->is_primary)

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.products.images.primary',
                                        [
                                            'product' => $product,
                                            'image' => $image
                                        ]
                                    ) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="text-xs font-semibold
                                               text-teal-600
                                               hover:text-teal-700"
                                    >
                                        Make Primary
                                    </button>

                                </form>

                            @endif

                        </div>


                        {{-- Delete --}}
                        <form
                            method="POST"
                            action="{{ route(
                                'admin.products.images.destroy',
                                [
                                    'product' => $product,
                                    'image' => $image
                                ]
                            ) }}"
                            class="mt-3"
                            onsubmit="return confirm(
                                'Are you sure you want to delete this image?'
                            );"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full inline-flex
                                       items-center justify-center gap-2
                                       px-3 py-2 rounded-lg
                                       bg-red-50 text-red-600
                                       text-sm font-semibold
                                       hover:bg-red-100 transition"
                            >
                                🗑️ Delete Image
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection
