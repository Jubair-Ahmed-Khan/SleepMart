@php
    $product = $product ?? new \App\Models\Product();
@endphp

@csrf

@if($product->exists)
    @method('PATCH')
@endif


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Main Information --}}
    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="text-lg font-bold text-gray-900 mb-6">
                Product Information
            </h2>


            {{-- Category --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Category
                </label>

                <select
                    name="category_id"
                    required
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(
                                old(
                                    'category_id',
                                    $product->category_id
                                ) == $category->id
                            )
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Name --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Product Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Slug --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Slug
                </label>

                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug', $product->slug) }}"
                    placeholder="Leave empty to generate automatically"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

            </div>


            {{-- SKU --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    SKU
                </label>

                <input
                    type="text"
                    name="sku"
                    value="{{ old('sku', $product->sku) }}"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >

            </div>


            {{-- Short Description --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Short Description
                </label>

                <textarea
                    name="short_description"
                    rows="3"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >{{ old('short_description', $product->short_description) }}</textarea>

            </div>


            {{-- Description --}}
            <div class="mt-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="7"
                    class="w-full rounded-xl border-gray-300
                           focus:border-teal-500
                           focus:ring-teal-500"
                >{{ old('description', $product->description) }}</textarea>

            </div>

        </div>


        {{-- Pricing --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="text-lg font-bold text-gray-900 mb-6">
                Pricing & Stock
            </h2>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Regular Price (৳)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="regular_price"
                        value="{{ old('regular_price', $product->regular_price) }}"
                        required
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >

                </div>


                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Selling Price (৳)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="selling_price"
                        value="{{ old('selling_price', $product->selling_price) }}"
                        required
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >

                </div>


                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Cost Price (৳)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="cost_price"
                        value="{{ old('cost_price', $product->cost_price) }}"
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >

                </div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Stock
                    </label>

                    <input
                        type="number"
                        min="0"
                        name="stock"
                        value="{{ old('stock', $product->stock ?? 0) }}"
                        required
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >

                </div>


                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Weight
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="weight"
                        value="{{ old('weight', $product->weight) }}"
                        placeholder="kg"
                        class="w-full rounded-xl border-gray-300
                               focus:border-teal-500
                               focus:ring-teal-500"
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- Sidebar --}}
    <div class="space-y-6">

        {{-- Thumbnail --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="text-lg font-bold text-gray-900 mb-5">
                Thumbnail
            </h2>

            @if($product->thumbnail)

                <img
                    src="{{ asset('storage/' . $product->thumbnail) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover rounded-xl mb-4"
                >

            @endif

            <input
                type="file"
                name="thumbnail"
                accept="image/jpeg,image/png,image/webp"
                class="w-full text-sm"
            >

            <p class="mt-2 text-xs text-gray-500">
                JPG, PNG or WebP. Maximum 2MB.
            </p>

        </div>


        {{-- Status --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="text-lg font-bold text-gray-900 mb-5">
                Status
            </h2>


            <label class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    @checked(
                        old(
                            'is_featured',
                            $product->is_featured
                        )
                    )
                    class="rounded border-gray-300
                           text-teal-600
                           focus:ring-teal-500"
                >

                <span class="text-sm font-medium text-gray-700">
                    Featured Product
                </span>

            </label>


            <label class="flex items-center gap-3 mt-4">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(
                        old(
                            'is_active',
                            $product->exists
                                ? $product->is_active
                                : true
                        )
                    )
                    class="rounded border-gray-300
                           text-teal-600
                           focus:ring-teal-500"
                >

                <span class="text-sm font-medium text-gray-700">
                    Active Product
                </span>

            </label>

        </div>


        {{-- Submit --}}
        <button
            type="submit"
            class="w-full px-5 py-3
                   bg-teal-600 text-white
                   rounded-xl font-semibold
                   hover:bg-teal-700 transition"
        >
            {{ $product->exists ? 'Update Product' : 'Create Product' }}
        </button>

    </div>

</div>