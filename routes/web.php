<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/minha-empresa', function() {
    return view('minha-empresa');
})->middleware('auth')->name('minha-empresa');

Route::get('/cadastrar-venda', [App\Http\Controllers\SalesController::class, 'index'])->middleware('auth')->name('cadastrar-venda');

Route::post('/cadastrar-venda', [App\Http\Controllers\SalesController::class, 'store'])->middleware('auth')->name('store-sale');

Route::get('/cadastrar-despesa', [App\Http\Controllers\ExpenseController::class, 'index'])->middleware('auth')->name('cadastrar-despesa');

Route::get('/minha-vida', function() {
    return view('minha-vida');
})->middleware('auth')->name('minha-vida');

Route::get('/cadastrar-rendimento', function() {
    return view('cadastrar-rendimento');
})->middleware('auth')->name('cadastrar-rendimento');

Route::get('/cadastrar-despesa-vida', function() {
    return view('cadastrar-despesa-vida');
})->middleware('auth')->name('cadastrar-despesa-vida');

Route::get('/sales/{id}/edit', [App\Http\Controllers\SalesController::class, 'edit'])->middleware('auth')->name('edit-sale');

Route::put('/sales/{id}', [App\Http\Controllers\SalesController::class, 'update'])->middleware('auth')->name('update-sale');

Route::delete('/sales/{id}', [App\Http\Controllers\SalesController::class, 'destroy'])->middleware('auth')->name('delete-sale');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sales/{id}', [App\Http\Controllers\SalesController::class, 'show'])->name('show-sale');

Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])->name('index-sale');

Route::get('/cadastrar-filial', function() {
    return view('cadastrar-filial');
})->middleware('auth')->name('cadastrar-filial');

Route::get('/cadastrar-cliente', function() {
    return view('cadastrar-cliente');
})->middleware('auth')->name('cadastrar-cliente');

Route::get('/cadastrar-fornecedor', function() {
    return view('cadastrar-fornecedor');
})->middleware('auth')->name('cadastrar-fornecedor');

// A rota de recurso para "expenses" já inclui a rota de index.
Route::resource('expenses', App\Http\Controllers\ExpenseController::class)->middleware('auth');
