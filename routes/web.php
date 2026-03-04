<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPasienController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('data-pasien', DataPasienController::class);
