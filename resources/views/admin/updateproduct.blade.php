@extends('admin.maindesign');


@section('update_product')
<base href="/public">@section('update_product')

<!-- @if(session('product_updated'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('product_updated') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif -->


<div class="container-fluid d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-4" style="width: 500px; border-radius: 12px;">
        
        <h4 class="text-center mb-4">Update Product</h4>

        <form action="/productupdate/{{$product->id}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Product Title</label>
                <input type="text" name="product_title"  class="form-control"
                       placeholder="Enter Product Title" value="{{$product->product_title}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Product Description</label>
                <textarea name="product_description" class="form-control" rows="3" value="{{$product->product_description}}"
                          placeholder="Enter Product Description"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control" value="{{$product->product_quantity}}"
                       placeholder="Enter Quantity">
            </div>

            <div class="mb-3">
                <label class="form-label">Product Price</label>
                <input type="number" name="product_price" class="form-control" value="{{$product->product_price}}"
                       placeholder="Enter Price">
            </div>
            <div class="mb-3">
                <img style="width: 100px;" src="{{asset('products/'.$product->product_image)}}"> <label>Old Image</label>
                <label class="form-label">Product Image</label>
                <input type="file" name="product_image" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Product Category</label>
                <select name="product_category" class="form-select" required>
                    <option value="{{$product->product_category}}">{{$product->product_category}}</option>
                    @foreach($categories as $category)
                        <option value="{{$category->category}}">
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary">
                    Update Product
                </button>
            </div>

        </form>
    </div>
</div>



@endsection()