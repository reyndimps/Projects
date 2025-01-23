<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesOrderController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        } else {
            return redirect()->route('user.dashboard'); // Redirect to user dashboard
        }
    }
    return view('welcome'); 
})->name('home');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ADMIM
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');    

    Route::resource('products', ProductController::class);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/admin/sales', [AdminController::class, 'sales'])->name('sales');  
    Route::get('/api/monthly-sales', [SalesController::class, 'monthlySales']);
    Route::get('/api/top-items', [SalesController::class, 'topItems']);
    

    //reports
    Route::get('/admin/reports', [ReportsController::class, 'reports'])->name('reports');
    Route::get('/generate-weekly-report', [ReportsController::class, 'generateWeeklyReport'])->name('generate.report');

    //stocks
    Route::get('/admin/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
    Route::get('/admin/inventory/stockstransaction', [StockController::class, 'stocksTransaction'])->name('stocksTransaction');
    Route::put('/admin/stocks/{productId}', [StockController::class, 'updateStocks'])->name('updateStock');
    Route::delete('/admin/stocks/{id}', [StockController::class, 'destroy'])->name('transactions.destroy');

    //suppliers
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::resource('suppliers', SupplierController::class);

    //settings
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/password', [SettingsController::class, 'password'])->name('admin.password');
});


//Staff
Route::middleware(['auth'])->group(function () {
    Route::get('/staff/dashboard', [HomeController::class, 'index'])->name('user.dashboard'); 

    //Settings
    Route::get('/settings', [StaffController::class, 'settings'])->name('user.settings'); 
    Route::post('/settings/update', [SettingsController::class, 'updateSettings'])->name('user.updateSettings');


    //Transactions
    Route::get('/transactions', [StaffController::class, 'transactions'])->name('user.transactions'); 

    //Warranty
    Route::get('/warranty', [StaffController::class, 'warranty'])->name('user.warranty'); 

    //Update Inventory
    Route::post('/update-inventory/{product_id}', [StockController::class, 'updateInventory']);

    //Sales Order
    Route::post('/salesorder', [SalesOrderController::class, 'store'])->name('salesOrder');
    Route::get('/salesorder/{id}/pdf', [SalesOrderController::class, 'generateSalesOrderPDF']);

    


});


Route::middleware('guest')->group(function() {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register'); 
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login'); 
    Route::post('/login', [AuthController::class, 'login']);
});
