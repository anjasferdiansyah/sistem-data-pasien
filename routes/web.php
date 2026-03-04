<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pasien', function () {
    return view('pasien.index');
})->name('pasien.index');

Route::get('/pasien/create', function () {
    return view('pasien.create');
})->name('pasien.create');

Route::get('/pasien/{id}/edit', function ($id) {
    return view('pasien.edit', ['id' => $id]);
})->name('pasien.edit');
