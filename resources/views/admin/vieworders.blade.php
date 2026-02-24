@extends('admin.maindesign')
@section('view_orders')

<div class="container mt-4">

    <h3 class="mb-4">📦 Customer Orders</h3>

    @if(session('order_message'))
        <div class="alert alert-success">
            {{ session('order_message') }}
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark text-center">
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
                <th>Action</th>
            </tr>
        </thead>

        <tbody class="text-center">
            @forelse($orders as $key => $order)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order->user->name}}</td>
                    <td>{{ $order->reciever_address}}</td>
                    <td>{{ $order->reciever_phone }}</td>
                    <td>{{ $order->product_title ?? 'Product Deleted' }}</td>
                    <td>{{ $order->product_price ?? '-' }}</td>
                    <td>
                        @if($order->product)
    <img src="{{ asset('products/'.$order->product_image)}}" class="rounded" style="width:60px; height:60px; object-fit:cover;">
    @else 
    <span>  NO Image</span>
    @endif
</td>
                    <td>
                        <form action="/changestatus/{{$order->id}}" method="post">
                            @csrf
                            <select name="status" id="">
                                <option value="{{$order->status}}">{{$order->status}}</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                            <input type="submit" value="submit" name="submit" onclick="return confirm('Are you sure?')">
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="/delete/{{$order->id}}" class="btn btn-sm btn-primary">Cancel</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-muted">
                        No orders found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
