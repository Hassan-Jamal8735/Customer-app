<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/customer/form', [FormController::class, 'customerForm'])->name('customer.form');
Route::post('/customer/form', [FormController::class, 'customerSubmit'])->name('customer.create');
Route::get('/customer/view', [FormController::class, 'showCustomers'])->name('customer.view');
Route::get('/customer/edit/{id}', [FormController::class, 'editCustomer'])->name('customer.edit');
Route::post('/customer/update/{id}', [FormController::class, 'updateCustomer'])->name('customer.update');
Route::delete('/customer/delete/{id}', [FormController::class, 'deleteCustomer'])->name('customer.delete');
Route::delete('/customer/soft-delete/{id}',[FormController::class,'softDelete'])->name('customer.softDelete');
Route::get('/customer/trash',[FormController::class,'trashed'])->name('customer.trashed');
Route::patch('/customer/restore/{id}',[FormController::class,'restore'])->name('customer.restore');
Route::post('/customer/search',[FormController::class,'searchCustomer'])->name('customer.search');
Route::get('/customer/ajax-search',[FormController::class,'ajaxSearch'])->name('customer.ajaxSearch');