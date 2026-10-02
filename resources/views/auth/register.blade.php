@extends('layouts.guest')

@section('title', 'Create Account')

@section('content')

<div>

    {{-- Header --}}

    <div class="mb-7">

        <div
            class="mb-4 flex h-12 w-12
                   items-center justify-center
                   rounded-2xl bg-teal-50
                   text-2xl"
        >
            ✨
        </div>

        <h2
            class="text-2xl font-extrabold
                   tracking-tight text-slate-900"
        >
            Create your account
        </h2>

        <p
            class="mt-2 text-sm
                   leading-6 text-slate-500"
        >
            Join SleepMart and make your next
            shopping experience easier.
        </p>

    </div>


    {{-- Errors --}}

    @if ($errors->any())

        <div
            class="mb-5 rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-3"
        >

            <ul
                class="list-inside list-disc
                       text-xs text-red-700"
            >

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}

    <form
        method="POST"
        action="{{ route('register') }}"
        class="space-y-5"
    >

        @csrf


        {{-- Name --}}

        <div>

            <label
                for="name"
                class="mb-2 block text-sm
                       font-semibold text-slate-700"
            >
                Full Name
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Your full name"
                class="w-full rounded-xl
                       border border-slate-300
                       bg-slate-50 px-4 py-3
                       text-sm outline-none
                       transition
                       placeholder:text-slate-400
                       focus:border-teal-600
                       focus:bg-white
                       focus:ring-4
                       focus:ring-teal-100"
            >

        </div>


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
                autocomplete="username"
                placeholder="you@example.com"
                class="w-full rounded-xl
                       border border-slate-300
                       bg-slate-50 px-4 py-3
                       text-sm outline-none
                       transition
                       placeholder:text-slate-400
                       focus:border-teal-600
                       focus:bg-white
                       focus:ring-4
                       focus:ring-teal-100"
            >

        </div>


        {{-- Password --}}

        <div>

            <label
                for="password"
                class="mb-2 block text-sm
                       font-semibold text-slate-700"
            >
                Password
            </label>

            <div class="relative">

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Create a password"
                    class="w-full rounded-xl
                           border border-slate-300
                           bg-slate-50 px-4 py-3
                           pr-12 text-sm outline-none
                           transition
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
                           top-1/2
                           -translate-y-1/2
                           text-sm text-slate-400
                           hover:text-slate-700"
                >
                    👁
                </button>

            </div>

        </div>


        {{-- Confirm Password --}}

        <div>

            <label
                for="password_confirmation"
                class="mb-2 block text-sm
                       font-semibold text-slate-700"
            >
                Confirm Password
            </label>

            <div class="relative">

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                    class="w-full rounded-xl
                           border border-slate-300
                           bg-slate-50 px-4 py-3
                           pr-12 text-sm outline-none
                           transition
                           placeholder:text-slate-400
                           focus:border-teal-600
                           focus:bg-white
                           focus:ring-4
                           focus:ring-teal-100"
                >

                <button
                    type="button"
                    onclick="togglePassword(
                        'password_confirmation',
                        this
                    )"
                    class="absolute right-3
                           top-1/2
                           -translate-y-1/2
                           text-sm text-slate-400
                           hover:text-slate-700"
                >
                    👁
                </button>

            </div>

        </div>


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
            Create Account
        </button>

    </form>


    {{-- Login link --}}

    <div
        class="mt-7 border-t border-slate-200
               pt-6 text-center"
    >

        <p class="text-sm text-slate-500">

            Already have an account?

            <a
                href="{{ route('login') }}"
                class="font-bold text-teal-700
                       hover:text-teal-800"
            >
                Sign in
            </a>

        </p>

    </div>

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