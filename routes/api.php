<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CalculatorController;
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

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
// @FIXME: This route should probably only be a GET route (as used by the ThrottleAPIRequestsFeatureTest), but the AuthFeatureTest uses it as a POST route
Route::get('me', [AuthController::class, 'me'])->name('me');
Route::post('me', [AuthController::class, 'me'])->name('me');

Route::group(['prefix' => 'calculator', 'middleware' => 'auth'], function () {
    Route::post('addTwoNumbers', [CalculatorController::class, 'addTwoNumbers'])->name('addTwoNumbers');
    Route::post('subtractTwoNumbers', [CalculatorController::class, 'subtractTwoNumbers'])->name('subtractTwoNumbers');
    Route::post('multiplyTwoNumbers', [CalculatorController::class, 'multiplyTwoNumbers'])->name('multiplyTwoNumbers');
    Route::post('divideTwoNumbers', [CalculatorController::class, 'divideTwoNumbers'])->name('divideTwoNumbers');
});
