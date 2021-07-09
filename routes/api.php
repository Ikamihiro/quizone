<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Evaluation\EvaluationController;
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

    Route::apiResource('topic', TopicController::class);
    Route::apiResource('questionnaire', QuestionnaireController::class);
    Route::apiResource('question', QuestionController::class);
    Route::apiResource('option', OptionController::class);

    Route::group(['prefix' => 'evaluation'], function () {
        Route::get('/', [EvaluationController::class, 'index'])->name('evaluation.index');
        Route::get('/{evaluation}', [EvaluationController::class, 'show'])->name('evaluation.show');
        Route::post('/', [EvaluationController::class, 'store'])->name('evaluation.store');
    });
});
