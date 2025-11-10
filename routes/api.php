<?php
use App\Http\Controllers\LoginController;


Route::get('/login', [LoginController::class, 'index']); // لعرض البيانات
Route::post('/login', [LoginController::class, 'store']); // لحفظ البيانات


