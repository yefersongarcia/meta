<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('orcid/create/{orcid}', [UserController::class, 'store']);
Route::get('orcid/list', [UserController::class, 'index'])->name('index');
Route::get('orcid/delete/{orc_id}', [UserController::class, 'destroy'])->name('destroy');
Route::get('orcid/{orcid}', [UserController::class, 'show']);
