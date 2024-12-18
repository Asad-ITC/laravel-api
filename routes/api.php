<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return ["name"=> "test API", "dataType"=> "JSON"];
});

Route::post('signup', [UserAuthController::class, 'signup']);
Route::post('login', [UserAuthController::class, 'login']);
Route::post('logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('students', [StudentController::class, 'list']);
    Route::post('add-student', [StudentController::class, 'addStudent']);
    Route::put('update-student', [StudentController::class, 'updateStudent']);
    // Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);
    Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent2']);
    Route::get('search-student/{name}', [StudentController::class, 'searchStudent']);
    Route::resource('member', MemberController::class);
});

Route::get('login', [UserAuthController::class, 'login'])->name('login');

// For Employee Route:

// without protection:
// Route::apiResource('employees', EmployeeController::class);

// With Gurd:
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/employees', [EmployeeController::class, 'index']);
//     Route::post('/employees', [EmployeeController::class, 'store']);
//     Route::get('/employees/{id}', [EmployeeController::class, 'show']);
//     Route::put('/employees/{id}', [EmployeeController::class, 'update']);
//     Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('employees', EmployeeController::class);
});