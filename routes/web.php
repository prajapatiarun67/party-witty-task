<?php

use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::any('/consumer', [ConsumerController::class, 'index'])->name('consumer.index');
Route::get('/consumer/create', [ConsumerController::class, 'create'])->name('consumer.create');
Route::post('/consumer/store', [ConsumerController::class, 'store'])->name('consumer.store');
Route::get('/consumer/{consumer}/edit', [ConsumerController::class, 'edit'])->name('consumer.edit');
Route::post('/consumer/update/{consumer}', [ConsumerController::class, 'update'])->name('consumer.update');
Route::get('/consumer/delete/{consumer}', [ConsumerController::class, 'destroy'])->name('consumer.delete');
Route::get('/consumer/import', [ConsumerController::class, 'import'])->name('consumer.import');
Route::post('/consumer/store_import', [ConsumerController::class, 'store_import'])->name('consumer.store_import');


Route::any('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');
Route::get('/product/import', [ProductController::class, 'import'])->name('product.import');
Route::post('/product/store_import', [ProductController::class, 'store_import'])->name('product.store_import');


Route::any('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/issue', [TransactionController::class, 'show_issue'])->name('transaction.issue');
Route::post('/transaction/store-issue', [TransactionController::class, 'store_issue'])->name('transaction.store-issue');
Route::get('/inventory/{product}', [ProductInventoryController::class, 'getStock']); // For AJAX
Route::get('/transaction/return', [TransactionController::class, 'show_return'])->name('transaction.return');;
Route::post('/transaction/store-return', [TransactionController::class, 'store_return'])->name('transaction.store-return');;

Route::get('/report', [ReportController::class, 'show_report_form'])->name('report.form');
Route::post('/report/generate', [ReportController::class, 'generate_report'])->name('report.generate');

