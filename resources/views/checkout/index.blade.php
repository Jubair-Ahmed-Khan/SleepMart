@extends('layouts.app')

@section('title', 'Checkout | SleepMart')

@section('content')

<div class="bg-gray-50 py-10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Checkout
            </h1>

            <p class="mt-2 text-gray-600">
                Complete your information to place your order.
            </p>
        </div>

        {{-- Checkout Steps --}}
        <div class="mb-8 overflow-hidden rounded-2xl bg-white
                    border border-gray-200">

            <div class="grid grid-cols-1 md:grid-cols-4">

                <div class="flex items-center gap-3
                            border-b md:border-b-0 md:border-r
                            border-gray-200 p-4">

                    <div class="flex h-9 w-9 items-center justify-center
                                rounded-full bg-teal-600
                                text-sm font-bold text-white">
                        1
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Step 1
                        </p>

                        <p class="font-semibold text-gray-900">
                            Information
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3
                            border-b md:border-b-0 md:border-r
                            border-gray-200 p-4">

                    <div class="flex h-9 w-9 items-center justify-center
                                rounded-full bg-teal-600
                                text-sm font-bold text-white">
                        2
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Step 2
                        </p>

                        <p class="font-semibold text-gray-900">
                            Delivery
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3
                            border-b md:border-b-0 md:border-r
                            border-gray-200 p-4">

                    <div class="flex h-9 w-9 items-center justify-center
                                rounded-full bg-teal-600
                                text-sm font-bold text-white">
                        3
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Step 3
                        </p>

                        <p class="font-semibold text-gray-900">
                            Payment
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-4">

                    <div class="flex h-9 w-9 items-center justify-center
                                rounded-full bg-gray-200
                                text-sm font-bold text-gray-600">
                        4
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Step 4
                        </p>

                        <p class="font-semibold text-gray-900">
                            Confirmation
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <form
            method="POST"
            action="{{ route('checkout.store') }}"
        >
            @csrf

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- LEFT --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Customer Information --}}
                    <div class="rounded-2xl bg-white
                                border border-gray-200 p-6">

                        <h2 class="text-xl font-bold text-gray-900">
                            Customer Information
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Please provide your contact information.
                        </p>

                        <div class="mt-6 grid grid-cols-1
                                    gap-5 md:grid-cols-2">

                            {{-- Name --}}
                            <div>
                                <label
                                    for="name"
                                    class="block text-sm font-medium
                                           text-gray-700"
                                >
                                    Full Name
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old(
                                        'name',
                                        auth()->user()->name
                                    ) }}"
                                    required
                                    class="mt-2 block w-full rounded-xl
                                           border-gray-300
                                           focus:border-teal-500
                                           focus:ring-teal-500"
                                    placeholder="Enter your full name"
                                >

                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label
                                    for="phone"
                                    class="block text-sm font-medium
                                           text-gray-700"
                                >
                                    Phone Number
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone') }}"
                                    required
                                    maxlength="11"
                                    class="mt-2 block w-full rounded-xl
                                           border-gray-300
                                           focus:border-teal-500
                                           focus:ring-teal-500"
                                    placeholder="01712345678"
                                >

                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="md:col-span-2">
                                <label
                                    for="email"
                                    class="block text-sm font-medium
                                           text-gray-700"
                                >
                                    Email Address
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old(
                                        'email',
                                        auth()->user()->email
                                    ) }}"
                                    class="mt-2 block w-full rounded-xl
                                           border-gray-300
                                           focus:border-teal-500
                                           focus:ring-teal-500"
                                    placeholder="you@example.com"
                                >

                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </div>


                    {{-- Delivery Address --}}
                    <div class="rounded-2xl bg-white
                                border border-gray-200 p-6">

                        <h2 class="text-xl font-bold text-gray-900">
                            Delivery Address
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Where should we deliver your order?
                        </p>

                        <div class="mt-6 grid grid-cols-1
                                    gap-5 md:grid-cols-2">

                            {{-- Division --}}
                            <div>
                                <label
                                    for="division_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Division
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="division_id"
                                    name="division_id"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300
                                          focus:border-teal-500 focus:ring-teal-500"
                                >
                                    <option value="">
                                        Select Division
                                    </option>
                                </select>

                                @error('division_id')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- District --}}
                            <div>
                                <label
                                    for="district_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    District
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="district_id"
                                    name="district_id"
                                    required
                                    disabled
                                    class="mt-2 block w-full rounded-xl border-gray-300
                                          disabled:bg-gray-100
                                          focus:border-teal-500 focus:ring-teal-500"
                                >
                                    <option value="">
                                        Select District
                                    </option>
                                </select>

                                @error('district_id')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Upazila --}}
                            <div>
                                <label
                                    for="upazila_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Upazila / Thana
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="upazila_id"
                                    name="upazila_id"
                                    required
                                    disabled
                                    class="mt-2 block w-full rounded-xl border-gray-300
                                          disabled:bg-gray-100
                                          focus:border-teal-500 focus:ring-teal-500"
                                >
                                    <option value="">
                                        Select Upazila
                                    </option>
                                </select>

                                @error('upazila_id')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="md:col-span-2">
                                <label
                                    for="address"
                                    class="block text-sm font-medium
                                           text-gray-700"
                                >
                                    Full Address
                                    <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    required
                                    class="mt-2 block w-full rounded-xl
                                           border-gray-300
                                           focus:border-teal-500
                                           focus:ring-teal-500"
                                    placeholder="House/Road, Area, Landmark..."
                                >{{ old('address') }}</textarea>

                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Delivery Note --}}
                            <div class="md:col-span-2">
                                <label
                                    for="delivery_note"
                                    class="block text-sm font-medium
                                           text-gray-700"
                                >
                                    Delivery Note
                                    <span class="text-gray-400">
                                        (Optional)
                                    </span>
                                </label>

                                <textarea
                                    id="delivery_note"
                                    name="delivery_note"
                                    rows="3"
                                    class="mt-2 block w-full rounded-xl
                                           border-gray-300
                                           focus:border-teal-500
                                           focus:ring-teal-500"
                                    placeholder="Any special instructions for delivery?"
                                >{{ old('delivery_note') }}</textarea>

                                @error('delivery_note')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </div>


                    {{-- Payment --}}
                    <div class="rounded-2xl bg-white
                                border border-gray-200 p-6">

                        <h2 class="text-xl font-bold text-gray-900">
                            Payment Method
                        </h2>

                        <div class="mt-5">

                            <label
                                class="flex cursor-pointer items-start
                                       gap-4 rounded-xl border-2
                                       border-teal-500 bg-teal-50 p-5"
                            >

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cod"
                                    checked
                                    class="mt-1 h-5 w-5
                                           text-teal-600
                                           focus:ring-teal-500"
                                >

                                <div>

                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-lg font-semibold
                                                   text-gray-900"
                                        >
                                            Cash on Delivery
                                        </span>

                                        <span
                                            class="rounded-full
                                                   bg-teal-100
                                                   px-2 py-1
                                                   text-xs font-semibold
                                                   text-teal-700"
                                        >
                                            COD
                                        </span>
                                    </div>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Pay when your SleepMart order
                                        is delivered to you.
                                    </p>

                                </div>

                            </label>

                        </div>
                    </div>

                </div>


                {{-- RIGHT --}}
                <div class="lg:col-span-1">

                    <div class="sticky top-6 rounded-2xl bg-white
                                border border-gray-200 p-6">

                        <h2 class="text-xl font-bold text-gray-900">
                            Order Summary
                        </h2>

                        <div class="mt-6 space-y-4">

                            @foreach($cart as $item)

                                <div class="flex gap-4">

                                    <div
                                        class="h-16 w-16 flex-shrink-0
                                               overflow-hidden rounded-xl
                                               bg-gray-100"
                                    >
                                        <!-- @if(!empty($item['image']))
                                            <img
                                                src="{{ $item['image'] }}"
                                                alt="{{ $item['name'] }}"
                                                class="h-full w-full
                                                       object-cover"
                                            >
                                        @endif -->
                                        @if(!empty($item['thumbnail']))
                                            <img
                                                src="{{ $item['thumbnail'] }}"
                                                alt="{{ $item['name'] }}"
                                                class="h-full w-full object-cover"
                                            >
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <p
                                            class="text-sm font-semibold
                                                   text-gray-900"
                                        >
                                            {{ $item['name'] }}
                                        </p>

                                        @if(!empty($item['variant_name']))
                                            <p class="mt-1 text-xs
                                                      text-gray-500">
                                                {{ $item['variant_name'] }}
                                            </p>
                                        @endif

                                        <p class="mt-1 text-xs text-gray-500">
                                            Qty: {{ $item['quantity'] }}
                                        </p>

                                    </div>

                                    <div class="text-right">
                                        <p class="text-sm font-semibold
                                                  text-gray-900">
                                            ৳{{ number_format(
                                                $item['price']
                                                * $item['quantity'],
                                                2
                                            ) }}
                                        </p>
                                    </div>

                                </div>

                            @endforeach

                        </div>

                        <div class="my-6 border-t border-gray-200"></div>

                        <div class="space-y-3">

                            <div class="flex justify-between">
                                <span class="text-gray-600">
                                    Subtotal
                                </span>

                                <span class="font-medium">
                                    ৳{{ number_format(
                                        $subtotal,
                                        2
                                    ) }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">
                                    Delivery Charge
                                </span>

                                <span class="font-medium">
                                    ৳{{ number_format(
                                        $shippingCharge,
                                        2
                                    ) }}
                                </span>
                            </div>

                        </div>

                        <div class="my-5 border-t border-gray-200"></div>

                        <div class="flex items-center justify-between">

                            <span class="text-lg font-bold text-gray-900">
                                Total
                            </span>

                            <span class="text-2xl font-bold text-teal-600">
                                ৳{{ number_format(
                                    $total,
                                    2
                                ) }}
                            </span>

                        </div>

                        <button
                            type="submit"
                            class="mt-6 w-full rounded-xl
                                   bg-teal-600 px-6 py-4
                                   text-sm font-bold text-white
                                   shadow-sm
                                   hover:bg-teal-700
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-teal-500
                                   focus:ring-offset-2
                                   transition"
                        >
                            Place Order
                        </button>

                        <p class="mt-4 text-center text-xs text-gray-500">
                            By placing this order, you agree to
                            SleepMart's terms and delivery policy.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>
  document.addEventListener('DOMContentLoaded', function () {

      const divisionSelect =
          document.getElementById('division_id');

      const districtSelect =
          document.getElementById('district_id');

      const upazilaSelect =
          document.getElementById('upazila_id');


      function resetSelect(
          select,
          placeholder
      ) {
          select.innerHTML =
              `<option value="">${placeholder}</option>`;

          select.disabled = true;
      }


      function addOptions(
          select,
          items,
          placeholder
      ) {
          select.innerHTML =
              `<option value="">${placeholder}</option>`;

          items.forEach(function (item) {

              const option =
                  document.createElement('option');

              option.value = item.id;

              option.textContent =
                  item.name;

              select.appendChild(option);
          });

          select.disabled = false;
      }


      async function loadDivisions() {

          try {

              const response = await fetch(
                  '{{ route('locations.divisions') }}'
              );

              if (!response.ok) {
                  throw new Error(
                      'Unable to load divisions.'
                  );
              }

              const divisions =
                  await response.json();

              addOptions(
                  divisionSelect,
                  divisions,
                  'Select Division'
              );

          } catch (error) {

              console.error(error);

              resetSelect(
                  divisionSelect,
                  'Unable to load divisions'
              );
          }
      }


      divisionSelect.addEventListener(
          'change',
          async function () {

              const divisionId =
                  this.value;

              resetSelect(
                  districtSelect,
                  'Select District'
              );

              resetSelect(
                  upazilaSelect,
                  'Select Upazila'
              );

              if (!divisionId) {
                  return;
              }

              try {

                  const url =
                      `/locations/divisions/${divisionId}/districts`;

                  const response =
                      await fetch(url);

                  if (!response.ok) {
                      throw new Error(
                          'Unable to load districts.'
                      );
                  }

                  const districts =
                      await response.json();

                  addOptions(
                      districtSelect,
                      districts,
                      'Select District'
                  );

              } catch (error) {

                  console.error(error);

                  resetSelect(
                      districtSelect,
                      'Unable to load districts'
                  );
              }
          }
      );


      districtSelect.addEventListener(
          'change',
          async function () {

              const districtId =
                  this.value;

              resetSelect(
                  upazilaSelect,
                  'Select Upazila'
              );

              if (!districtId) {
                  return;
              }

              try {

                  const url =
                      `/locations/districts/${districtId}/upazilas`;

                  const response =
                      await fetch(url);

                  if (!response.ok) {
                      throw new Error(
                          'Unable to load upazilas.'
                      );
                  }

                  const upazilas =
                      await response.json();

                  addOptions(
                      upazilaSelect,
                      upazilas,
                      'Select Upazila'
                  );

              } catch (error) {

                  console.error(error);

                  resetSelect(
                      upazilaSelect,
                      'Unable to load upazilas'
                  );
              }
          }
      );


      loadDivisions();

  });
</script>

@endpush