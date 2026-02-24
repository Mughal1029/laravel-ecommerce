@include('header')

@if(session('remove_cart_product'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{session('remove_cart_product')}}
</div>
@endif


@if($cart->isNotEmpty())
<table class="table table-striped table-bordered table-hover align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @php
        $price = 0;
        @endphp
        @foreach($cart as $cart_product)
        <tr>
            <td>{{$cart_product->product->product_title}}</td>
            <td>{{$cart_product->product->product_price}}</td>
            <td>
                @if($cart_product->product->product_image)
                <img src="{{ asset('products/'.$cart_product->product->product_image) }}" 
                alt="{{$cart_product->product->product_title}}" 
                class="img-fluid rounded" 
                style="max-width: 80px; height: auto;">
                @else
                <span class="text-muted">No Image</span>
                @endif

            </td>
             <td>
                 <a href="{{ url('productupdate/'.$cart_product->id) }}" 
                class="btn btn-sm btn-success mb-1">Update</a>
                <a href="removecartproduct/{{$cart_product->id}}" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to remove this product?')">Remove</a>
            </td>
        </tr>
        @php
        $price = $price+$cart_product->product->product_price;
        @endphp
        @endforeach
        <tr style="color: white; background-color: gray;">
            <td>Total Price</td>
            <td>= {{$price}}PKR</td>
        </tr>

    </tbody>
</table>

<p class="text-muted mb-4">
    Almost done! Just enter your delivery details to complete your order.
</p>

@if(session('confirm_order'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('confirm_order') }}
</div>
@endif

<form action="/confirmorder" method="POST" class="mt-4 ml-5 w-50">
@csrf
    <div class="mb-3">
        <input 
            type="text" 
            name="reciever_address" 
            class="form-control"
            placeholder="Enter Your Address" 
            required
        >
    </div>

    <div class="mb-3">
        <input 
            type="text" 
            name="reciever_phone" 
            class="form-control"
            placeholder="Enter Your Phone Number" 
            required
        >
    </div>
    <div class="d-flex">
    <button type="submit" class="btn btn-primary mr-2">
        Confirm Order
    </button>
     <a href="/stripe/{{$price}}" class="btn btn-primary">
            💳 Pay Now
     </a>
    </div><br>
      <div class="col-auto">
            <a href="{{ url('/') }}" class="btn btn-outline-primary">
            ⬅ Back to Products
            </a>
        </div>
</form>
@else
    <p class="text-muted ml-5 mb-4">
        Your Cart is empty. Plz order new products.
</p> <br>
        <div class="col-auto">
            <a href="{{ url('/') }}" class="btn btn-outline-primary">
            ⬅ Back to Products
            </a>
        </div>
@endif
        
@include('footer')