<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('page/registration', [PageController::class, 'regPage'])->name('regPage');
Route::post('page/registration/save', [UserController::class, 'reg'])->name('reg');
Route::post('page/authorization', [UserController::class, 'auth'])->name('auth');
Route::get('page/admin', [PageController::class, 'admin'])->name('admin');
Route::get('page/exit', [UserController::class, 'exit'])->name('exit');
Route::get('page/welcome', [PageController::class, 'welcome'])->name('welcome');
Route::post('page/situation/save', [QuestionController::class, 'store'])->name('situation');
Route::get('page/situations{id}', [PageController::class, 'situationPage'])->name('situationPage');
Route::get('page/situations/detail{id}', [PageController::class, 'detail'])->name('detail');
Route::post('page/situations/update{question}', [QuestionController::class, 'update'])->name('questionUpdate');
Route::get('page/situations/delete{question}', [QuestionController::class, 'destroy'])->name('questionDelete');
Route::get('page/category', [PageController::class, 'category'])->name('category');
Route::post('page/category/save', [CategoryController::class, 'store'])->name('categorySave');
Route::get('page/category/delete/{category}', [CategoryController::class, 'destroy'])->name('categoryDelete');
Route::post('page/category/update/{category}', [CategoryController::class, 'update'])->name('categoryUpdate');
Route::post('page/category/search', [CategoryController::class, 'search'])->name('search');
