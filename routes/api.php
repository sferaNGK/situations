<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/games', [CategoryController::class, 'getGame']);
Route::get('/question/{id}', [QuestionController::class, 'getQuestions']);
Route::get('/answer/{id}', [QuestionController::class, 'getAnswers']);

Route::get('/question', [QuestionController::class, 'getQuestion']);
// Route::get('/answer/{id}', [AnswerController::class, 'getAnswers']);
Route::get('/answer', [AnswerController::class, 'getAnswer']);
