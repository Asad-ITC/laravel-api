<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return ["name"=> "test API", "dataType"=> "JSON"];
});

Route::get('students', [StudentController::class, 'list']);
Route::post('add-student', [StudentController::class, 'addStudent']);
Route::put('update-student', [StudentController::class, 'updateStudent']);
// Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);
Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent2']);
