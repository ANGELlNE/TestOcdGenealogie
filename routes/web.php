<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dbconn', function () {
    return view('dbconn');
});

Route::get('/people', [PersonController::class, 'index'])->name('people.index');
Route::get('/people/{id}', [PersonController::class, 'show'])->name('people.show');
Route::get('/people/create', [PersonController::class, 'create'])->name('people.create');
Route::post('/people', [PersonController::class, 'store'])->name('people.store');

