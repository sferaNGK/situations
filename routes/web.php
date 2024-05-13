<?php


use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Models\Question;
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
    Route::post('registration/save', [UserController::class, 'register'])->name('register');

    Route::post('authorization', [UserController::class, 'login'])->name('login');
    Route::get('admin', [PageController::class, 'admin'])->name('admin');
    Route::get('exit', [UserController::class, 'exit'])->name('exit');
    Route::get('welcome', [PageController::class, 'welcome'])->name('welcome');

    Route::group(['prefix' => 'situation'], function(){
        Route::post('/id', [PageController::class, 'situationPage'])->name('situationPage');
        Route::get('/situation/{categories}', [PageController::class, 'situationPage1'])->name('situationPage1');

        Route::post('/detail/id', [PageController::class, 'detailPost'])->name('detailPost');
        Route::get('/deatail/{questions}', [PageController::class, 'detailGet'])->name('detailGet');

        Route::post('/detail/questionAndAnswer/edit', [QuestionController::class, 'editQuestionAndAnswer'])->name('editQuestionAndAnswer');

        // Route::get('detail/{id}', [PageController::class, 'detail'])->name('detail');
        // Route::get('{category}/add', [PageController::class, 'add'])->name('add');

        Route::post('/question/delete', [QuestionController::class, 'destroy'])->name('questionDelete');
        Route::post('/question/update', [QuestionController::class, 'questionUpdate'])->name('questionUpdate');
        Route::post('/question/save', [QuestionController::class, 'store'])->name('situation');

        Route::post('answer/one', [AnswerController::class, 'store'])->name('answerAdd');
    });

    Route::get('category', [PageController::class, 'category'])->name('category');
    Route::post('category/save', [CategoryController::class, 'store'])->name('categorySave');
    Route::post('category/delete', [CategoryController::class, 'destroy'])->name('categoryDelete');
    Route::post('category/update', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
    Route::post('category/search', [CategoryController::class, 'search'])->name('search');

});

Route::get('/categories/get', [CategoryController::class, 'show'])->name('GetCategories');
Route::post('/questions/get', [QuestionController::class, 'show'])->name('getQuestions');
Route::post('/question/get', [QuestionController::class, 'getQuestionDetail'])->name('getQuestionDetail');
Route::post('/answer/get', [AnswerController::class, 'getAnswersDetail'])->name('getAnswersDetail');
Route::get('/answers/get', [AnswerController::class, 'show'])->name('getAnswers');
