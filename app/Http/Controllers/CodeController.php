<?php 
namespace App\Http\Controllers; // تحديد النيم سبيس الخاص بالكونترولر

use Illuminate\Http\Request; // لاستقبال البيانات من الطلبات
use Illuminate\Support\Facades\Cache; // لاستخدام الكاش المؤقت
use Illuminate\Support\Facades\Mail; // لإرسال الإيميلات

class CodeController extends Controller 
{ 
    // 🔹 دالة لإرسال كود جديد
    public function sendCode(Request $request) 
    { 
        $email = $request->email; // الحصول على الإيميل المرسل من الفورم

        // 🔹 إنشاء كود عشوائي من 6 أرقام
        $code = rand(100000, 999999); 

        // 🔹 حفظ الكود في الكاش لمدة دقيقتين
        Cache::put('code_'.$email, $code, now()->addMinutes(2)); 

        // 🔹 إرسال الكود على الإيميل
        Mail::raw("كود التحقق الخاص بك: $code", function ($message) use ($email) { 
            $message->to($email) // تحديد المستلم
                    ->subject('كود التحقق من Lunara Store'); // موضوع الرسالة
        }); 

        return response()->json(['message' => 'تم إرسال الكود']); // الرد بالنجاح
    } 

    // 🔹 دالة للتحقق من الكود المدخل
    public function verifyCode(Request $request) 
    { 
        $email = $request->email; // الحصول على الإيميل
        $inputCode = $request->code; // الحصول على الكود الذي أدخله المستخدم

        // 🔹 جلب الكود المخزن في الكاش
        $cachedCode = Cache::get('code_'.$email); 

        if ($cachedCode && $cachedCode == $inputCode) { 
            // 🔹 الكود صحيح، نحذفه من الكاش فورًا حتى لا يعاد استخدامه
            Cache::forget('code_'.$email); 

            return response()->json(['message' => 'الكود صحيح']); // الرد بالنجاح
        } 

        // 🔹 إذا انتهت صلاحية الكود أو غير صحيح
        return response()->json(['message' => 'الكود غير صحيح أو انتهت صلاحيته'], 400); 
    } 
} 
