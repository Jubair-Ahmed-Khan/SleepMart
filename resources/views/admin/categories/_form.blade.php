@php
    $category = $category ?? new \App\Models\Category();
@endphp

@csrf

@if($category->exists)
    @method('PATCH')
@endif


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2">

        <div
            class="bg-white rounded-2xl
                   border border-gray-100
                   shadow-sm p-6"
        >

            <h2 class="text-lg font-bold text-gray-900 mb-6">
                Category Information
            </h2>


            {{-- Name --}}
            <div>

                <label class="block text-sm font-semibold mb-2">
                    Category Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    required
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

            </div>


            {{-- Slug --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold mb-2">
                    Slug
                </label>

                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug', $category->slug) }}"
                    placeholder="Leave empty to generate automatically"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

            </div>


            {{-- Icon --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold mb-2">
                    Icon
                </label>

                <input
                    type="text"
                    name="icon"
                    value="{{ old('icon', $category->icon) }}"
                    placeholder="🛏️"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

            </div>


            {{-- Description --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >{{ old('description', $category->description) }}</textarea>

            </div>

        </div>

    </div>


    <div class="space-y-6">

        {{-- Image --}}
        <div
            class="bg-white rounded-2xl
                   border border-gray-100
                   shadow-sm p-6"
        >

            <h2 class="text-lg font-bold mb-5">
                Category Image
            </h2>


            @if($category->image)

                <img
                    src="{{ asset('storage/' . $category->image) }}"
                    alt="{{ $category->name }}"
                    class="w-full h-48 object-cover
                           rounded-xl mb-4"
                >

            @endif


            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                class="w-full text-sm"
            >

            <p class="mt-2 text-xs text-gray-500">
                JPG, PNG or WebP. Maximum 2MB.
            </p>

        </div>


        {{-- Settings --}}
        <div
            class="bg-white rounded-2xl
                   border border-gray-100
                   shadow-sm p-6"
        >

            <h2 class="text-lg font-bold mb-5">
                Settings
            </h2>


            <label class="block text-sm font-semibold mb-2">
                Sort Order
            </label>

            <input
                type="number"
                name="sort_order"
                min="0"
                value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                class="w-full rounded-xl border-gray-300"
            >


            <label class="flex items-center gap-3 mt-5">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(
                        old(
                            'is_active',
                            $category->exists
                                ? $category->is_active
                                : true
                        )
                    )
                    class="rounded border-gray-300
                           text-teal-600"
                >

                <span class="text-sm font-medium">
                    Active
                </span>

            </label>

        </div>


        <button
            type="submit"
            class="w-full px-5 py-3
                   bg-teal-600 text-white
                   rounded-xl font-semibold
                   hover:bg-teal-700"
        >
            {{ $category->exists
                ? 'Update Category'
                : 'Create Category' }}
        </button>

    </div>

</div>