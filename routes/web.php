<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Route;

Route::get('/', MainController::class);
Route::resource('/contacts', ContactController::class);

Route::group([
    'prefix' => '/contacts/{contact_id}'
], function () {
    Route::get('/phone/create', [PhoneController::class, 'create'])->name('phone.create');
    Route::post('/phone/create', [PhoneController::class, 'store'])->name('phone.store');
    Route::get('/phone/edit/{phone_id}', [PhoneController::class, 'edit'])->name('phone.edit');
    Route::put('/phone/edit/{phone_id}', [PhoneController::class, 'update'])->name('phone.update');
    Route::post('/phone/destroy/{phone_id}', [PhoneController::class, 'destroy'])->name('phone.destroy');

    Route::get('/email/create', [EmailController::class, 'create'])->name('email.create');
    Route::post('/email/create', [EmailController::class, 'store'])->name('email.store');
    Route::get('/email/edit/{email_id}', [EmailController::class, 'edit'])->name('email.edit');
    Route::put('/email/edit/{email_id}', [EmailController::class, 'update'])->name('email.update');
    Route::post('/email/destroy/{email_id}', [EmailController::class, 'destroy'])->name('email.destroy');

});
