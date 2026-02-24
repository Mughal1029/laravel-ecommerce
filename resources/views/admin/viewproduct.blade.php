@extends('admin.maindesign')

@section('view_product')
@if(session('product_delete'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('product_delete') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('product_updated'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('product_updated') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container mt-5">
    <div class="card shadow-sm">
    <div class="card-header bg-primary text-white text-center">
    <h4 class="mb-0">Products List</h4>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->product_title}}</td>
            <td>{{ \Illuminate\Support\Str::limit($product->product_description, 50) }}</td>
            <td>{{$product->product_quantity}}</td>
            <td>${{$product->product_price}}</td>
            <td>
                @if($product->product_image)
                <img src="{{ asset('products/'.$product->product_image) }}" 
                alt="{{$product->product_title}}" 
                class="img-fluid rounded" 
                style="max-width: 80px; height: auto;">
                @else
                <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>{{$product->product_category}}</td>
            <td>
                <a href="{{ url('productupdate/'.$product->id) }}" 
                class="btn btn-sm btn-success mb-1">Update</a>
                <a href="productdelete/{{$product->id}}" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
            </td>
        </tr>
        @endforeach
        <div>{{$products->links()}}</div>
    </tbody>
    </table>
    </div>
    </div>
    </div>
</div>


@endsection