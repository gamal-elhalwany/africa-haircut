<?php

use App\Models\Product;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChairsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Front\AppoinmentController;

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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');

Route::get('/{lang}', function ($lang) {
    App::setLocale($lang);
    $services = Product::where('status', 'service')->latest()->take(4)->get();
    return view('home', compact('services'));
});

//*******************************************************//
//******************* User Routes **********************//

Route::get('dashboard/login', [UserController::class, 'loginPage'])->name('login.page');

Route::post('dashboard/login', [UserController::class, 'LoginMethod'])->name('login');

Route::get('dashboard/index', [UserController::class, 'IndexMethod'])->middleware(['auth', 'check_product_qty'])->name('dashboard.index');

//***************************************************************//
//******************* Dashboard routes *************************//

Route::group(['middleware' => ['auth', 'check_product_qty']], function () {

    Route::resource('dashboard/roles', RoleController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/users', UserController::class, ['as' => 'dashboard']);

    Route::resource('dashboard/branches', BranchesController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/chairs', ChairsController::class, ['as' => 'dashboard']);

    Route::resource('dashboard/jobs', JobsController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/products', ProductsController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/salary', SalaryController::class, ['as' => 'dashboard']);



    Route::post('close/chair/{id}', [UserController::class, 'CloseChairMethod'])->name('close.chair');
    Route::post('open/chair/{id}', [UserController::class, 'OpenChairMethod'])->name('open.chair');

    Route::post('daily/{id}', [UserController::class, 'dailyMethod'])->name('daily');


    Route::post('search', [SalaryController::class, 'SearchMethod'])->name('salary.search');

    /****************************************************************************/
    /*************************** invoices routes ********************************/

    Route::post('invoice/{id}', [InvoiceController::class, 'OpenInvoiceMethod'])->name('customer.search');

    Route::get('invoices/all', [InvoiceController::class, 'allInvoices'])->name('invoices.all');

    Route::get('invoice/{id}', [InvoiceController::class, 'OpenInvoiceMethod'])->name('open.invoice');

    Route::post('/customer/create/{id}', [InvoiceController::class, 'CustomerCreateMethod'])->name('customer.create');

    Route::get('invoice/{id}/{customer:name}', [InvoiceController::class, 'SetInvoiceMethod'])->name('set.invoice');

    Route::post('/saveInvoice/{id}/{customer:name}', [InvoiceController::class, 'SaveInvoiceMethod'])->name('save.invoice');

    Route::get('/customer-invoice/{customer:name}/', [InvoiceController::class, 'CustomerInvoiceMethod'])->name('customer.invoice');

    Route::delete('/customer-invoice/{customer:name}/{id}/collect', [InvoiceController::class, 'collectInvoice'])->name('customer.invoice.collect');


    // Display Appointments on the Dashboard Routes.
    Route::get('/appointments/reservations', [AppoinmentController::class, 'reservations'])->name('reservations');

    // Profits and Losses Reports Routes.
    Route::prefix('dashboard/reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/generate', [ReportController::class, 'generate'])->name('reports.generate');
    });

    // Expenses Report Routes.
    Route::prefix('dashboard/expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/store', [ExpenseController::class, 'store'])->name('expenses.store');
    });

    Route::get('user/error', function () {
        return view('dashboard.error');
    })->name('error.msg');
});

// Appointment Routes.
Route::get('appointments/chairs', [AppoinmentController::class, 'index'])->name('chairs.front');
Route::post('appointments/chairs', [AppoinmentController::class, 'store'])->name('store.appointment');
