<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/articles');

Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index');
    Route::get('/articles/{article}', 'show');
});
