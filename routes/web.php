<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;

// Rotas para Expenses
Route::resource('expenses', ExpenseController::class);

// Rotas para Categories
Route::resource('categories', CategoryController::class);
Route::get('/', [CategoryController::class, 'index']);
