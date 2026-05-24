<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;


Route::get('/', [BankAccountController::class, 'index']);
Route::resource('accounts', BankAccountController::class);
