@extends('layouts.admin')

@section('page-title', 'Categories')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Categories
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage SleepMart product categories.
            </p>

        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="px-5 py-3 rounded-xl
                   bg-teal-600 text-white
                   font-semibold
                   hover:bg-teal-700"
        >
            + Add Category
        </a>

    </div>


    @if(session('success'))

        <div
            class="p-4 rounded-xl
                   bg-green-50
                   border border-green-200
                   text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    @if(session('warning'))

        <div
            class="p-4 rounded-xl
                   bg-yellow-50
                   border border-yellow-200
                   text-yellow-700"
        >
            {{ session('warning') }}
        </div>

    @endif


    <div
        class="bg-white rounded-2xl
               border border-gray-100
               shadow-sm overflow-hidden"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Image
                        </th>

                        <th class="px-6 py-4 text-left">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left">
                            Products
                        </th>

                        <th class="px-6 py-4 text-left">
                            Sort
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($categories as $category)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                @if($category->image)

                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="w-14 h-14
                                               rounded-xl
                                               object-cover"
                                    >

                                @else

                                    <div
                                        class="w-14 h-14
                                               rounded-xl
                                               bg-gray-100
                                               flex items-center
                                               justify-center
                                               text-2xl"
                                    >
                                        {{ $category->icon ?: '🛏️' }}
                                    </div>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                <p class="font-semibold text-gray-900">
                                    {{ $category->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $category->slug }}
                                </p>

                            </td>


                            <td class="px-6 py-4">
                                {{ $category->products_count }}
                            </td>


                            <td class="px-6 py-4">
                                {{ $category->sort_order }}
                            </td>


                            <td class="px-6 py-4">

                                @if($category->is_active)

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

                                <div class="flex items-center gap-4">

                                    <a
                                        href="{{ route(
                                            'admin.categories.edit',
                                            $category
                                        ) }}"
                                        class="text-teal-600
                                               font-semibold"
                                    >
                                        Edit
                                    </a>


                                    @if($category->is_active)

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.categories.deactivate',
                                                $category
                                            ) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="text-orange-600
                                                       font-semibold"
                                            >
                                                Deactivate
                                            </button>

                                        </form>

                                    @else

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.categories.activate',
                                                $category
                                            ) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="text-green-600
                                                       font-semibold"
                                            >
                                                Activate
                                            </button>

                                        </form>

                                    @endif


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.categories.destroy',
                                            $category
                                        ) }}"
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

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12
                                       text-center
                                       text-gray-500"
                            >
                                No categories found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="p-6 border-t border-gray-100">
            {{ $categories->links() }}
        </div>

    </div>

</div>

@endsection