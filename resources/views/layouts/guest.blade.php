<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Account')
        - SleepMart
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="min-h-screen bg-slate-100">

    <div class="min-h-screen lg:grid lg:grid-cols-2">

        {{-- =====================================================
            LEFT BRANDING SECTION
        ====================================================== --}}

        <div
            class="relative hidden overflow-hidden
                   bg-gradient-to-br from-teal-800
                   via-teal-700 to-cyan-700
                   lg:flex"
        >

            {{-- Decorative circles --}}

            <div
                class="absolute -left-20 -top-20
                       h-72 w-72 rounded-full
                       bg-white/10"
            ></div>

            <div
                class="absolute -bottom-32 -right-20
                       h-96 w-96 rounded-full
                       bg-white/10"
            ></div>

            <div
                class="absolute right-20 top-24
                       h-20 w-20 rounded-full
                       bg-white/10"
            ></div>


            {{-- Content --}}

            <div
                class="relative z-10 flex w-full
                       flex-col justify-between
                       p-12 xl:p-16"
            >

                {{-- Logo --}}

                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center gap-3"
                >

                    <div
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-2xl bg-white
                               text-2xl shadow-lg"
                    >
                        🛏️
                    </div>

                    <div>

                        <div
                            class="text-2xl font-extrabold
                                   tracking-tight text-white"
                        >
                            SleepMart
                        </div>

                        <div
                            class="text-xs font-medium
                                   text-teal-100"
                        >
                            Better Sleep. Better Life.
                        </div>

                    </div>

                </a>


                {{-- Main message --}}

                <div class="max-w-lg">

                    <div
                        class="mb-6 inline-flex
                               items-center gap-2
                               rounded-full
                               bg-white/10 px-4 py-2
                               text-sm font-medium
                               text-white backdrop-blur"
                    >
                        <span>✨</span>
                        <span>Comfort delivered to your door</span>
                    </div>


                    <h1
                        class="text-4xl font-extrabold
                               leading-tight text-white
                               xl:text-5xl"
                    >
                        Sleep better.
                        <br>

                        <span class="text-teal-100">
                            Live better.
                        </span>
                    </h1>


                    <p
                        class="mt-6 max-w-md
                               text-base leading-7
                               text-teal-50"
                    >
                        Discover comfortable mattresses and
                        pillows designed to help you get the
                        restful sleep you deserve.
                    </p>


                    {{-- Features --}}

                    <div class="mt-8 space-y-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9
                                       items-center justify-center
                                       rounded-full bg-white/10"
                            >
                                ✓
                            </div>

                            <span class="text-sm text-white">
                                Quality sleep products
                            </span>

                        </div>


                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9
                                       items-center justify-center
                                       rounded-full bg-white/10"
                            >
                                ✓
                            </div>

                            <span class="text-sm text-white">
                                Cash on Delivery available
                            </span>

                        </div>


                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9
                                       items-center justify-center
                                       rounded-full bg-white/10"
                            >
                                ✓
                            </div>

                            <span class="text-sm text-white">
                                Delivery across Bangladesh
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Footer --}}

                <div
                    class="text-sm text-teal-100"
                >
                    © {{ date('Y') }} SleepMart.
                    All rights reserved.
                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT AUTH SECTION
        ====================================================== --}}

        <div
            class="flex min-h-screen
                   items-center justify-center
                   px-4 py-10 sm:px-6
                   lg:px-10"
        >

            <div class="w-full max-w-md">

                {{-- Mobile logo --}}

                <div
                    class="mb-8 flex justify-center
                           lg:hidden"
                >

                    <a
                        href="{{ route('home') }}"
                        class="flex items-center gap-3"
                    >

                        <div
                            class="flex h-11 w-11
                                   items-center justify-center
                                   rounded-xl bg-teal-700
                                   text-xl shadow"
                        >
                            🛏️
                        </div>

                        <div>

                            <div
                                class="text-xl font-extrabold
                                       text-slate-900"
                            >
                                SleepMart
                            </div>

                            <div
                                class="text-xs text-slate-500"
                            >
                                Better Sleep. Better Life.
                            </div>

                        </div>

                    </a>

                </div>


                {{-- Auth card --}}

                <div
                    class="rounded-3xl
                           bg-white p-6
                           shadow-xl shadow-slate-200/70
                           ring-1 ring-slate-200
                           sm:p-8"
                >

                    @yield('content')

                </div>


                {{-- Back to shop --}}

                <div class="mt-6 text-center">

                    <a
                        href="{{ route('products.index') }}"
                        class="text-sm font-medium
                               text-slate-500
                               transition
                               hover:text-teal-700"
                    >
                        ← Continue Shopping
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>