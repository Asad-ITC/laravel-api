<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/msg', function () {
    return ["name"=> "test API", "dataType"=> "JSON"];
});

