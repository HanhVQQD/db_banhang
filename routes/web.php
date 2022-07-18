<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentManagerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;



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

// Route::get('/', function () {
//     return view('welcome');
// });


//Route::get('/add',StudentManagerController::class);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/',[PageController::class,'getIndex']);

Route::get('/type/{id}', [ PageController::class, 'getProduct_type' ]);	

Route::get('/detail/{id}', [ PageController::class, 'getDetail_product' ]);	

Route::get('/contact', [ PageController::class, 'getContact' ]);
Route::get('/about', [ PageController::class, 'getAbout' ]);	


Route::get('add-to-cart/{id}', [ PageController::class, 'getAddToCart' ]);	
Route::get('del-cart/{id}', [ PageController::class, 'getDelItemCart' ]);

//------------------CHECKOUT-------------------------
Route::get('check-out', [PageController::class, 'getCheckout']);
Route::post('check-out', [PageController::class, 'postCheckout']);

// ------------ADMIN---------------------------------------------------------------------
Route::get('/admin', [FormController::class, 'getIndexAdmin'])->name('showProduct');

Route::get('/add-form', [FormController::class, 'getAdd']);
Route::post('/add-form', [FormController::class, 'store']);

Route::get('admin-edit-form/{id}', [FormController::class, 'getID']);
Route::post('/edit', [FormController::class,'Editform']);

Route::post('admin-delete/{id}', [FormController::class, 'Delete']);

// ---------------------CART -----------------------------------------------------

//---------------- CART ---------------
Route::get('add-to-cart/{id}', [PageController::class, 'getAddToCart'])->name('themgiohang');
Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');

//------------------------- Login, Logout, Register ---------------------------------//
Route::get('/register', function () {
    return view('user.register');
});

Route::post('/register', [UserController::class, 'Register']);

Route::get('/login', function () {
    return view('user.login');
});

Route::get('/logout', [UserController::class, 'Logout']);
Route::post('/login', [UserController::class, 'Login']);
