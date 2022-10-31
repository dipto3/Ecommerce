<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
Use App\Http\Controllers\SuperAdminController;
Use App\Http\Controllers\CategoryController;
Use App\Http\Controllers\SubCategoryController;
Use App\Http\Controllers\BrandController;
Use App\Http\Controllers\UnitController;
Use App\Http\Controllers\SizeController;
Use App\Http\Controllers\ColorController;
Use App\Http\Controllers\ProductController;
Use App\Http\Controllers\CartController;
Use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'index']);

Route::get('/search',[HomeController::class,'search']);

Route::get('/adminlogin',[AdminController::class,'admin']);
Route::get('/dashboard',[SuperAdminController::class,'dashboard']);
Route::get('/logout',[SuperAdminController::class,'logout']);
Route::post('/admin-dashboard',[AdminController::class,'show_dashboard']);

//Category controller
Route::resource('/categories',CategoryController::class);
Route::get('/cat-status{category}',[CategoryController::class,'change_status']);

//SubCategory controller...
Route::resource('/sub-categories',SubCategoryController::class);
Route::get('/subcat-status{subcategory}',[SubCategoryController::class,'change_status']);

//Brand controller...
Route::resource('/brands',BrandController::class);
Route::get('/brand-status{brand}',[BrandController::class,'change_status']);

//unit controller...
Route::resource('/units',UnitController::class);
Route::get('/unit-status{unit}',[UnitController::class,'change_status']);

//size controller...
Route::resource('/sizes',SizeController::class);
Route::get('/size-status{size}',[SizeController::class,'change_status']);

//color controller...
Route::resource('/colors',ColorController::class);
Route::get('/color-status{color}',[ColorController::class,'change_status']);

//product controller...
Route::resource('/products',ProductController::class);
Route::get('/product-status{product}',[ProductController::class,'change_status']);


Route::get('/view-details{id}',[HomeController::class,'view_details']);
Route::get('/product_by_cat/{id}',[HomeController::class,'product_by_cat']);
Route::get('/product_by_subcat/{id}',[HomeController::class,'product_by_subcat']);
Route::get('/product_by_brand/{id}',[HomeController::class,'product_by_brand']);

//cart controller...
Route::post('/add-to-cart',[CartController::class,'add_to_cart']);
Route::get('/delete-cart/{id}',[CartController::class,'delete']);


Route::get('/checkout',[CheckoutController::class,'index']);
// Route::group(['middleware'=>'index'],function(){
//     Route::get('/checkout',[CheckoutController::class,'index']);
// });


Route::get('/login-check',[CheckoutController::class,'login_check']);

//customer login & reg controller...
Route::post('/customer-login',[CustomerController::class,'login']);
Route::post('/customer-registration',[CustomerController::class,'registration']);

Route::get('/cus-logout',[CustomerController::class,'logout']);

Route::post('/save-shipping-address',[CheckoutController::class,'save_shipping_address']);
Route::get('/payment',[CheckoutController::class,'payment']);

Route::post('/order-place',[CheckoutController::class,'order_place']);

Route::get('/manage-order',[OrderController::class,'manage_order']);

Route::get('/view-order/{id}',[OrderController::class,'view_order']);
Route::get('/view-order/{id}',[OrderController::class,'destroy']);

