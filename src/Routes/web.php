<?php

use Illuminate\Support\Facades\Route;

Route::get('mgahed-starter', [\Mgahed\MgahedStarter\Http\Controllers\MgahedStarterController::class, 'index'])->name('mgahed-starter.index');

