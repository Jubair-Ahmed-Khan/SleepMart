<header class="sticky top-0 z-50 border-b border-slate-200 bg-white">

    {{-- Top Information Bar --}}
    <div class="hidden bg-teal-800 text-white md:block">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 text-sm">

            <p>
                🚚 Nationwide Delivery Across Bangladesh
            </p>

            <p>
                ☎ Customer Care: 01700-000000
            </p>

        </div>
    </div>


    {{-- Main Navbar --}}
    <div class="mx-auto max-w-7xl px-4">

        <div class="flex h-16 items-center justify-between">

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-2"
            >
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-700 text-xl text-white"
                >
                    🛏️
                </div>

                <div>
                    <div class="text-xl font-bold tracking-tight text-teal-800">
                        SleepMart
                    </div>

                    <div class="hidden text-[10px] text-slate-500 sm:block">
                        Better Sleep. Better Life.
                    </div>
                </div>
            </a>


            {{-- Desktop Navigation --}}
            <nav class="hidden items-center gap-7 md:flex">

                <a
                    href="{{ route('home') }}"
                    class="text-sm font-medium text-slate-700 transition hover:text-teal-700"
                >
                    Home
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="text-sm font-medium text-slate-700 transition hover:text-teal-700"
                >
                    Shop
                </a>

                <a
                    href="#"
                    class="text-sm font-medium text-slate-700 transition hover:text-teal-700"
                >
                    Mattresses
                </a>

                <a
                    href="#"
                    class="text-sm font-medium text-slate-700 transition hover:text-teal-700"
                >
                    Pillows
                </a>

            </nav>


            {{-- Right Side --}}
            <div class="flex items-center gap-2">

                {{-- Search --}}
                <button
                    type="button"
                    class="hidden h-10 w-10 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100 hover:text-teal-700 sm:flex"
                    title="Search"
                >
                    🔍
                </button>


                {{-- Wishlist --}}
                <button
                    type="button"
                    class="hidden h-10 w-10 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100 hover:text-teal-700 sm:flex"
                    title="Wishlist"
                >
                    ♡
                </button>


                {{-- Cart --}}
                @php
                    $cartCount = collect(
                        session('cart', [])
                    )->sum('quantity');
                @endphp
                <a
                    href="{{ route('cart.index') }}"
                    class="relative flex h-10 w-10 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100 hover:text-teal-700"
                    title="Cart"
                >
                    🛒
                    @if($cartCount > 0)
                      <span
                          class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-amber-500 text-[10px] font-bold text-white"
                      >
                          {{ $cartCount }}
                      </span>
                    @else
                      <span
                          class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-amber-500 text-[10px] font-bold text-white"
                      >
                          0
                      </span>
                    @endif
                </a>


                {{-- Login --}}
                <a
                    href="#"
                    class="hidden rounded-xl bg-teal-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-800 sm:block"
                >
                    Login
                </a>


                {{-- Mobile Menu --}}
                <button
                    type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-xl md:hidden"
                >
                    ☰
                </button>

            </div>

        </div>

    </div>

</header>