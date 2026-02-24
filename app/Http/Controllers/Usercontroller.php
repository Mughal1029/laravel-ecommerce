<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Order;
use Session;
use Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Usercontroller extends Controller
{
    function index(){
        if(Auth::check() && Auth::user()->user_type=="user"){
            return view('dashboard');
        }elseif(Auth::check() && Auth::user()->user_type=="admin"){
            return view('admin.dashboard');
        }
    }

    function home(){
        if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count='';
        }
        $products = Product::latest()->take(5)->get();
        return view('index', compact('products', 'count'));
    }

    function productDetails($id){
         if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count='';
        }
        $product= Product::findOrFail($id);
        return view('product-details', compact('product', 'count'));
    }

    function allProducts(){
         if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count='';
        }
        $products=Product::all();
        return view('view-all-products', compact('products', 'count'));
    }

    function addToCart($id){
        $product=Product::findOrFail($id);
        $cart = new ProductCart();
        $cart->user_id=Auth::id();
        $cart->product_id=$product->id;
        $cart->save();
        return redirect()->back()->with('cart_message', 'added to the cart');
    }

    function cartProducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
            $cart = ProductCart::where('user_id',Auth::id())->get();
        }else{
            $count= '';
            $cart = collect();
        }
        return view('view-cart-products', compact('count','cart'));
    }

    function removeCartPorduct($id){
        $remove = ProductCart::findOrFail($id);
        $remove->delete($id);
        return redirect()->back()->with('remove_cart_product', 'Your Product removed successfully from the Cart.');
    }

function confirmOrder(Request $request){
    $cart_products = ProductCart::where('user_id', Auth::id())->get();
    $address = $request->reciever_address;
    $phone   = $request->reciever_phone;
    foreach ($cart_products as $cart_product) {
        $product = Product::find($cart_product->product_id);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->reciever_address = $address;
        $order->reciever_phone   = $phone;

        $order->product_id = $product?->id;

        $order->product_title = $product?->product_title ?? 'Product Deleted';
        $order->product_price = $product?->product_price ?? 0;
        $order->product_image = $product?->product_image ?? null;
        $order->save();
    }
    ProductCart::where('user_id', Auth::id())->delete();
    return redirect()->back()->with('confirm_order', 'Order Confirmed.');
}
    function myOrders(){
        $orders=Order::where('user_id', Auth::id())->get();
        return view('view-my-orders', compact('orders'));
    }

    function stripe($price){
        if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count='';
        }
        $price=$price;
        return view('stripe', compact('count', 'price'));
    }

    public function stripePost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        $cart_products = ProductCart::where('user_id', Auth::id())->get();
        $address = $request->reciever_address;
        $phone   = $request->reciever_phone;
        foreach ($cart_products as $cart_product) {
        $product = Product::find($cart_product->product_id);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->reciever_address = $address;
        $order->reciever_phone   = $phone;
        $order->payment_status= "paid";

        $order->product_id = $product?->id;

        $order->product_title = $product?->product_title ?? 'Product Deleted';
        $order->product_price = $product?->product_price ?? 0;
        $order->product_image = $product?->product_image ?? null;
        $order->save();
    }
    ProductCart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Payment successful!');
    }
}
