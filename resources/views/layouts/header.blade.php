<header class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center text-white font-bold text-xl">
                    S
                </div>

                <div>
                    <div class="text-xl font-bold text-gray-900">
                        Sleep<span class="text-teal-600">Mart</span>
                    </div>

                    <div class="text-xs text-gray-500">
                        Better Sleep. Better Life.
                    </div>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <nav class="hidden md:flex items-center gap-8">
                <a
                    href="{{ route('home') }}"
                    class="text-sm font-medium text-gray-700 hover:text-teal-600 transition"
                >
                    Home
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="text-sm font-medium text-gray-700 hover:text-teal-600 transition"
                >
                    Shop
                </a>

                <a
                    href="{{ route('cart.index') }}"
                    class="text-sm font-medium text-gray-700 hover:text-teal-600 transition"
                >
                    Cart
                </a>

                @auth
                    @if(!auth()->user()->isAdmin())
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-sm font-medium text-gray-700 hover:text-teal-600 transition"
                        >
                            Dashboard
                        </a>
                        <a
                            href="{{ route('orders.index') }}"
                            class="text-sm font-medium text-gray-700
                                hover:text-teal-600 transition"
                        >
                            My Orders
                        </a>
                    @endif
                @endauth
                @auth
                    @if(auth()->user()->isAdmin())
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2 rounded-lg text-sm font-semibold
                                text-teal-600
                                hover:bg-teal-50 transition"
                        >
                            Admin
                        </a>
                    @endif
                @endauth
            </nav>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">

                {{-- Cart --}}
                <a
                    href="{{ route('cart.index') }}"
                    class="relative p-2 text-gray-600 hover:text-teal-600 transition"
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
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 5h14M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"
                        />
                    </svg>

                    @php
                        $cartCount = collect(session('cart', []))
                            ->sum('quantity');
                    @endphp

                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-teal-600 text-white text-xs font-bold rounded-full min-w-5 h-5 px-1 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Guest --}}
                @guest
                    <a
                        href="{{ route('login') }}"
                        class="hidden sm:inline-flex px-4 py-2 text-sm font-medium text-gray-700 hover:text-teal-600"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="hidden sm:inline-flex px-5 py-2.5 bg-teal-600 text-white rounded-lg text-sm font-semibold hover:bg-teal-700 transition"
                    >
                        Register
                    </a>
                @endguest

                {{-- Authenticated --}}
                @auth
                    <div class="hidden sm:flex items-center gap-3">

                        <!-- @if(auth()->user()->isAdmin())

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="px-4 py-2 rounded-lg text-sm font-semibold
                                    text-teal-600
                                    hover:bg-teal-50 transition"
                            >
                                ⚙️ Admin
                            </a>

                        @endif -->

                        <div class="text-right">
                            <div class="text-sm font-semibold text-gray-900">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="text-xs text-gray-500">
                                My Account
                            </div>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="text-sm text-red-600 hover:text-red-700 font-medium"
                            >
                                Logout
                            </button>
                        </form>

                    </div>
                @endauth

            </div>
        </div>
    </div>
</header>