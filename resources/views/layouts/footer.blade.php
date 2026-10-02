<footer class="bg-gray-900 text-gray-300 mt-20">

    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-5">

                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center text-white font-bold text-xl">
                        S
                    </div>

                    <div>
                        <div class="text-xl font-bold text-white">
                            Sleep<span class="text-teal-400">Mart</span>
                        </div>

                        <div class="text-xs text-gray-400">
                            Better Sleep. Better Life.
                        </div>
                    </div>

                </div>

                <p class="text-sm leading-6 text-gray-400">
                    Quality mattresses and pillows designed to help
                    you sleep better and wake up refreshed.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-white font-semibold mb-5">
                    Quick Links
                </h3>

                <ul class="space-y-3 text-sm">
                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="hover:text-teal-400 transition"
                        >
                            Home
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('products.index') }}"
                            class="hover:text-teal-400 transition"
                        >
                            Shop
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('cart.index') }}"
                            class="hover:text-teal-400 transition"
                        >
                            Shopping Cart
                        </a>
                    </li>

                    @guest
                        <li>
                            <a
                                href="{{ route('login') }}"
                                class="hover:text-teal-400 transition"
                            >
                                Login
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('register') }}"
                                class="hover:text-teal-400 transition"
                            >
                                Register
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>

            {{-- Customer Service --}}
            <div>
                <h3 class="text-white font-semibold mb-5">
                    Customer Service
                </h3>

                <ul class="space-y-3 text-sm text-gray-400">
                    <li>Delivery across Bangladesh</li>
                    <li>Cash on Delivery</li>
                    <li>Easy Order Process</li>
                    <li>Quality Products</li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="text-white font-semibold mb-5">
                    Contact Us
                </h3>

                <ul class="space-y-4 text-sm text-gray-400">

                    <li class="flex gap-3">
                        <span>📞</span>
                        <span>+880 1XXX-XXXXXX</span>
                    </li>

                    <li class="flex gap-3">
                        <span>✉️</span>
                        <span>support@sleepmart.com</span>
                    </li>

                    <li class="flex gap-3">
                        <span>📍</span>
                        <span>Dhaka, Bangladesh</span>
                    </li>

                </ul>
            </div>

        </div>
    </div>

    {{-- Bottom Footer --}}
    <div class="border-t border-gray-800">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-3">

                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} SleepMart. All rights reserved.
                </p>

                <div class="flex items-center gap-5 text-sm text-gray-500">
                    <span>Secure Shopping</span>
                    <span>•</span>
                    <span>Cash on Delivery</span>
                    <span>•</span>
                    <span>Bangladesh</span>
                </div>

            </div>

        </div>

    </div>

</footer>