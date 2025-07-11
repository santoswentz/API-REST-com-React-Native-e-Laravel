<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RickController;

Route::get('/rick', [RickController::class, 'index']);

