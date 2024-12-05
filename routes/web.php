<?php

use App\Http\Controllers\ContactFormController;
use Illuminate\Support\Facades\Route;

Route::controller(ContactFormController::class)->group(static function (): void {
    Route::get('/', 'show')->name('contact-form.show');
    Route::post('/', 'store')->name('contact-form.store');
    Route::get('/success', 'success')->name('contact-form.success');
});
