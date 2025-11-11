<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CodeController; // ✅ استدعاء الكونترولر الجديد


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'store']);
// 🔹 إرسال الكود إلى الإيميل
Route::match( 'post', '/send-code', [CodeController::class, 'sendCode']);


// 🔹 التحقق من الكود بعد ما المستخدم يدخله
Route::get('/verify-code', [CodeController::class, 'verifyCode']);