<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\contact;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserDetailsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { 
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->name('h');

Route::get('/abouthome', function () {
    return view('abouthome');
})->middleware('age');

Route::get('/about', [contact::class, 'index']);

Route::get('/category', [CategoryController::class, 'categoryAll'])->name('category');
Route::post('/addcategory', [CategoryController::class, 'categoryadd'])->name('storecategory');
Route::get('/categoryedit/{id}', [CategoryController::class, 'categoryEdit']);
Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate']);
Route::get('/categorydelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/pdelete/{id}', [CategoryController::class, 'pdelete']);
Route::get('/allproduct', [ProductController::class, 'productAll'])->name('product');
Route::get('/create/product', [ProductController::class, 'createProduct'])->name('create_product');
Route::post('/addproduct', [ProductController::class, 'productAdd'])->name('storeproduct');
Route::get('/edit/product/{id}', [ProductController::class, 'editProduct']);
Route::post('/update/product/{id}', [ProductController::class, 'productUpdate']);
Route::get('/delete/product/{id}', [ProductController::class, 'productDelete']);
Route::get('/all/brands', [BrandController::class, 'brandAll'])->name('brand');
Route::get('/userprofile', [UserDetailsController::class, 'userData'])->name('userprofile');
Route::post('/user/profile/data', [UserDetailsController::class, 'userProfileData'])->name('add_details');
Route::get('/useredit', [UserDetailsController::class, 'userEdit'])->name('user_edit');
Route::post('/user/update/{id}', [UserDetailsController::class, 'updateDetails']);
// customer
Route::get('/customer', [UserDetailsController::class, 'showAllDetails'])->name('customer');
Route::post('/add/user', [UserDetailsController::class, 'addCustomer']);
Route::post('/show/user/{id}', [UserDetailsController::class, 'showCustomer'])->name('showuser'); 
Route::get('/get/customer/data/{id}', [UserDetailsController::class, 'getCustomerData']);
Route::post('/update/customer/details/{id}', [UserDetailsController::class, 'updateCustomerData']);
Route::get('/get/delete/data/{id}', [UserDetailsController::class, 'getDeleteData']);
Route::post('/delete/customer/details/{id}', [UserDetailsController::class, 'deleteCustomerData']);
// multiple pic
Route::get('/multiplepics', [UserDetailsController::class, 'multiPics'])->name('multipics');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [UserDetailsController::class, 'homePage'])->name('dashboard');

//Route::get('/dashboard', [UserDetailsController::class, 'homePage'])->name('dashboard')->middleware('role');
Route::get('/datatable/view', [UserDetailsController::class, 'view'])->name('datatable');
Route::get('/datatable/data', [UserDetailsController::class, 'allTableData'])->name('showdatatable');
Route::post('/create/newuser', [UserDetailsController::class, 'createNewUser']);
Route::get('/data/edit/{id}', [UserDetailsController::class, 'editUser']);
Route::post('/update/user/{id}', [UserDetailsController::class, 'updateUser']);
Route::get('/delete/user/data/{id}', [UserDetailsController::class, 'getDeleteUserId']);
Route::post('/delete/user/details/{id}', [UserDetailsController::class, 'deleteUser']);