@extends('main-design')
<base href="/public">

@section('product-details')

@if(session('cart_message'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('cart_message') }}
</div>
@endif

<div class="container">
    <div class="row align-items-center">

        <!-- Product Image -->
        <div class="col-md-6">
            <div class="img-box text-center">
                <img src="{{ asset('products/'.$product->product_image) }}"
                     alt="{{ $product->product_title }}"
                     class="img-fluid rounded"
                     style="max-height:400px;">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->product_title }}</h2>

            <h4 class="text-success mb-2">
                Price: Rs {{ $product->product_price }}
            </h4>

            <p class="mb-2">
                <strong>Category:</strong>
                {{ $product->product_category ?? 'General' }}
            </p>

            <p class="mb-2">
                <strong>Available Quantity:</strong>
                {{ $product->product_quantity }}
            </p>

            <hr>

            <p class="mb-4">
                {{ $product->product_description ?? 'No description available for this product.' }}
            </p>

   <div class="row mt-3 g-4">
       <div class="col-auto d-flex">
    <form action="addtocart/{{$product->id}}" method="POST" class="mr-2">
        @csrf
        <button type="submit" class="btn btn-outline-primary">
            🛒 Add to Cart
        </button>
    </form>
       <a href="/cartproducts" class="btn btn-primary">
            💳 Buy Now
        </a>
   </div>
        <div class="col-auto">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            ⬅ Back to Products
            </a>
        </div>
    </div>
</div>
</div>
</div>
@endsection
