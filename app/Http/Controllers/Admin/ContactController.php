<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // برای ارسال ایمیل
use Illuminate\Support\Facades\Log; // برای ثبت خطاها
use App\Http\Requests\ContactRequest; // ریکوئستی که ساختیم
use App\Models\Content\Contact;



class ContactController extends Controller
{
       /**
     * 🟩 نمایش لیست پیام‌ها برای ادمین
     */
    public function index()
    {
        // دریافت پیام‌ها با صفحه‌بندی (جدیدترین‌ها اول)
        $contacts = Contact::latest()->paginate(10);
        return view('Admin.Contact.List', compact('contacts'));
    }

    /**
     * 🟩 ثبت پیام توسط کاربر (فرم تماس با ما)
     * + ارسال اعلان به ایمیل، موبایل و تلگرام
     */
    public function store(ContactRequest $request)
    {
        // 1. ذخیره در دیتابیس
        $contact = Contact::create($request->validated());

        // 2. عملیات ارسال اعلان (Notification Bomb 💣)
        try {
            // الف) ارسال ایمیل به ادمین
            // Mail::raw("پیام جدید از: {$contact->name}\nمتن: {$contact->message}", function ($msg) {
            //     $msg->to('admin@example.com')->subject('تماس با ما جدید');
            // });

            // ب) ارسال پیامک (SMS)
            // $smsService->send('09123456789', "پیام جدید در سایت!"); 

            // ج) ارسال به تلگرام
            // Telegram::sendMessage($chatId, "پیام جدید...");

        } catch (\Exception $e) {
            // اگر ارسال پیام شکست خورد، نگذاریم کاربر خطا ببیند، فقط لاگ کنیم
            Log::error("خطا در ارسال اعلان تماس با ما: " . $e->getMessage());
        }

        return back()->with('success', 'پیام شما با موفقیت ثبت شد. به زودی پاسخ می‌دهیم.');
    }

    /**
     * 🟩 ثبت پاسخ ادمین و تغییر وضعیت
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'reply_text' => 'required|string'
        ]);

        $contact->update([
            'reply_text' => $request->reply_text,
            'status'     => 'replied' // تغییر وضعیت به پاسخ داده شده
        ]);

        // اینجا می‌توان کد ارسال ایمیل پاسخ به کاربر را هم نوشت

        return back()->with('success', 'پاسخ شما ثبت شد.');
    }

    /**
     * 🟩 حذف پیام (Soft Delete)
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'پیام با موفقیت حذف شد.');
    }
}
