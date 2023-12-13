<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ChairsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\InvoiceController;
use App\Models\Product;

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


//GUEST ROUTES
//*******************************************************//

//Get Routes
Route::get('/',[HomeController::class,'homeView'])->name('home');

Route::get('/{lang}', function ($lang) {
    App::setLocale($lang);
    $services = Product::where('status','service')->latest()->take(4)->get();
    return view('home',compact('services'));
});
//*****************************//

//*******************************************************//





//USER ROUTES
//*******************************************************//

//Get Routes
Route::get('dashboard/login', function () {
      return view('dashboard.login');
});
Route::get('dashboard/index', [UserController::class,'IndexMethod'])->middleware(['auth'])->name('dashboard.index');

//*****************************//
//Post Routes
Route::post('login',[UserController::class,'LoginMethod'])->name('login');

//*******************************************************//






Route::group(['middleware' => ['auth']], function() {
    Route::resource('dashboard/roles', RoleController::class,[
        'as' => 'dashboard'
    ]);
    Route::resource('dashboard/users', UserController::class,[
        'as' => 'dashboard'
    ]);

    Route::resource('dashboard/branches', BranchesController::class,[
        'as' => 'dashboard'
    ]);
    Route::resource('dashboard/chairs', ChairsController::class,[
        'as' => 'dashboard'
    ]);

    Route::resource('dashboard/jobs', JobsController::class,[
        'as' => 'dashboard'
    ]);
    Route::resource('dashboard/products', ProductsController::class,[
        'as' => 'dashboard'
    ]);
    Route::resource('dashboard/salary', SalaryController::class,[
        'as' => 'dashboard'
    ]);
});

//
Route::post('close/chair/{id}', [UserController::class,'CloseChairMethod'])->middleware(['auth'])->name('close.chair');
Route::post('open/chair/{id}', [UserController::class,'OpenChairMethod'])->middleware(['auth'])->name('open.chair');

Route::post('daily/{id}', [UserController::class,'dailyMethod'])->middleware(['auth'])->name('daily');
//
//
Route::post('search', [SalaryController::class,'SearchMethod'])->middleware(['auth'])->name('salary.search');

Route::get('invoice/{id}',[InvoiceController::class,'OpenInvoiceMethod'])->name('open.invoice');

Route::post('customerSearch/{id}',[InvoiceController::class,'CustomerSearchMethod'])->name('customer.search');

Route::get('setInvoice/{id}/{Customer_id}',[InvoiceController::class,'SetInvoiceMethod'])->name('set.invoice');

Route::post('/saveInvoice/{id}/{Customer_id}',[InvoiceController::class,'SaveInvoiceMethod'])->name('save.invoice');
Route::post('/customer/create',[InvoiceController::class,'CustomerCreateMethod'])->name('customer.create');

Route::get('/customer_invoice/{customer_id}/{invoice_id}',[InvoiceController::class,'CustomerInvoiceMethod'])->name('customer.invoice');
Route::get('user/error',function (){
    return view('dashboard.error');
})->name('error.msg');
