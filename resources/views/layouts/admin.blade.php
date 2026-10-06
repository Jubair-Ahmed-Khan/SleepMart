<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'Admin | SleepMart')
    </title>

    <meta
        name="description"
        content="SleepMart Administration"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside
            class="hidden lg:flex lg:flex-col w-64 bg-gray-900 text-white"
        >
            <div class="px-6 py-6 border-b border-gray-800">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3"
                >
                    <div
                        class="w-11 h-11 rounded-xl
                               bg-gradient-to-br from-teal-500 to-cyan-600
                               flex items-center justify-center"
                    >
                        <span class="text-2xl">🛏️</span>
                    </div>

                    <div>
                        <div class="text-xl font-bold">
                            Sleep<span class="text-teal-400">Mart</span>
                        </div>

                        <div class="text-xs text-gray-400">
                            Administration
                        </div>
                    </div>
                </a>

            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                           {{ request()->routeIs('admin.dashboard')
                                ? 'bg-teal-600 text-white'
                                : 'text-gray-300 hover:bg-gray-800' }}"
                >
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                           {{ request()->routeIs('admin.products.*')
                                ? 'bg-teal-600 text-white'
                                : 'text-gray-300 hover:bg-gray-800' }}"
                >
                    <span>🛍️</span>
                    <span>Products</span>
                </a>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                           {{ request()->routeIs('admin.categories.*')
                                ? 'bg-teal-600 text-white'
                                : 'text-gray-300 hover:bg-gray-800' }}"
                >
                    <span>🗂️</span>
                    <span>Categories</span>
                </a>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                        {{ request()->routeIs('admin.orders.*')
                            ? 'bg-blue-600 text-white'
                            : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
                >
                    <span>
                        📦
                    </span>

                    <span>
                        Orders
                    </span>
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                           text-gray-300 hover:bg-gray-800"
                >
                    <span>🌐</span>
                    <span>View Store</span>
                </a>

            </nav>

            <div class="px-4 py-5 border-t border-gray-800">

                <div class="text-xs text-gray-500 mb-1">
                    Logged in as
                </div>

                <div class="text-sm font-semibold">
                    {{ auth()->user()->name }}
                </div>

                <div class="text-xs text-gray-400 truncate">
                    {{ auth()->user()->email }}
                </div>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="mt-4"
                >
                    @csrf

                    <button
                        type="submit"
                        class="w-full text-left px-4 py-2.5 rounded-lg
                               text-sm text-gray-300
                               hover:bg-gray-800 hover:text-white"
                    >
                        🚪 Logout
                    </button>
                </form>

            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 min-w-0">

            <!-- Topbar -->
            <header class="bg-white border-b border-gray-200">

                <div
                    class="px-4 sm:px-6 lg:px-8 h-16
                           flex items-center justify-between"
                >

                    <div>
                        <h1 class="text-lg font-bold text-gray-800">
                            @yield('page-title', 'Admin Dashboard')
                        </h1>
                    </div>

                    <div class="flex items-center gap-3">

                        <a
                            href="{{ route('products.index') }}"
                            class="hidden sm:inline-flex items-center
                                   px-4 py-2 rounded-lg
                                   text-sm font-medium
                                   text-gray-600
                                   hover:bg-gray-100"
                        >
                            View Store
                        </a>

                        <div
                            class="w-9 h-9 rounded-full
                                   bg-teal-100 text-teal-700
                                   flex items-center justify-center
                                   font-bold"
                        >
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>

                    </div>

                </div>

            </header>

            <!-- Content -->
            <main class="p-4 sm:p-6 lg:p-8">

                @if(session('success'))
                    <div
                        class="mb-6 rounded-xl bg-green-50
                               border border-green-200
                               px-4 py-3 text-sm text-green-700"
                    >
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-6 rounded-xl bg-red-50
                               border border-red-200
                               px-4 py-3 text-sm text-red-700"
                    >
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div
                        class="mb-6 rounded-xl bg-red-50
                               border border-red-200
                               px-4 py-3 text-sm text-red-700"
                    >
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>
    @stack('scripts')
</body>

</html>