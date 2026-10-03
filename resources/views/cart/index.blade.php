@extends('layouts.app')

@section('title', 'Shopping Cart - SleepMart')

@section('content')

<div class="bg-gray-50 py-10">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Shopping Cart
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                Review your selected mattresses and pillows.
            </p>
        </div>


        {{-- Flash Messages --}}
        @if(session('success'))
            <div
                class="mb-6 rounded-xl border border-green-200
                       bg-green-50 px-5 py-4 text-sm text-green-700"
            >
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div
                class="mb-6 rounded-xl border border-red-200
                       bg-red-50 px-5 py-4 text-sm text-red-700"
            >
                {{ session('error') }}
            </div>
        @endif


        @if(count($cart))

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- Cart Items --}}
                <div class="space-y-4 lg:col-span-2">

                    @foreach($cart as $cartKey => $item)

                        <div
                            class="rounded-2xl border border-gray-200
                                   bg-white p-5 shadow-sm"
                        >

                            <div
                                class="flex flex-col gap-5
                                       sm:flex-row"
                            >

                                {{-- Product Image --}}
                                <div
                                    class="h-32 w-32 shrink-0
                                           overflow-hidden rounded-xl
                                           bg-gray-100"
                                >
                                    @if($item['thumbnail'])
                                        <img
                                            src="{{ asset('storage/' . $item['thumbnail']) }}"
                                            alt="{{ $item['name'] }}"
                                            class="h-full w-full object-cover"
                                        >
                                    @else
                                        <div
                                            class="flex h-full items-center
                                                   justify-center text-xs
                                                   text-gray-400"
                                        >
                                            No Image
                                        </div>
                                    @endif
                                </div>


                                {{-- Product Info --}}
                                <div class="flex-1">

                                    <div
                                        class="flex items-start
                                               justify-between gap-4"
                                    >

                                        <div>

                                            <a
                                                href="{{ route(
                                                    'products.show',
                                                    $item['product_id']
                                                ) }}"
                                                class="text-lg font-bold
                                                       text-gray-900
                                                       hover:text-indigo-600"
                                            >
                                                {{ $item['name'] }}
                                            </a>

                                            @if($item['variant_name'])
                                                <p
                                                    class="mt-1 text-sm
                                                           text-gray-500"
                                                >
                                                    {{ $item['variant_name'] }}
                                                </p>
                                            @endif

                                            @if($item['size'])
                                                <p
                                                    class="text-sm
                                                           text-gray-500"
                                                >
                                                    Size:
                                                    {{ $item['size'] }}
                                                </p>
                                            @endif

                                            @if($item['thickness'])
                                                <p
                                                    class="text-sm
                                                           text-gray-500"
                                                >
                                                    Thickness:
                                                    {{ $item['thickness'] }}
                                                </p>
                                            @endif

                                        </div>


                                        {{-- Remove --}}
                                        <form
                                            action="{{ route(
                                                'cart.remove',
                                                $cartKey
                                            ) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-sm font-medium
                                                       text-red-500
                                                       hover:text-red-700"
                                            >
                                                Remove
                                            </button>
                                        </form>

                                    </div>


                                    <div
                                        class="mt-5 flex flex-wrap
                                               items-center
                                               justify-between gap-4"
                                    >

                                        {{-- Price --}}
                                        <div>
                                            <p
                                                class="text-lg font-bold
                                                       text-indigo-600"
                                            >
                                                ৳{{ number_format(
                                                    $item['price'],
                                                    0
                                                ) }}
                                            </p>

                                            <p
                                                class="text-xs
                                                       text-gray-500"
                                            >
                                                per item
                                            </p>
                                        </div>


                                        {{-- Quantity --}}
                                        <form
                                            action="{{ route(
                                                'cart.update',
                                                $cartKey
                                            ) }}"
                                            method="POST"
                                            class="flex items-center"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="button"
                                                onclick="changeCartQuantity(
                                                    this,
                                                    -1
                                                )"
                                                class="rounded-l-lg
                                                       border border-gray-300
                                                       px-3 py-2
                                                       text-gray-600
                                                       hover:bg-gray-100"
                                            >
                                                −
                                            </button>

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $item['quantity'] }}"
                                                min="1"
                                                max="{{ min(
                                                    20,
                                                    $item['stock']
                                                ) }}"
                                                class="w-16 border-y
                                                       border-gray-300
                                                       px-2 py-2
                                                       text-center
                                                       focus:ring-0"
                                            >

                                            <button
                                                type="button"
                                                onclick="changeCartQuantity(
                                                    this,
                                                    1
                                                )"
                                                class="border
                                                       border-gray-300
                                                       px-3 py-2
                                                       text-gray-600
                                                       hover:bg-gray-100"
                                            >
                                                +
                                            </button>

                                            <button
                                                type="submit"
                                                class="ml-3 rounded-lg
                                                       bg-gray-900
                                                       px-4 py-2
                                                       text-sm font-semibold
                                                       text-white
                                                       hover:bg-gray-800"
                                            >
                                                Update
                                            </button>
                                        </form>


                                        {{-- Item Total --}}
                                        <div class="text-right">

                                            <p
                                                class="text-xs
                                                       text-gray-500"
                                            >
                                                Total
                                            </p>

                                            <p
                                                class="text-lg font-bold
                                                       text-gray-900"
                                            >
                                                ৳{{ number_format(
                                                    $item['price']
                                                    * $item['quantity'],
                                                    0
                                                ) }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach


                    {{-- Clear Cart --}}
                    <div class="flex justify-end pt-2">

                        <button
                            type="button"
                            onclick="openClearCartModal()"
                            class="text-sm font-semibold
                                  text-red-600
                                  transition
                                  hover:text-red-700"
                        >
                            Clear Cart
                        </button>

                    </div>

                </div>


                {{-- Summary --}}
                <div>

                    <div
                        class="sticky top-24 rounded-2xl
                               border border-gray-200
                               bg-white p-6 shadow-sm"
                    >

                        <h2
                            class="text-xl font-bold text-gray-900"
                        >
                            Order Summary
                        </h2>


                        <div class="mt-6 space-y-4">

                            <div
                                class="flex justify-between
                                       text-sm text-gray-600"
                            >
                                <span>
                                    Subtotal
                                </span>

                                <span class="font-semibold text-gray-900">
                                    ৳{{ number_format(
                                        $subtotal,
                                        0
                                    ) }}
                                </span>
                            </div>


                            <div
                                class="flex justify-between
                                       text-sm text-gray-600"
                            >
                                <span>
                                    Delivery Charge
                                </span>

                                <span class="font-semibold text-gray-900">
                                    ৳{{ number_format(
                                        $deliveryCharge,
                                        0
                                    ) }}
                                </span>
                            </div>


                            <div
                                class="border-t border-gray-200
                                       pt-4"
                            >

                                <div
                                    class="flex items-center
                                           justify-between"
                                >

                                    <span
                                        class="text-base font-bold
                                               text-gray-900"
                                    >
                                        Grand Total
                                    </span>

                                    <span
                                        class="text-2xl font-bold
                                               text-indigo-600"
                                    >
                                        ৳{{ number_format(
                                            $grandTotal,
                                            0
                                        ) }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        <a
                            href="{{ route('checkout.index') }}"
                            class="mt-6 block w-full rounded-xl
                                   bg-indigo-600 px-6 py-4
                                   text-center text-sm font-bold
                                   text-white transition
                                   hover:bg-indigo-700"
                        >
                            Proceed to Checkout
                        </a>


                        <a
                            href="{{ route('products.index') }}"
                            class="mt-3 block w-full rounded-xl
                                   border border-gray-300
                                   px-6 py-3 text-center
                                   text-sm font-semibold
                                   text-gray-700
                                   hover:bg-gray-50"
                        >
                            Continue Shopping
                        </a>


                        <div
                            class="mt-6 rounded-xl bg-green-50
                                   p-4"
                        >
                            <p
                                class="text-sm font-semibold
                                       text-green-800"
                            >
                                Cash on Delivery Available
                            </p>

                            <p
                                class="mt-1 text-xs
                                       text-green-700"
                            >
                                Pay when your order is delivered
                                anywhere in Bangladesh.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        @else

            {{-- Empty Cart --}}
            <div
                class="rounded-2xl border border-gray-200
                       bg-white px-6 py-16 text-center
                       shadow-sm"
            >

                <div class="text-6xl">
                    🛒
                </div>

                <h2
                    class="mt-5 text-2xl font-bold
                           text-gray-900"
                >
                    Your cart is empty
                </h2>

                <p
                    class="mx-auto mt-2 max-w-md
                           text-sm text-gray-600"
                >
                    You haven't added any mattress or pillow
                    to your cart yet.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="mt-6 inline-flex rounded-xl
                           bg-indigo-600 px-6 py-3
                           text-sm font-bold text-white
                           hover:bg-indigo-700"
                >
                    Browse Products
                </a>

            </div>

        @endif

    </div>
    

</div>

{{-- ============================================================
    CLEAR CART CONFIRMATION MODAL
============================================================= --}}

<div
    id="clearCartModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="clearCartModalTitle"
    aria-modal="true"
    role="dialog"
>

    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="closeClearCartModal()"
    ></div>


    {{-- Modal Container --}}
    <div
        class="relative flex min-h-full items-center
               justify-center p-4"
    >

        <div
            class="w-full max-w-md
                   overflow-hidden rounded-2xl
                   bg-white shadow-2xl"
        >

            {{-- Icon --}}
            <div class="flex justify-center pt-7">

                <div
                    class="flex h-14 w-14 items-center
                           justify-center rounded-full
                           bg-red-100"
                >
                    <span class="text-2xl">
                        🗑️
                    </span>
                </div>

            </div>


            {{-- Content --}}
            <div class="px-6 pb-6 pt-5 text-center">

                <h2
                    id="clearCartModalTitle"
                    class="text-xl font-bold text-gray-900"
                >
                    Clear your cart?
                </h2>

                <p
                    class="mt-2 text-sm leading-6 text-gray-600"
                >
                    Are you sure you want to remove all items
                    from your cart?
                </p>

                <p
                    class="mt-1 text-xs text-gray-500"
                >
                    This action cannot be undone.
                </p>


                {{-- Buttons --}}
                <div
                    class="mt-6 flex flex-col-reverse
                           gap-3 sm:flex-row sm:justify-center"
                >

                    {{-- Cancel --}}
                    <button
                        type="button"
                        onclick="closeClearCartModal()"
                        class="w-full rounded-xl
                               border border-gray-300
                               px-5 py-3
                               text-sm font-semibold
                               text-gray-700
                               transition
                               hover:bg-gray-50
                               sm:w-auto"
                    >
                        Cancel
                    </button>


                    {{-- Confirm --}}
                    <form
                        action="{{ route('cart.clear') }}"
                        method="POST"
                        class="w-full sm:w-auto"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl
                                   bg-red-600
                                   px-5 py-3
                                   text-sm font-semibold
                                   text-white
                                   transition
                                   hover:bg-red-700
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-red-500
                                   focus:ring-offset-2
                                   sm:w-auto"
                        >
                            Yes, Clear Cart
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    function changeCartQuantity(button, change) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="quantity"]');

        const min = parseInt(input.min) || 1;
        const max = parseInt(input.max) || 20;

        let value = parseInt(input.value) || min;

        value += change;

        if (value < min) {
            value = min;
        }

        if (value > max) {
            value = max;
        }

        input.value = value;
    }
    function openClearCartModal() {
        const modal = document.getElementById('clearCartModal');

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');
    }


    function closeClearCartModal() {
        const modal = document.getElementById('clearCartModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | Close Modal With Escape Key
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            closeClearCartModal();
        }

    });
</script>

@endsection