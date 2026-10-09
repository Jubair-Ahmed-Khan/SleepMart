@extends('layouts.admin')

@section('title', 'Create Coupon | SleepMart')
@section('page-title', 'Create Coupon')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">Create Coupon</h2>
        <p class="mt-1 text-sm text-gray-500">
            Configure a promotional discount for your customers.
        </p>
    </div>

    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
        <form method="POST" action="{{ route('admin.coupons.store') }}">
            @csrf
            @include('admin.coupons._form')
        </form>
    </div>

</div>
@endsection
