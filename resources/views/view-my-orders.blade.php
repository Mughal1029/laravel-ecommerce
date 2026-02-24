<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   <!-- Include Bootstrap CSS in your layout head if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="mb-4">
        <h3 class="mb-3 text-primary">📦 My Orders</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Product Image</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>PDF</th> 
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $key => $order)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->reciever_address }}</td>
                        <td>{{ $order->reciever_phone }}</td>
                        <td>{{ $order->product->product_title }}</td>
                        <td>${{ number_format($order->product->product_price, 2) }}</td>
                        <td>
                            <img src="{{ asset('products/'.$order->product->product_image) }}" 
                                 class="img-thumbnail" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                            @elseif($order->status == 'canceled')
                                <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/downloadpdf/{{$order->id}}" class="btn btn-sm btn-primary">Download</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-muted">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
        <div class="col-auto" style="justify-center ml-4">
            <a href="{{ url('/') }}" class="btn btn-outline-primary">
            ⬅ Back to Products
            </a>
        </div>

<!-- Optional Bootstrap JS for responsive features -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
