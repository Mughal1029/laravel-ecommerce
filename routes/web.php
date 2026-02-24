<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Usercontroller::class, 'home'])->name('index');
Route::get('product_details/{id}', [Usercontroller::class, 'productDetails']);
Route::get('viewallproducts', [Usercontroller::class, 'allProducts']);

Route::post('addtocart/{id}', [Usercontroller::class, 'addToCart'])->middleware(['auth', 'verified']);
Route::get('cartproducts', [Usercontroller::class, 'cartProducts'])->middleware(['auth', 'verified']);
Route::get('removecartproduct/{id}', [Usercontroller::class, 'removeCartPorduct'])->middleware(['auth', 'verified']);
Route::post('confirmorder', [Usercontroller::class, 'confirmOrder'])->middleware('auth', 'verified');
 
Route::get('/dashboard', [Usercontroller::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/myorders', [Usercontroller::class,'myOrders'])->middleware(['auth', 'verified']);

Route::controller(Usercontroller::class)->middleware(['auth', 'verified'])->group(function(){

    Route::get('stripe/{price}', 'stripe')->name('stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('admin')->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');    
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::get('/categorydelete/{id}', [AdminController::class, 'deleteCategory']);
    Route::get('/categoryupdate/{id}', [AdminController::class, 'updateCategory']);
    Route::post('/update_category/{id}', [AdminController::class, 'postUpdateCategory']);
    Route::get('/addproduct', [AdminController::class, 'addProduct']);
    Route::post('/addproduct', [AdminController::class, 'postAddProduct']);
    Route::get('/viewproduct', [AdminController::class, 'viewProduct']);
    Route::get('/productupdate/{id}', [AdminController::class, 'productUpdate']);
    Route::post('/productupdate/{id}', [AdminController::class, 'postUpdateProduct']);
    Route::get('/productdelete/{id}', [AdminController::class, 'productDelete']); 
    Route::get('/vieworder', [AdminController::class, 'viewOrder']); 
    Route::post('/changestatus/{id}', [AdminController::class, 'changeStatus']); 
    Route::get('/delete/{id}', [AdminController::class, 'deleteOrder']); 
    
    
    
    });
    Route::get('/downloadpdf/{id}', [AdminController::class, 'downloadPdf']); 

require __DIR__.'/auth.php';
