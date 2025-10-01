<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

Route::get('info/{key}', [InfoController::class, 'index']);
