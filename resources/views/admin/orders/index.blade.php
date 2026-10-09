@extends('layouts.admin')

@section('page-title', 'Orders')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Orders
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage customer orders and update their status.
            </p>
        </div>

    </div>


    <!-- {{-- Alerts --}}
    @if(session('success'))
        <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif -->


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3">

            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

        <form
            method="GET"
            action="{{ route('admin.orders.index') }}"
        >

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- Search --}}
                <div>

                    <label
                        for="search"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Search
                    </label>

                    <input
                        id="search"
                        name="search"
                        type="text"
                        value="{{ request('search') }}"
                        placeholder="Order number, customer or phone"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none"
                    >

                </div>


                {{-- Status --}}
                <div>

                    <label
                        for="status"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none"
                    >

                        <option value="">
                            All Orders
                        </option>

                        @foreach($statuses as $value => $label)

                            <option
                                value="{{ $value }}"
                                @selected(request('status') === $value)
                            >
                                {{ $label }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition"
                    >
                        Filter
                    </button>

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition"
                    >
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Status Quick Filters --}}
    <div class="flex flex-wrap gap-2">

        <a
            href="{{ route('admin.orders.index') }}"
            class="px-4 py-2 rounded-full text-sm font-medium
                {{ !request('status')
                    ? 'bg-gray-900 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
        >
            All
        </a>

        @foreach($statuses as $value => $label)

            <a
                href="{{ route('admin.orders.index', ['status' => $value]) }}"
                class="px-4 py-2 rounded-full text-sm font-medium
                    {{ request('status') === $value
                        ? 'bg-gray-900 text-white'
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
            >
                {{ $label }}
            </a>

        @endforeach

    </div>


    {{-- Orders Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Order
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Items
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Total
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Payment
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($orders as $order)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Order --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-gray-900">
                                    {{ $order->order_number }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </div>

                            </td>


                            {{-- Customer --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-medium text-gray-900">
                                    {{ $order->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $order->phone }}
                                </div>

                            </td>


                            {{-- Items --}}
                            <td class="px-6 py-5 text-center text-sm text-gray-700">

                                {{ $order->items->sum('quantity') }}

                                {{ $order->items->sum('quantity') === 1 ? 'item' : 'items' }}

                            </td>


                            {{-- Total --}}
                            <td class="px-6 py-5 text-center">

                                <span class="font-semibold text-gray-900">
                                    ৳{{ number_format($order->total, 2) }}
                                </span>

                            </td>


                            {{-- Payment --}}
                            <td class="px-6 py-5 text-center">

                                <div class="text-sm font-medium text-gray-900">
                                    {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ ucfirst($order->payment_status) }}
                                </div>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5 text-center">

                                @php
                                    $statusClasses = [
                                        'pending' =>
                                            'bg-yellow-100 text-yellow-700',

                                        'confirmed' =>
                                            'bg-blue-100 text-blue-700',

                                        'processing' =>
                                            'bg-indigo-100 text-indigo-700',

                                        'shipped' =>
                                            'bg-purple-100 text-purple-700',

                                        'delivered' =>
                                            'bg-green-100 text-green-700',

                                        'cancelled' =>
                                            'bg-red-100 text-red-700',
                                    ];
                                @endphp

                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $statusClasses[$order->order_status] ?? 'bg-gray-100 text-gray-700' }}"
                                >
                                    {{ $statuses[$order->order_status] ?? ucfirst($order->order_status) }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-1">

                                    {{-- View Order --}}
                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        title="View order"
                                        aria-label="View order"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                              rounded-lg
                                              text-blue-600 transition
                                              hover:text-gray-900"
                                    >
                                        {{-- Eye icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18"
                                            viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>

                                    {{-- Update Order Status --}}
                                    @if(!in_array($order->order_status, ['delivered', 'cancelled']))

                                        <button
                                            type="button"
                                            onclick="openStatusModal(
                                                {{ $order->id }},
                                                @js($order->order_number),
                                                @js($order->order_status)
                                            )"
                                            title="Update order status"
                                            aria-label="Update order status"
                                            class="inline-flex h-9 w-9 items-center justify-center
                                                  rounded-lg text-green-600
                                                  transition"
                                        >
                                            {{-- Pencil icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18"
                                                viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 20h9"/>
                                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                                            </svg>
                                        </button>

                                    @endif

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-gray-400 text-4xl mb-3">
                                    📦
                                </div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    No orders found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    There are no orders matching your filters.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($orders->hasPages())

            <div class="px-6 py-4 border-t border-gray-100">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>


{{-- Status Modal --}}
<div
    id="statusModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="statusModalTitle"
    role="dialog"
    aria-modal="true"
>

    {{-- Overlay --}}
    <div
        class="absolute inset-0 bg-black/50"
        onclick="closeStatusModal()"
    ></div>


    {{-- Modal --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <h3
                            id="statusModalTitle"
                            class="text-lg font-bold text-gray-900"
                        >
                            Update Order Status
                        </h3>

                        <p
                            id="statusModalOrder"
                            class="text-sm text-gray-500 mt-1"
                        ></p>

                    </div>

                    <button
                        type="button"
                        onclick="closeStatusModal()"
                        class="text-gray-400 hover:text-gray-600 text-2xl"
                    >
                        &times;
                    </button>

                </div>

            </div>


            {{-- Body --}}
            <form
                id="statusModalForm"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <div class="p-6">

                    <label
                        for="newStatus"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        New Status
                    </label>

                    <select
                        id="newStatus"
                        name="status"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none"
                    >

                        <option value="pending">
                            Pending
                        </option>

                        <option value="confirmed">
                            Confirmed
                        </option>

                        <option value="processing">
                            Processing
                        </option>

                        <option value="shipped">
                            Shipped
                        </option>

                        <option value="delivered">
                            Delivered
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>


                    <div
                        id="statusFlowMessage"
                        class="mt-4 rounded-lg bg-blue-50 border border-blue-100 px-4 py-3 text-sm text-blue-700"
                    >
                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeStatusModal()"
                        class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-white transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition"
                    >
                        Update Status
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@push('scripts')

<script>

    const statusTransitions = {
        pending: [
            'confirmed',
            'cancelled'
        ],

        confirmed: [
            'processing',
            'cancelled'
        ],

        processing: [
            'shipped',
            'cancelled'
        ],

        shipped: [
            'delivered',
            'cancelled'
        ],

        delivered: [],

        cancelled: []
    };


    const statusLabels = {
        pending: 'Pending',
        confirmed: 'Confirmed',
        processing: 'Processing',
        shipped: 'Shipped',
        delivered: 'Delivered',
        cancelled: 'Cancelled'
    };


    function openStatusModal(
        orderId,
        orderNumber,
        currentStatus
    ) {

        const modal =
            document.getElementById('statusModal');

        const form =
            document.getElementById('statusModalForm');

        const select =
            document.getElementById('newStatus');

        const orderText =
            document.getElementById('statusModalOrder');

        const flowMessage =
            document.getElementById('statusFlowMessage');


        form.action =
            "{{ url('/admin/orders') }}"
            + "/"
            + orderId
            + "/status";


        orderText.textContent =
            "Order #" + orderNumber;


        select.innerHTML = '';


        const allowedStatuses =
            statusTransitions[currentStatus] || [];


        allowedStatuses.forEach(function (status) {

            const option =
                document.createElement('option');

            option.value = status;

            option.textContent =
                statusLabels[status] || status;

            select.appendChild(option);

        });


        if (allowedStatuses.length === 0) {

            flowMessage.textContent =
                "This order cannot be changed because it is already in a final status.";

        } else {

            flowMessage.textContent =
                "Current status: "
                + (statusLabels[currentStatus] || currentStatus)
                + ". Select the next allowed status.";

        }


        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');
    }


    function closeStatusModal() {

        const modal =
            document.getElementById('statusModal');

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {
                closeStatusModal();
            }

        }
    );

</script>

@endpush

@endsection