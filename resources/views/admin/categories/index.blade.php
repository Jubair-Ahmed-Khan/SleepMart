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


    <!-- @if(session('success'))

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

    @endif -->


    <div
        class="bg-white rounded-2xl
               border border-gray-100
               shadow-sm overflow-hidden"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-center">
                            Image
                        </th>

                        <th class="px-6 py-4 text-center">
                            Category
                        </th>

                        <th class="px-6 py-4 text-center">
                            Products
                        </th>

                        <th class="px-6 py-4 text-center">
                            Sort
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($categories as $category)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 mx-auto flex
                                       items-center justify-center">

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


                            <td class="px-6 py-4 text-center">

                                <p class="font-semibold text-gray-900">
                                    {{ $category->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $category->slug }}
                                </p>

                            </td>


                            <td class="px-6 py-4 text-center">
                                {{ $category->products_count }}
                            </td>


                            <td class="px-6 py-4 text-center">
                                {{ $category->sort_order }}
                            </td>


                            <td class="px-6 py-4 text-center">

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


                            <td class="px-6 py-4 mx-auto flex items-center justify-center gap-2">
                                <div class="flex items-center">

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        title="Edit category"
                                        aria-label="Edit category"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                              rounded-lg text-teal-600 transition
                                              hover:bg-teal-50 hover:text-teal-700"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18"
                                            viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                                        </svg>
                                    </a>

                                    {{-- Activate / Deactivate --}}
                                    @if($category->is_active)

                                        <form
                                            method="POST"
                                            action="{{ route('admin.categories.deactivate', $category) }}"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                title="Deactivate category"
                                                aria-label="Deactivate category"
                                                class="inline-flex h-9 w-9 items-center justify-center
                                                      rounded-lg text-orange-600 transition
                                                      hover:bg-orange-50 hover:text-orange-700"
                                            >
                                                {{-- Power icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18"
                                                    viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v10"/>
                                                    <path d="M18.4 6.6a9 9 0 1 1-12.8 0"/>
                                                </svg>
                                            </button>
                                        </form>

                                    @else

                                        <form
                                            method="POST"
                                            action="{{ route('admin.categories.activate', $category) }}"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                title="Activate category"
                                                aria-label="Activate category"
                                                class="inline-flex h-9 w-9 items-center justify-center
                                                      rounded-lg text-green-600 transition
                                                      hover:bg-green-50 hover:text-green-700"
                                            >
                                                {{-- Check-circle icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18"
                                                    viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <path d="m9 12 2 2 4-4"/>
                                                </svg>
                                            </button>
                                        </form>

                                    @endif

                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete category"
                                            aria-label="Delete category"
                                            class="inline-flex h-9 w-9 items-center justify-center
                                                  rounded-lg text-red-600 transition
                                                  hover:bg-red-50 hover:text-red-700"
                                        >
                                            {{-- Trash icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18"
                                                viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="m19 6-1 14H6L5 6"/>
                                                <path d="M10 11v5"/>
                                                <path d="M14 11v5"/>
                                            </svg>
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