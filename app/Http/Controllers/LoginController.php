<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    // حفظ البيانات
    public function store(Request $request)
    {
        
        $data = $request->only(['username', 'email', 'password', 'domain', 'storename']);

        $login = Login::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'domain' => $data['domain'],
            'storename' => $data['storename'],
        ]);

        return response()->json([
            'message' => 'تم الحفظ بنجاح',
            'data' => $login
        ], 201);
    }

    // 🔹 عرض كل البيانات المحفوظة
    public function index()
    {
        $allLogins = Login::all(); // يجيب كل الصفوف من الجدول
        return response()->json($allLogins);
    }
}
