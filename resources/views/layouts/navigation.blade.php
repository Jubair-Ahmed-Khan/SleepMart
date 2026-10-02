@auth
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">

    <!-- Main Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Left Side -->
            <div class="flex items-center">

                <!-- SleepMart Logo -->
                <div class="shrink-0 flex items-center">
                    <a
                        href="{{ route('home') }}"
                        class="flex items-center gap-2"
                    >
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-600
                                   flex items-center justify-center shadow-sm"
                        >
                            <span class="text-xl">🛏️</span>
                        </div>

                        <div class="hidden sm:block">
                            <div class="text-xl font-bold text-gray-800 leading-tight">
                                Sleep<span class="text-teal-600">Mart</span>
                            </div>

                            <div class="text-[10px] text-gray-400 tracking-wide">
                                Better Sleep. Better Life.
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex items-center ml-8 space-x-2">

                    <!-- Home -->
                    <a
                        href="{{ route('home') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('home')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
                    >
                        Home
                    </a>

                    <!-- Shop -->
                    <a
                        href="{{ route('products.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('products.*')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
                    >
                        Shop
                    </a>

                    <!-- Cart -->
                    <a
                        href="{{ route('cart.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('cart.*')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
                    >
                        Cart
                    </a>

                    <!-- Dashboard -->
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
                    >
                        Dashboard
                    </a>

                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex items-center gap-3">

                <!-- Cart Icon -->
                @php
                    $cartCount = collect(session('cart', []))->sum('quantity');
                @endphp

                <a
                    href="{{ route('cart.index') }}"
                    class="relative p-2.5 rounded-lg text-gray-500
                           hover:text-teal-600 hover:bg-teal-50 transition"
                    title="Shopping Cart"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h13m-2 4a1 1 0 100-2 1 1 0 000 2zm-8 0a1 1 0 100-2 1 1 0 000 2z"
                        />
                    </svg>

                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1
                                   rounded-full bg-teal-600 text-white text-[11px]
                                   font-bold flex items-center justify-center"
                        >
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="56">

                    <!-- Dropdown Trigger -->
                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg
                                   text-sm font-medium text-gray-600
                                   hover:text-teal-600 hover:bg-gray-50
                                   focus:outline-none transition"
                        >

                            <!-- Avatar -->
                            <div
                                class="w-9 h-9 rounded-full bg-teal-100
                                       text-teal-700 flex items-center justify-center
                                       font-semibold"
                            >
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <!-- User Name -->
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-semibold text-gray-700">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    My Account
                                </div>
                            </div>

                            <!-- Arrow -->
                            <svg
                                class="w-4 h-4 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                    </x-slot>

                    <!-- Dropdown Content -->
                    <x-slot name="content">

                        <!-- User Information -->
                        <div class="px-4 py-3 border-b border-gray-100">

                            <div class="font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="text-xs text-gray-500 truncate">
                                {{ Auth::user()->email }}
                            </div>

                        </div>

                        <!-- Dashboard -->
                        <x-dropdown-link :href="route('dashboard')">
                            <span class="flex items-center gap-2">
                                <span>📊</span>
                                <span>Dashboard</span>
                            </span>
                        </x-dropdown-link>

                        <!-- Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            <span class="flex items-center gap-2">
                                <span>👤</span>
                                <span>Profile</span>
                            </span>
                        </x-dropdown-link>

                        <!-- My Orders -->
                        {{-- Enable after order system is implemented --}}
                        {{--
                        <x-dropdown-link :href="route('orders.index')">
                            <span class="flex items-center gap-2">
                                <span>📦</span>
                                <span>My Orders</span>
                            </span>
                        </x-dropdown-link>
                        --}}

                        <div class="border-t border-gray-100 my-1"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                <span class="flex items-center gap-2 text-red-600">
                                    <span>🚪</span>
                                    <span>Log Out</span>
                                </span>
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile Controls -->
            <div class="flex items-center gap-2 sm:hidden">

                <!-- Mobile Cart -->
                <a
                    href="{{ route('cart.index') }}"
                    class="relative p-2 rounded-lg text-gray-600 hover:bg-gray-50"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h13m-2 4a1 1 0 100-2 1 1 0 000 2zm-8 0a1 1 0 100-2 1 1 0 000 2z"
                        />
                    </svg>

                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 min-w-[18px] h-[18px]
                                   rounded-full bg-teal-600 text-white text-[10px]
                                   font-bold flex items-center justify-center"
                        >
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- Hamburger -->
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center p-2
                           rounded-lg text-gray-500 hover:text-teal-600
                           hover:bg-gray-50 focus:outline-none transition"
                >
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>
    </div>

    <!-- Mobile Navigation -->
    <div
        :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden border-t border-gray-100 bg-white"
    >

        <div class="px-4 pt-3 pb-3 space-y-1">

            <!-- User Information -->
            <div
                class="flex items-center gap-3 px-3 py-3 mb-2
                       bg-gray-50 rounded-xl"
            >

                <div
                    class="w-10 h-10 rounded-full bg-teal-100
                           text-teal-700 flex items-center justify-center
                           font-semibold"
                >
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <div class="font-semibold text-gray-800 truncate">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-xs text-gray-500 truncate">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            </div>

            <!-- Home -->
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                       text-sm font-medium
                       {{ request()->routeIs('home')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
            >
                <span>🏠</span>
                <span>Home</span>
            </a>

            <!-- Shop -->
            <a
                href="{{ route('products.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                       text-sm font-medium
                       {{ request()->routeIs('products.*')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
            >
                <span>🛍️</span>
                <span>Shop</span>
            </a>

            <!-- Cart -->
            <a
                href="{{ route('cart.index') }}"
                class="flex items-center justify-between px-3 py-2.5
                       rounded-lg text-sm font-medium
                       {{ request()->routeIs('cart.*')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
            >
                <span class="flex items-center gap-3">
                    <span>🛒</span>
                    <span>Cart</span>
                </span>

                @if($cartCount > 0)
                    <span
                        class="bg-teal-600 text-white text-xs font-bold
                               min-w-[22px] h-[22px] rounded-full
                               flex items-center justify-center"
                    >
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <!-- Dashboard -->
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                       text-sm font-medium
                       {{ request()->routeIs('dashboard')
                            ? 'bg-teal-50 text-teal-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-teal-600' }}"
            >
                <span>📊</span>
                <span>Dashboard</span>
            </a>

            <!-- Profile -->
            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                       text-sm font-medium text-gray-600
                       hover:bg-gray-50 hover:text-teal-600"
            >
                <span>👤</span>
                <span>Profile</span>
            </a>

            <div class="border-t border-gray-100 my-2"></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3
                           px-3 py-2.5 rounded-lg text-sm font-medium
                           text-red-600 hover:bg-red-50 transition text-left"
                >
                    <span>🚪</span>
                    <span>Log Out</span>
                </button>
            </form>

        </div>

    </div>

</nav>
@endauth