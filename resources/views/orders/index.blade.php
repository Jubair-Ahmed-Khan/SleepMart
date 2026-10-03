@extends('layouts.app')

@section('title', 'My Orders | SleepMart')

@section('content')

<div class="bg-gray-50 py-10">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-900">
                My Orders
            </h1>

            <p class="mt-2 text-gray-600">
                View your SleepMart order history and order status.
            </p>

        </div>


        @if($orders->isEmpty())

            <div class="rounded-2xl bg-white
                        border border-gray-200
                        p-12 text-center">

                <div class="mx-auto flex h-16 w-16
                            items-center justify-center
                            rounded-full bg-gray-100">

                    <span class="text-2xl">
                        📦
                    </span>

                </div>

                <h2 class="mt-5 text-xl font-bold text-gray-900">
                    No orders yet
                </h2>

                <p class="mt-2 text-gray-500">
                    You haven't placed any orders yet.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="mt-6 inline-block rounded-xl
                           bg-teal-600 px-6 py-3
                           text-sm font-semibold text-white
                           hover:bg-teal-700 transition"
                >
                    Start Shopping
                </a>

            </div>

        @else

            <div class="space-y-4">

                @foreach($orders as $order)

                    <div class="rounded-2xl bg-white
                                border border-gray-200
                                p-5 sm:p-6">

                        <div class="flex flex-col gap-5
                                    lg:flex-row
                                    lg:items-center
                                    lg:justify-between">

                            <div>

                                <p class="text-xs font-medium
                                          uppercase tracking-wide
                                          text-gray-500">
                                    Order Number
                                </p>

                                <p class="mt-1 text-lg font-bold
                                          text-gray-900">
                                    {{ $order->order_number }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $order->created_at->format(
                                        'd M Y, h:i A'
                                    ) }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs text-gray-500">
                                    Items
                                </p>

                                <p class="mt-1 font-semibold
                                          text-gray-900">
                                    {{ $order->items_count }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs text-gray-500">
                                    Payment
                                </p>

                                <p class="mt-1 font-semibold
                                          text-gray-900">
                                    Cash on Delivery
                                </p>

                            </div>


                            <div>

                                <p class="text-xs text-gray-500">
                                    Status
                                </p>

                                <span
                                    class="mt-1 inline-flex
                                           rounded-full
                                           bg-amber-100
                                           px-3 py-1
                                           text-xs font-semibold
                                           text-amber-700"
                                >
                                    {{ ucfirst(
                                        $order->order_status
                                    ) }}
                                </span>

                            </div>


                            <div>

                                <p class="text-xs text-gray-500">
                                    Total
                                </p>

                                <p class="mt-1 text-lg font-bold
                                          text-teal-600">
                                    ৳{{ number_format(
                                        $order->total,
                                        2
                                    ) }}
                                </p>

                            </div>


                            <div>

                                <a
                                    href="{{
                                        route(
                                            'orders.show',
                                            $order
                                        )
                                    }}"
                                    class="inline-flex
                                           items-center
                                           rounded-xl
                                           border border-gray-300
                                           px-4 py-2
                                           text-sm font-semibold
                                           text-gray-700
                                           hover:bg-gray-50
                                           transition"
                                >
                                    View Details
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        @endif

    </div>

</div>

@endsection