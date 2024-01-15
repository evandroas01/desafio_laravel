<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
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
Route::get('/', [BlogController::class, 'showBlogs'])->name('blogs');
Route::get('/blog', [BlogController::class, 'index'])->name('blog_index');
Route::post('/blog', [BlogController::class, 'create'])->name('blog_create');
Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog_edit');
Route::put('/blog/edit/{id}', [BlogController::class, 'update'])->name('blog_update');
Route::post('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog_delete');
