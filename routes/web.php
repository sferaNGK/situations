<?php


use App\Http\Controllers\AnswerController;
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

Route::group(['prefix' => 'page'], function(){
    Route::get('registration', [PageController::class, 'regPage'])->name('regPage');
    Route::post('registration/save', [UserController::class, 'reg'])->name('reg');

    Route::post('authorization', [UserController::class, 'auth'])->name('auth');
    Route::get('admin', [PageController::class, 'admin'])->name('admin');
    Route::get('exit', [UserController::class, 'exit'])->name('exit');
    Route::get('welcome', [PageController::class, 'welcome'])->name('welcome');

    Route::group(['prefix' => 'situation'], function(){
        Route::get('{id}', [PageController::class, 'situationPage'])->name('situationPage');
        Route::get('detail/{id}', [PageController::class, 'detail'])->name('detail');
        Route::get('{category}/add', [PageController::class, 'add'])->name('add');

        Route::get('delete/{question}', [QuestionController::class, 'destroy'])->name('questionDelete');
        Route::post('update/{question}/{answer}', [QuestionController::class, 'update'])->name('questionUpdate');
        Route::post('/{category}/save', [QuestionController::class, 'store'])->name('situation');

        Route::post('answer/one', [AnswerController::class, 'store'])->name('answerAdd');
    });

    Route::get('category', [PageController::class, 'category'])->name('category');
    Route::post('category/save', [CategoryController::class, 'store'])->name('categorySave');
    Route::get('category/delete/{category}', [CategoryController::class, 'destroy'])->name('categoryDelete');
    Route::post('category/update/{category}', [CategoryController::class, 'update'])->name('categoryUpdate');
    Route::post('category/search', [CategoryController::class, 'search'])->name('search');

});
