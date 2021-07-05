<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('user/current', [AuthController::class, 'getCurrentUser'])->name('getCurrentUser');
    Route::post('user/refresh', [AuthController::class, 'refresh'])->name('refreshUser');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('topic', [TopicController::class, 'index'])->name('topic.index');
    Route::get('topic/{topic}', [TopicController::class, 'show'])->name('topic.show');
    Route::post('topic', [TopicController::class, 'store'])->name('topic.store');
    Route::put('topic/{topic}', [TopicController::class, 'update'])->name('topic.update');
    Route::delete('topic/{topic}', [TopicController::class, 'delete'])->name('topic.delete');

    Route::get('questionnaire', [QuestionnaireController::class, 'index'])->name('questionnaire.index');
    Route::get('questionnaire/{questionnaire}', [QuestionnaireController::class, 'show'])->name('questionnaire.show');
    Route::post('questionnaire', [QuestionnaireController::class, 'store'])->name('questionnaire.store');
    Route::put('questionnaire/{questionnaire}', [QuestionnaireController::class, 'update'])->name('questionnaire.update');
    Route::delete('questionnaire/{questionnaire}', [QuestionnaireController::class, 'delete'])->name('questionnaire.delete');

    Route::get('question', [QuestionController::class, 'index'])->name('question.index');
    Route::get('question/{question}', [QuestionController::class, 'show'])->name('question.show');
    Route::post('question', [QuestionController::class, 'store'])->name('question.store');
    Route::put('question/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('question/{question}', [QuestionController::class, 'delete'])->name('question.delete');

    Route::get('option', [OptionController::class, 'index'])->name('option.index');
    Route::get('option/{option}', [OptionController::class, 'show'])->name('option.show');
    Route::post('option', [OptionController::class, 'store'])->name('option.store');
    Route::put('option/{option}', [OptionController::class, 'update'])->name('option.update');
    Route::delete('option/{option}', [OptionController::class, 'delete'])->name('option.delete');
});
