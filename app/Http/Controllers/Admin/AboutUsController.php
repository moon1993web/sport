<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsRequest;
use App\Models\Content\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    /**
     * نمایش فرم ویرایش (یا ایجاد برای بار اول)
     */
    public function edit()
    {
        //  دریافت اولین (و تنها) رکورد جدول
        $aboutUs = AboutUs::first();

        // ویو را صدا می‌زنیم (اگر رکورد نباشد، متغیر null است که در بلید هندل می‌کنیم)
        return view('Admin.Aboutus.Edit', compact('aboutUs'));
    }

    /**
     * ذخیره یا بروزرسانی اطلاعات
     */
    public function update(AboutUsRequest $request)
    {
        //  دریافت رکورد فعلی یا ایجاد آبجکت جدید اگر وجود نداشت
        $aboutUs = AboutUs::firstOrNew();

        $inputs = $request->validated();

        //  مدیریت آپلود تصویر (طبق قوانین گام ۱) ---
        if ($request->hasFile('image')) {
            // ۱. حذف تصویر قبلی اگر وجود دارد
            if ($aboutUs->image && Storage::exists('public/' . $aboutUs->image)) {
                Storage::delete('public/' . $aboutUs->image);
            }

            // ۲. آپلود تصویر جدید در مسیر storage/app/public/about-us
            $imagePath = $request->file('image')->store('about-us', 'public');
            
            // ۳. ذخیره مسیر در آرایه ورودی‌ها
            $inputs['image'] = $imagePath;
        }

        // ذخیره اطلاعات
        $aboutUs->fill($inputs);
        $aboutUs->save();

        return redirect()->route('admin.about-us.edit')
            ->with('swal-success', 'اطلاعات درباره ما با موفقیت بروزرسانی شد.');
    }
}