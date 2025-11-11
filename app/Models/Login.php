<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
protected $table = 'login';
 
    // تحديد الأعمدة اللي مسموح بالحفظ الجماعي
    protected $fillable = ['username', 'email', 'password', 'domain', 'storename'];
}
