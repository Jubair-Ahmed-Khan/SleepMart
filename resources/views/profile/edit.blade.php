@extends('layouts.app')

@section('title', 'My Profile | SleepMart')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            My Account
        </h1>

        <p class="mt-2 text-gray-500">
            Manage your profile, password and orders.
        </p>

    </div>


    {{-- Account Navigation --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- Sidebar --}}
        <aside>

            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div class="p-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-12 h-12 rounded-full
                                   bg-teal-100
                                   text-teal-700
                                   flex items-center justify-center
                                   font-bold text-lg"
                        >
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="font-semibold text-gray-900 truncate">
                                {{ $user->name }}
                            </p>

                            <p class="text-xs text-gray-500 truncate">
                                {{ $user->email }}
                            </p>

                        </div>

                    </div>

                </div>


                <nav class="p-3 space-y-1">

                    {{-- Dashboard --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3
                               px-4 py-3 rounded-xl
                               text-gray-700
                               hover:bg-teal-50
                               hover:text-teal-700
                               transition"
                    >
                        <span>🏠</span>
                        <span class="font-medium">
                            Dashboard
                        </span>
                    </a>


                    {{-- Profile --}}
                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3
                               px-4 py-3 rounded-xl
                               bg-teal-50 text-teal-700"
                    >
                        <span>👤</span>
                        <span class="font-semibold">
                            Profile
                        </span>
                    </a>


                    {{-- Orders --}}
                    <a
                        href="{{ route('orders.index') }}"
                        class="flex items-center gap-3
                               px-4 py-3 rounded-xl
                               text-gray-700
                               hover:bg-teal-50
                               hover:text-teal-700
                               transition"
                    >
                        <span>📦</span>
                        <span class="font-medium">
                            My Orders
                        </span>
                    </a>


                    {{-- Change Password --}}
                    <a
                        href="#change-password"
                        class="flex items-center gap-3
                               px-4 py-3 rounded-xl
                               text-gray-700
                               hover:bg-teal-50
                               hover:text-teal-700
                               transition"
                    >
                        <span>🔒</span>
                        <span class="font-medium">
                            Change Password
                        </span>
                    </a>


                    {{-- Logout --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full flex items-center gap-3
                                   px-4 py-3 rounded-xl
                                   text-red-600
                                   hover:bg-red-50
                                   transition text-left"
                        >
                            <span>🚪</span>

                            <span class="font-medium">
                                Logout
                            </span>
                        </button>

                    </form>

                </nav>

            </div>

        </aside>


        {{-- Main Content --}}
        <div class="lg:col-span-3 space-y-8">


            {{-- Success Message --}}
            @if(session('success'))

                <div
                    class="p-4 rounded-xl
                           bg-green-50
                           border border-green-200
                           text-green-700"
                >
                    {{ session('success') }}
                </div>

            @endif


            {{-- Profile Information --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm"
            >

                <div class="p-6 border-b border-gray-100">

                    <h2 class="text-xl font-bold text-gray-900">
                        Profile Information
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Update your name and email address.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('profile.update') }}"
                    class="p-6"
                >

                    @csrf
                    @method('PATCH')


                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="block text-sm font-semibold
                                   text-gray-700 mb-2"
                        >
                            Full Name
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                            required
                            autocomplete="name"
                            class="w-full px-4 py-3
                                   rounded-xl border
                                   border-gray-300
                                   focus:border-teal-500
                                   focus:ring-teal-500"
                        >

                        @error('name')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="mt-5">

                        <label
                            for="email"
                            class="block text-sm font-semibold
                                   text-gray-700 mb-2"
                        >
                            Email Address
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            autocomplete="email"
                            class="w-full px-4 py-3
                                   rounded-xl border
                                   border-gray-300
                                   focus:border-teal-500
                                   focus:ring-teal-500"
                        >

                        @error('email')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <div class="mt-6">

                        <button
                            type="submit"
                            class="px-6 py-3
                                   bg-teal-600
                                   text-white
                                   rounded-xl
                                   font-semibold
                                   hover:bg-teal-700
                                   transition"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>


            {{-- Change Password --}}
            <div
                id="change-password"
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm"
            >

                <div class="p-6 border-b border-gray-100">

                    <h2 class="text-xl font-bold text-gray-900">
                        Change Password
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Use a strong password with at least 8 characters.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('profile.password.update') }}"
                    class="p-6"
                >

                    @csrf
                    @method('PATCH')


                    {{-- Current Password --}}
                    <div>

                        <label
                            for="current_password"
                            class="block text-sm font-semibold
                                   text-gray-700 mb-2"
                        >
                            Current Password
                        </label>

                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="w-full px-4 py-3
                                   rounded-xl border
                                   border-gray-300
                                   focus:border-teal-500
                                   focus:ring-teal-500"
                        >

                        @error('current_password')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- New Password --}}
                    <div class="mt-5">

                        <label
                            for="password"
                            class="block text-sm font-semibold
                                   text-gray-700 mb-2"
                        >
                            New Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="w-full px-4 py-3
                                   rounded-xl border
                                   border-gray-300
                                   focus:border-teal-500
                                   focus:ring-teal-500"
                        >

                        @error('password')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div class="mt-5">

                        <label
                            for="password_confirmation"
                            class="block text-sm font-semibold
                                   text-gray-700 mb-2"
                        >
                            Confirm New Password
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="w-full px-4 py-3
                                   rounded-xl border
                                   border-gray-300
                                   focus:border-teal-500
                                   focus:ring-teal-500"
                        >

                    </div>


                    <div class="mt-6">

                        <button
                            type="submit"
                            class="px-6 py-3
                                   bg-teal-600
                                   text-white
                                   rounded-xl
                                   font-semibold
                                   hover:bg-teal-700
                                   transition"
                        >
                            Change Password
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection