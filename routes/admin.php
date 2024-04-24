<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;

Route::get('/', function () {
    return view('backend.index');
});

Route::resources([
    'categories' => CategoryController::class,
    'news' => NewsController::class,
]);
