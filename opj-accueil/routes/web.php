<?php

use App\Http\Controllers\OPJController;

Route::get('/opj', [OPJController::class, 'index'])->name('opj.index');
Route::post('/opj/store', [OPJController::class, 'store'])->name('opj.store'); // Cela devrait correspondre
