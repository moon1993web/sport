<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\Contact;
use App\Http\Requests\ContactRequest; // 🟩 استفاده مجدد از ریکوئست امن
use Illuminate\Support\Facades\Log;

class FrontContactController extends Controller
{
      /**
     * 🟩 نمایش صفحه تماس با ما
     */
    public function index()
    {
        return view('Front.Contact.Contactform');
    }

    /**
     * 🟩 ثبت فرم تماس با ما
     */
    public function store(ContactRequest $request)
    {
        // 1. ذخیره پیام
        $contact = Contact::create($request->validated());

        // 2. عملیات ارسال اعلان (Notification)
        // چون کاربر منتظر پاسخ است، اگر سرویس پیامک قطع بود نباید ارور ببیند
        try {
            // TODO: محل قرارگیری کد ارسال SMS یا ایمیل به ادمین
            // Mail::to('admin@site.com')->send(new ContactFormSubmitted($contact));
            
        } catch (\Exception $e) {
            Log::error("Contact Notification Error: " . $e->getMessage());
        }

        // 3. بازگشت با پیام موفقیت
        return back()->with('success', 'پیام شما با موفقیت ثبت شد. کارشناسان ما به زودی با شما تماس می‌گیرند.');
    }
}
