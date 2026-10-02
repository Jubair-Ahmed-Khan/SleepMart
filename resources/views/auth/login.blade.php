@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<div>

    {{-- Header --}}

    <div class="mb-8">

        <div
            class="mb-4 flex h-12 w-12
                   items-center justify-center
                   rounded-2xl bg-teal-50
                   text-2xl"
        >
            👋
        </div>

        <h2
            class="text-2xl font-extrabold
                   tracking-tight text-slate-900"
        >
            Welcome back
        </h2>

        <p
            class="mt-2 text-sm
                   leading-6 text-slate-500"
        >
            Sign in to your SleepMart account
            and continue shopping.
        </p>

    </div>


    {{-- Session Status --}}

    @if (session('status'))

        <div
            class="mb-5 rounded-xl border
                   border-green-200 bg-green-50
                   px-4 py-3 text-sm
                   text-green-700"
        >
            {{ session('status') }}
        </div>

    @endif


    {{-- Validation Errors --}}

    @if ($errors->any())

        <div
            class="mb-5 rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-3"
        >

            <p
                class="text-sm font-semibold
                       text-red-800"
            >
                Please check the following:
            </p>

            <ul
                class="mt-2 list-inside
                       list-disc text-xs
                       text-red-700"
            >

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Login Form --}}

    <form
        method="POST"
        action="{{ route('login') }}"
        class="space-y-5"
    >

        @csrf


        {{-- Email --}}

        <div>

            <label
                for="email"
                class="mb-2 block text-sm
                       font-semibold text-slate-700"
            >
                Email Address
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="you@example.com"
                class="w-full rounded-xl
                       border border-slate-300
                       bg-slate-50 px-4 py-3
                       text-sm text-slate-900
                       outline-none transition
                       placeholder:text-slate-400
                       focus:border-teal-600
                       focus:bg-white
                       focus:ring-4
                       focus:ring-teal-100"
            >

        </div>


        {{-- Password --}}

        <div>

            <div
                class="mb-2 flex items-center
                       justify-between"
            >

                <label
                    for="password"
                    class="text-sm font-semibold
                           text-slate-700"
                >
                    Password
                </label>

                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="text-xs font-semibold
                               text-teal-700
                               hover:text-teal-800"
                    >
                        Forgot password?
                    </a>

                @endif

            </div>


            <div class="relative">

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                    class="w-full rounded-xl
                           border border-slate-300
                           bg-slate-50 px-4 py-3
                           pr-12 text-sm
                           text-slate-900
                           outline-none transition
                           placeholder:text-slate-400
                           focus:border-teal-600
                           focus:bg-white
                           focus:ring-4
                           focus:ring-teal-100"
                >

                <button
                    type="button"
                    onclick="togglePassword(
                        'password',
                        this
                    )"
                    class="absolute right-3
                           top-1/2 -translate-y-1/2
                           text-sm text-slate-400
                           hover:text-slate-700"
                >
                    👁
                </button>

            </div>

        </div>


        {{-- Remember --}}

        <label
            class="flex cursor-pointer
                   items-center gap-3"
        >

            <input
                type="checkbox"
                name="remember"
                class="h-4 w-4 rounded
                       border-slate-300
                       text-teal-700
                       focus:ring-teal-500"
            >

            <span
                class="text-sm text-slate-600"
            >
                Remember me
            </span>

        </label>


        {{-- Submit --}}

        <button
            type="submit"
            class="flex w-full items-center
                   justify-center rounded-xl
                   bg-teal-700 px-5 py-3.5
                   text-sm font-bold text-white
                   shadow-lg shadow-teal-700/20
                   transition
                   hover:bg-teal-800
                   hover:shadow-xl
                   focus:outline-none
                   focus:ring-4
                   focus:ring-teal-200"
        >
            Sign In
        </button>

    </form>


    {{-- Register --}}

    @if (Route::has('register'))

        <div
            class="mt-7 border-t border-slate-200
                   pt-6 text-center"
        >

            <p class="text-sm text-slate-500">

                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="font-bold text-teal-700
                           hover:text-teal-800"
                >
                    Create an account
                </a>

            </p>

        </div>

    @endif

</div>


<script>
    function togglePassword(inputId, button) {

        const input = document.getElementById(inputId);

        if (input.type === 'password') {

            input.type = 'text';

            button.innerText = '🙈';

        } else {

            input.type = 'password';

            button.innerText = '👁';

        }

    }
</script>

@endsection