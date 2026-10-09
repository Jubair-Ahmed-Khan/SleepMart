@extends('layouts.admin')

@section('title', 'Edit Coupon | SleepMart')
@section('page-title', 'Edit Coupon')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Coupon</h2>
        <p class="mt-1 text-sm text-gray-500">
            Update {{ $coupon->code }} and its discount rules.
        </p>
    </div>

    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
        <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
            @csrf
            @method('PUT')
            @include('admin.coupons._form')
        </form>
    </div>

</div>
@endsection
