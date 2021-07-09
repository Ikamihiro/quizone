<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Evaluation\EvaluationController;
use App\Http\Controllers\Evaluation\QuestionnaireController as EvaluationQuestionnaireController;
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

    Route::group(['prefix' => 'admin'], function () {
        Route::apiResource('topic', TopicController::class);
        Route::apiResource('questionnaire', QuestionnaireController::class);
        Route::apiResource('question', QuestionController::class);
        Route::apiResource('option', OptionController::class);
    });

    Route::group(['prefix' => 'common'], function () {
        Route::get('questionnaire', [EvaluationQuestionnaireController::class, 'index'])->name('questionnaire.list');
        Route::get('questionnaire/{questionnaire}', [EvaluationQuestionnaireController::class, 'show'])->name('questionnaire.details');

        Route::get('evaluation', [EvaluationController::class, 'index'])->name('evaluation.index');
        Route::get('evaluation/{evaluation}', [EvaluationController::class, 'show'])->name('evaluation.show');
        Route::post('evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');
    });
});
