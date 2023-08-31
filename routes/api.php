<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//modification
Route::get('students', [StudentController::class, 'index']); //fetch Data
Route::post('students', [StudentController::class, 'store']);//request Data
Route::get('students/{id}', [StudentController::class, 'show']); //fetch Data
Route::get('students/{id}/edit', [StudentController::class, 'edit']);//fetch Data
Route::put('students/{id}/edit', [StudentController::class, 'update']);//update Data
Route::delete('students/{id}/delete', [StudentController::class, 'destroy']);//delete Data(hard Delete)