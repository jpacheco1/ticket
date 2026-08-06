<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MemoriesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');

Route::get('/inscriptions/register', [InscriptionController::class, 'register'])->name('inscriptions.register');
Route::post('/inscriptions/register', [InscriptionController::class, 'storeRegister'])->name('inscriptions.storeRegister');
Route::get('/inscriptions/events/{district_id}', [InscriptionController::class, 'events'])->name('inscriptions.events');
Route::get('/inscriptions/ticket/{id}', [InscriptionController::class, 'ticket'])->name('inscriptions.ticket');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('inscriptions', [InscriptionController::class, 'register'])->name('inscriptions.register');
Route::post('inscriptions', [InscriptionController::class, 'store'])->name('inscriptions.store');

Route::middleware(['auth'])->group(function () {

    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/jsondata', [EventController::class, 'jsondata']);
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::put('events/active/{id}', [EventController::class, 'active'])->name('events.active');

    Route::prefix('events')->group(function () {
        Route::get('/{event_id}/inscriptions', [InscriptionController::class, 'index'])->name('inscriptions.index');
         Route::get('/{event_id}/inscriptions/jsondata', [InscriptionController::class, 'jsonData'])->name('inscriptions.jsondata');
         Route::get('/{event_id}/inscriptions/create', [InscriptionController::class, 'create'])->name('inscriptions.create');
    });

    Route::resource('attendance', AttendanceController::class);
    Route::resource('memories', MemoriesController::class);

    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

});

