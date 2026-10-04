@extends('layouts.admin')

@section('page-title', 'Create Product')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Create Product
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Add a new product to SleepMart.
            </p>
        </div>

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


    <form
        method="POST"
        action="{{ route('admin.products.store') }}"
        enctype="multipart/form-data"
    >
        @csrf
        @include('admin.products._form', [
                    'product' => $product,
                    'categories' => $categories,
                ]
        )
                

    </form>

</div>

@endsection