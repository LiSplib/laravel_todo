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

Route::get('/', [\App\Http\Controllers\TodoListController::class, 'index'])
    ->name('todolist.index');

Route::get('/pair', function () {
    return 'pair';
});
Route::get('/impair', function () {
    return 'impair';
});

Route::get('/pair/showform', function () {
    return view('pair.form');
});
Route::get('hello/{name}', [\App\Http\Controllers\HelloController::class, 'index']);

Route::get('/pair/{value}', [\App\Http\Controllers\PairController::class, 'index']);

Route::post('/pair/is_even', [\App\Http\Controllers\PairController::class, 'post'])
    ->name('is_even');

Route::get('/todo', [\App\Http\Controllers\TodoController::class, 'index'])
    ->name('todo.index');

Route::get('/todo/delete/{todo}', [\App\Http\Controllers\TodoController::class, 'delete'])
    ->name('todo.delete');
Route::get('/todo/show/{todo}', [\App\Http\Controllers\TodoController::class, 'show'])
    ->name('todo.show');

Route::match(['get', 'post'],
    '/todo/create', [\App\Http\Controllers\TodoController::class, 'create'])->name('todo.create');
