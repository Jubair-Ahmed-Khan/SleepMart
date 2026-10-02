@extends('layouts.guest')

@section('title', 'Verify Email')

@section('content')

<div>

    {{-- Header --}}

    <div class="mb-8 text-center">

        <div
            class="mx-auto mb-5 flex h-16 w-16
                   items-center justify-center
                   rounded-2xl bg-teal-50 text-3xl"
        >
            ✉️
        </div>

        <h2
            class="text-2xl font-extrabold tracking-tight
                   text-slate-900"
        >
            Verify your email
        </h2>

        <p
            class="mt-3 text-sm leading-6
                   text-slate-500"
        >
            Thanks for signing up with SleepMart!
            Please verify your email address by clicking
            the link we just sent you.
        </p>

    </div>


    {{-- Session Status --}}

    @if (session('status') === 'verification-link-sent')

        <div
            class="mb-6 rounded-xl border border-green-200
                   bg-green-50 px-4 py-3 text-center
                   text-sm text-green-700"
        >
            A new verification link has been sent
            to your email address.
        </div>

    @endif


    {{-- Verification Form --}}

    <form
        method="POST"
        action="{{ route('verification.send') }}"
        class="space-y-4"
    >

        @csrf

        <button
            type="submit"
            class="flex w-full items-center
                   justify-center rounded-xl
                   bg-teal-700 px-5 py-3.5
                   text-sm font-bold text-white
                   shadow-lg shadow-teal-700/20
                   transition hover:bg-teal-800
                   hover:shadow-xl
                   focus:outline-none
                   focus:ring-4
                   focus:ring-teal-200"
        >
            Resend Verification Email
        </button>

    </form>


    {{-- Logout --}}

    <div
        class="mt-6 border-t border-slate-200
               pt-6 text-center"
    >

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="text-sm font-semibold
                       text-slate-500
                       hover:text-red-600"
            >
                Sign Out
            </button>

        </form>

    </div>

</div>

@endsection