@extends('admin.maindesign');

<base href="/public">@section('update_category')
@section('update_category')

@if(session('category_updated_message'))
<div style="border: 1px solid blue; color:white; border-redius: 4px rounded; padding: 10px; background-color: light-blue; margin-bottom: 10px;">
    {{session('category_updated_message')}}
</div>
@endif

<div class="container-fluid">
    <form action="/update_category/{{$category->id}}" method="POST">
        @csrf
        <input type="text" class="form-control w-50" name="category" value="{{$category->category}}">
        <br>
        <button type="submit" class="btn btn-primary">Update Category</button>
    
    </form>
</div>


@endsection()