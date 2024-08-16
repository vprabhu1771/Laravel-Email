<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\http\Controllers\HomeController;

Route::get('/sendEmailManually',[HomeController::class, 'sendEmailManually'])->name('home.sendEmailManually');