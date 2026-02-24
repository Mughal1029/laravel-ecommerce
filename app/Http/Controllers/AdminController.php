<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
    function addCategory(){
        return view('admin.addcategory');
    }

    function postAddCategory(Request $request){
         $category = new Category();
        $category->category=$request->category;
        $category->save();
        return redirect()->back()->with('category_message', 'Category added success');
    }

    function viewCategory(){
        $categories=Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    function deleteCategory($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('deletecategory_message','Deleted successfully!');
    }

    function updateCategory($id){
        $category=Category::findOrFail($id);
        return view('admin.updatecategory', compact('category'));
    }

    function postUpdateCategory(Request $request, $id){
        $category=Category::findOrFail($id);
        $category->category=$request->category;
        $category->save();
         return redirect()->back()->with('category_updated_message', 'Category updated successfully!');
    }

    function addProduct(){
        $categories = Category::all();
        // return view('admin.addproduct', ['category'=>$categories]);
        return view('admin.addproduct', compact('categories'));
    }

    function postAddProduct(Request $request){
        $product = new Product();
        $product->product_title=$request->product_title;
        $product->product_description=$request->product_description;
        $product->product_quantity=$request->product_quantity;
        $product->product_price=$request->product_price;
        $product->product_category=$request->product_category;

        $image=$request->product_image;
        if($image){
            $imagename = time(). '.' .$image->getClientOriginalExtension();
            $image->move(public_path('products'), $imagename);
            $product->product_image=$imagename;
        }
        $product->save();
        return redirect()->back()->with('product_message', 'Product added successfully!');

    }

    function viewProduct(){
        $products = Product::paginate(5);
        return view('admin.viewproduct', compact('products'));
    }

    function productUpdate($id){
        $product=Product::findOrFail($id);
        $categories=  Category::all();
        return view('admin.updateproduct', compact('product','categories'));
    }

    function postUpdateProduct(Request $request, $id){
        $product= Product::findOrFail($id);
        $product->product_title=$request->product_title;
        $product->product_description=$request->product_description;
        $product->product_quantity=$request->product_quantity;
        $product->product_price=$request->product_price;
        $product->product_category=$request->product_category;

        $image=$request->product_image;
        if($image){
            $imagename = time(). '.' .$image->getClientOriginalExtension();
            $product->product_image=$imagename; 
        }
        $saved = $product->save();
        if($image && $saved){
            $image->move('products', $imagename);
        }
         return redirect('/viewproduct')->with('product_updated', 'Product updated successfully!');
    }

    function productDelete($id){
    $product = Product::findOrFail($id);
    Order::where('product_id', $id)->update(['product_id' => null]);
    if ($product->product_image) {
        $image_path = public_path('products/'.$product->product_image);
        if (file_exists($image_path) && is_file($image_path)) {
            unlink($image_path);
        }
    }
    $product->delete();
    return redirect()->back()->with('product_delete', 'Product deleted successfully!');
    }

    function viewOrder(){
        $orders=Order::all();
        return view('admin.vieworders', compact('orders'));
    }

    function changeStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status=$request->status;
        $order->save();
        return redirect()->back();
    }

    function downloadPdf($id){
        $data=Order::with('user', 'product')->findOrFail($id);
         $pdf= Pdf::loadView('admin.invoice', compact('data'));
         return $pdf->download('customer.pdf');
    }

    function deleteOrder($id){
        Order::findOrFail($id)->delete();
        return redirect()->back();
    }
}
