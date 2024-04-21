<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;

Route::get('/', function () {
    return view('backend.index');
});

Route::resources([
    'categories' => CategoryController::class,
]);
