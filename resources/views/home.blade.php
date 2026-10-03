@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    </div>
@endif

@extends('layouts.app')

@section('title', 'SleepMart - Better Sleep. Better Life.')

@section('content')

    {{-- Hero --}}
    <!-- <section class="bg-gradient-to-br from-teal-50 via-white to-cyan-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-20">

                <div>

                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-teal-100 text-teal-700 text-sm font-semibold mb-6">
                        🛏️ Quality Sleep Products
                    </span>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Sleep Better.
                        <span class="text-teal-600">
                            Live Better.
                        </span>
                    </h1>

                    <p class="mt-6 text-lg text-gray-600 leading-8 max-w-xl">
                        Discover comfortable mattresses and pillows
                        designed to give you the restful sleep you deserve.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center px-7 py-3.5 bg-teal-600 text-white font-semibold rounded-xl hover:bg-teal-700 transition shadow-lg"
                        >
                            Shop Now
                            <span class="ml-2">→</span>
                        </a>

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center px-7 py-3.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-200 hover:border-teal-500 hover:text-teal-600 transition"
                        >
                            Explore Products
                        </a>

                    </div>

                    <div class="mt-10 grid grid-cols-3 gap-6 max-w-md">

                        <div>
                            <div class="text-2xl font-bold text-gray-900">
                                100%
                            </div>
                            <div class="text-sm text-gray-500">
                                Quality
                            </div>
                        </div>

                        <div>
                            <div class="text-2xl font-bold text-gray-900">
                                COD
                            </div>
                            <div class="text-sm text-gray-500">
                                Available
                            </div>
                        </div>

                        <div>
                            <div class="text-2xl font-bold text-gray-900">
                                BD
                            </div>
                            <div class="text-sm text-gray-500">
                                Delivery
                            </div>
                        </div>

                    </div>

                </div>

                <div class="relative">

                    <div class="bg-gradient-to-br from-teal-100 to-cyan-100 rounded-3xl p-8">

                        <div class="bg-white rounded-3xl shadow-xl p-10 text-center">

                            <div class="text-8xl mb-6">
                                🛏️
                            </div>

                            <h2 class="text-2xl font-bold text-gray-900">
                                Your Perfect Sleep
                            </h2>

                            <p class="mt-3 text-gray-500">
                                Comfort that makes every night better.
                            </p>

                            <div class="mt-6 inline-flex px-5 py-2 rounded-full bg-teal-50 text-teal-700 font-semibold">
                                SleepMart
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section> -->
    <section class="relative overflow-hidden bg-gradient-to-br from-teal-900 via-teal-800 to-cyan-800">

        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-white"></div>
            <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-cyan-300"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[620px] py-16 lg:py-20">

                {{-- Text --}}
                <div class="text-center lg:text-left">

                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white text-sm font-semibold"
                    >
                        ✨ Better Sleep. Better Life.
                    </span>

                    <h1
                        class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight"
                    >
                        Sleep Better.
                        <span class="text-cyan-300">
                            Wake Better.
                        </span>
                    </h1>

                    <p
                        class="mt-6 text-lg text-teal-100 max-w-xl mx-auto lg:mx-0 leading-relaxed"
                    >
                        Discover quality mattresses and pillows designed
                        to bring comfort, support and restful sleep to your home.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center px-7 py-4 bg-white text-teal-800 rounded-xl font-bold hover:bg-gray-100 transition shadow-lg"
                        >
                            Shop Now
                            <span class="ml-2">→</span>
                        </a>

                        <a
                            href="#categories"
                            class="inline-flex items-center justify-center px-7 py-4 border border-white/30 text-white rounded-xl font-bold hover:bg-white/10 transition"
                        >
                            Explore Categories
                        </a>

                    </div>

                    {{-- Benefits --}}
                    <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-5">

                        <div class="text-center lg:text-left">
                            <div class="text-2xl">🚚</div>
                            <p class="mt-2 text-sm font-semibold text-white">
                                Bangladesh Delivery
                            </p>
                        </div>

                        <div class="text-center lg:text-left">
                            <div class="text-2xl">💳</div>
                            <p class="mt-2 text-sm font-semibold text-white">
                                Cash on Delivery
                            </p>
                        </div>

                        <div class="text-center lg:text-left">
                            <div class="text-2xl">⭐</div>
                            <p class="mt-2 text-sm font-semibold text-white">
                                Quality Products
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Visual --}}
                <div class="hidden sm:block">

                    <div class="relative max-w-lg mx-auto">

                        <div
                            class="absolute inset-0 bg-cyan-300/20 rounded-[3rem] blur-3xl"
                        ></div>

                        <div
                            class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-[3rem] p-6"
                        >

                            <div
                                class="aspect-square rounded-[2.5rem] bg-gradient-to-br from-white/20 to-white/5 flex items-center justify-center"
                            >
                                <div class="text-center">

                                    <div class="text-9xl">
                                        🛏️
                                    </div>

                                    <p class="mt-5 text-2xl font-bold text-white">
                                        Comfort Starts Here
                                    </p>

                                    <p class="mt-2 text-teal-100">
                                        Premium sleep essentials for your home
                                    </p>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

  
    {{-- Categories --}}
    <section id="categories" class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">

                <span class="text-sm font-semibold text-teal-600 uppercase tracking-wider">
                    Shop By Category
                </span>

                <h2 class="mt-2 text-3xl md:text-4xl font-bold text-gray-900">
                    Find What You Need
                </h2>

                <p class="mt-4 text-gray-500">
                    Explore our collection of quality sleep products.
                </p>

            </div>


            @if($categories->count())

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($categories as $category)

                      <x-category-card :category="$category" />

                    @endforeach

                </div>

            @else

                <div class="bg-white rounded-2xl border border-gray-100 py-16 px-6 text-center">

                    <div class="text-6xl">
                        🛍️
                    </div>

                    <h3 class="mt-5 text-xl font-bold text-gray-900">
                        Categories are coming soon
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Our product categories will appear here shortly.
                    </p>

                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex mt-6 px-6 py-3 bg-teal-600 text-white rounded-xl font-semibold hover:bg-teal-700 transition"
                    >
                        Browse Products
                    </a>

                </div>

            @endif

        </div>

    </section>

    {{-- Promotional Banner --}}
    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-cyan-600 to-teal-700"
            >

                <div class="absolute -right-20 -top-20 w-72 h-72 rounded-full bg-white/10"></div>
                <div class="absolute -left-20 -bottom-32 w-80 h-80 rounded-full bg-white/10"></div>

                <div
                    class="relative px-6 sm:px-10 lg:px-14 py-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8"
                >

                    <div class="text-white">

                        <span class="text-sm font-semibold uppercase tracking-wider text-cyan-100">
                            SleepMart Special
                        </span>

                        <h2 class="mt-2 text-2xl sm:text-3xl font-bold">
                            Upgrade Your Sleep Today
                        </h2>

                        <p class="mt-2 text-teal-100 max-w-xl">
                            Explore our mattress and pillow collection
                            and find the comfort that's right for you.
                        </p>

                    </div>

                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-white text-teal-700 rounded-xl font-bold hover:bg-gray-100 transition whitespace-nowrap"
                    >
                        Shop Collection →
                    </a>

                </div>

            </div>

        </div>
    </section>


      {{-- Featured Products --}}
      <section class="py-20 bg-gray-50">

          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

              <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-12">

                  <div>

                      <span class="text-sm font-semibold text-teal-600 uppercase tracking-wider">
                          Featured Products
                      </span>

                      <h2 class="mt-2 text-3xl md:text-4xl font-bold text-gray-900">
                          Popular Sleep Products
                      </h2>

                      <p class="mt-4 text-gray-500">
                          Discover some of our most popular products.
                      </p>

                  </div>

                  <a
                      href="{{ route('products.index') }}"
                      class="inline-flex items-center text-teal-600 font-semibold hover:text-teal-700"
                  >
                      View All Products →
                  </a>

              </div>


              @if($featuredProducts->count())

                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                      @foreach($featuredProducts as $product)

                          <x-product-card :product="$product" />

                      @endforeach

                  </div>

              @else

                  <div class="bg-white rounded-2xl border border-gray-100 py-16 px-6 text-center">

                      <div class="text-6xl">
                          🛏️
                      </div>

                      <h3 class="mt-5 text-xl font-bold text-gray-900">
                          Featured products coming soon
                      </h3>

                      <p class="mt-2 text-gray-500 max-w-md mx-auto">
                          We're preparing our featured sleep collection.
                          You can still browse all available products.
                      </p>

                      <a
                          href="{{ route('products.index') }}"
                          class="inline-flex mt-6 px-6 py-3 bg-teal-600 text-white rounded-xl font-semibold hover:bg-teal-700 transition"
                      >
                          Browse Products
                      </a>

                  </div>

              @endif

          </div>

      </section>

    {{-- Why SleepMart --}}
    <section class="py-20 bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">

                <span class="text-sm font-semibold text-teal-600 uppercase tracking-wider">
                    Why SleepMart
                </span>

                <h2 class="mt-2 text-3xl md:text-4xl font-bold text-gray-900">
                    Sleep With Confidence
                </h2>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl p-7 shadow-sm">
                    <div class="text-4xl mb-5">✨</div>

                    <h3 class="font-bold text-lg text-gray-900">
                        Quality Products
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-6">
                        Carefully selected sleep products made
                        for everyday comfort.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-7 shadow-sm">
                    <div class="text-4xl mb-5">🚚</div>

                    <h3 class="font-bold text-lg text-gray-900">
                        Bangladesh Delivery
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-6">
                        We deliver your order across Bangladesh.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-7 shadow-sm">
                    <div class="text-4xl mb-5">💵</div>

                    <h3 class="font-bold text-lg text-gray-900">
                        Cash on Delivery
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-6">
                        Pay conveniently when your order arrives.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-7 shadow-sm">
                    <div class="text-4xl mb-5">❤️</div>

                    <h3 class="font-bold text-lg text-gray-900">
                        Customer First
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-6">
                        We care about your comfort and satisfaction.
                    </p>
                </div>

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <!-- <section class="py-20">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="rounded-3xl bg-gradient-to-r from-teal-600 to-cyan-600 p-10 md:p-14 text-center text-white">

                <h2 class="text-3xl md:text-4xl font-bold">
                    Ready for Better Sleep?
                </h2>

                <p class="mt-4 text-teal-50 text-lg">
                    Explore our collection of mattresses and pillows.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex mt-8 px-7 py-3.5 bg-white text-teal-700 font-bold rounded-xl hover:bg-gray-100 transition"
                >
                    Start Shopping
                </a>

            </div>

        </div>

    </section> -->
    <!-- <section class="py-20 bg-white">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <div class="w-16 h-16 mx-auto rounded-2xl bg-teal-50 flex items-center justify-center text-3xl">
                💤
            </div>

            <h2 class="mt-6 text-3xl sm:text-4xl font-extrabold text-gray-900">
                Ready for Better Sleep?
            </h2>

            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                Explore our collection of mattresses and pillows
                and choose the comfort your body deserves.
            </p>

            <div class="mt-8">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg"
                >
                    Explore SleepMart
                    <span class="ml-2">→</span>
                </a>
            </div>

        </div>

    </section> -->

@endsection