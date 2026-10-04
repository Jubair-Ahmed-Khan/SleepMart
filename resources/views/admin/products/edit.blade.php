@extends('layouts.admin')

@section('page-title', 'Edit Product')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Edit Product
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $product->name }}
            </p>
        </div>

        <div class="flex gap-3">

            <a
                href="{{ route('admin.products.show', $product) }}"
                class="px-4 py-2 rounded-xl
                       border border-gray-200
                       text-sm font-semibold
                       hover:bg-gray-50"
            >
                View
            </a>

            <a
                href="{{ route('admin.products.index') }}"
                class="px-4 py-2 rounded-xl
                       border border-gray-200
                       text-sm font-semibold
                       hover:bg-gray-50"
            >
                ← Back
            </a>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('admin.products.update', $product) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PATCH')

        @include('admin.products._form' ,
                [
                    'product' => $product,
                    'categories' => $categories,
                ]
        )

    </form>

</div>

@endsection