<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RickController;

Route::get('/', [RickController::class, 'index']);

