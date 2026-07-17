<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inscriptions', [InscriptionController::class, 'index'])->name('inscriptions.index');
Route::get('/inscriptions/events/{district_id}', [InscriptionController::class, 'events'])->name('inscriptions.events');
Route::post('/inscriptions', [InscriptionController::class, 'store'])->name('inscriptions.store');

