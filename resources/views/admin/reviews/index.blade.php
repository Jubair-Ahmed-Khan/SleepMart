@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Review Management
            </h1>
            <p class="mt-2 text-sm text-gray-600">
                Approve, reject, and manage customer product reviews.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Status summary --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
            <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}"
               class="rounded-xl border bg-white p-5 shadow-sm transition hover:shadow-md
               {{ $status === 'pending' ? 'border-yellow-400 ring-2 ring-yellow-100' : 'border-gray-200' }}">
                <p class="text-sm font-medium text-gray-500">Pending Reviews</p>
                <p class="mt-2 text-3xl font-bold text-yellow-600">
                    {{ $counts['pending'] }}
                </p>
            </a>

            <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}"
               class="rounded-xl border bg-white p-5 shadow-sm transition hover:shadow-md
               {{ $status === 'approved' ? 'border-green-400 ring-2 ring-green-100' : 'border-gray-200' }}">
                <p class="text-sm font-medium text-gray-500">Approved Reviews</p>
                <p class="mt-2 text-3xl font-bold text-green-600">
                    {{ $counts['approved'] }}
                </p>
            </a>

            <a href="{{ route('admin.reviews.index', ['status' => 'rejected']) }}"
               class="rounded-xl border bg-white p-5 shadow-sm transition hover:shadow-md
               {{ $status === 'rejected' ? 'border-red-400 ring-2 ring-red-100' : 'border-gray-200' }}">
                <p class="text-sm font-medium text-gray-500">Rejected Reviews</p>
                <p class="mt-2 text-3xl font-bold text-red-600">
                    {{ $counts['rejected'] }}
                </p>
            </a>
        </div>

        {{-- Review list --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-lg font-semibold text-gray-900">
                    {{ ucfirst($status) }} Reviews
                </h2>

                <span class="text-sm text-gray-500">
                    {{ $reviews->total() }} review(s)
                </span>
            </div>

            @forelse ($reviews as $review)
                <div class="border-b border-gray-100 p-6 last:border-b-0">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <h3 class="font-semibold text-gray-900">
                                    {{ $review->product?->name ?? 'Product unavailable' }}
                                </h3>

                                @if ($review->status === 'approved')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Approved
                                    </span>
                                @elseif ($review->status === 'rejected')
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Rejected
                                    </span>
                                @else
                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        Pending
                                    </span>
                                @endif
                            </div>

                            <p class="mt-2 text-sm text-gray-500">
                                By {{ $review->user?->name ?? 'Deleted user' }}
                                · Order #{{ $review->order_id }}
                                · {{ $review->created_at->format('d M Y, h:i A') }}
                            </p>

                            <div class="mt-3 flex items-center gap-1"
                                 aria-label="{{ $review->rating }} out of 5 stars">
                                @for ($star = 1; $star <= 5; $star++)
                                    <span class="{{ $star <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} text-xl">
                                        ★
                                    </span>
                                @endfor

                                <span class="ml-2 text-sm text-gray-600">
                                    {{ $review->rating }}/5
                                </span>
                            </div>

                            <p class="mt-3 whitespace-pre-line break-words text-sm leading-6 text-gray-700">{{ $review->comment }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2 lg:max-w-xs lg:justify-end">

                            @if ($review->status !== 'approved')
                                <form method="POST"
                                      action="{{ route('admin.reviews.approve', $review) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                                        Approve
                                    </button>
                                </form>
                            @endif

                            @if ($review->status !== 'rejected')
                                <form method="POST"
                                      action="{{ route('admin.reviews.reject', $review) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="rounded-lg bg-yellow-500 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-600">
                                        Reject
                                    </button>
                                </form>
                            @endif

                            <form method="POST"
                                  action="{{ route('admin.reviews.destroy', $review) }}"
                                  onsubmit="return confirm('Permanently delete this review? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <p class="text-lg font-medium text-gray-700">
                        No {{ $status }} reviews found.
                    </p>
                    <p class="mt-2 text-sm text-gray-500">
                        Reviews with this status will appear here.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $reviews->links() }}
        </div>

    </div>
</div>
@endsection