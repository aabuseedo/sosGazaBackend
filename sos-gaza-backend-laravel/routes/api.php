<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\SmartAssistantController;
use App\Http\Controllers\Api\UserApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notifications', [NotificationsController::class, 'index']);
Route::get('/notifications/{id}', [NotificationsController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']); 

Route::get('/assistants', [SmartAssistantController::class, 'index']);
Route::get('/assistants/{id}', [SmartAssistantController::class, 'show']);

Route::post('register', [UserApiController::class, 'register']);
Route::post('login', [UserApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserApiController::class, 'profile']);
    Route::post('profile/update', [UserApiController::class, 'updateProfile']);
    Route::post('profile/emergency', [UserApiController::class, 'updateEmergency']);
    Route::post('profile/phone', [UserApiController::class, 'updatePhone']);
    Route::post('profile/password', [UserApiController::class, 'updatePassword']);
});