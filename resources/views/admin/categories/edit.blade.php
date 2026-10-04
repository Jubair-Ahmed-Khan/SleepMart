@extends('layouts.admin')

@section('page-title', 'Edit Category')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold">
                Edit Category
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $category->name }}
            </p>

        </div>

        <a
            href="{{ route('admin.categories.index') }}"
            class="px-4 py-2 rounded-xl
                   border border-gray-200"
        >
            ← Back
        </a>

    </div>


    <form
        method="POST"
        action="{{ route('admin.categories.update', $category) }}"
        enctype="multipart/form-data"
    >

      @csrf
      @method('PATCH')

      @include(
          'admin.categories._form',
          [
              'category' => $category,
          ]
      )

    </form>

</div>

@endsection