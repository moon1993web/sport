<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsRequest; // استفاده از Request اختصاصی برای اعتبارسنجی
use App\Models\Content\AboutUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    /**
     * نمایش فرم ویرایش اطلاعات "درباره ما".
     * این متد اولین رکورد موجود را پیدا کرده و به ویو ارسال می‌کند.
     * اگر رکوردی وجود نداشته باشد، یک فرم خالی نمایش داده می‌شود.
     */
    public function edit()
    {
        // با استفاده از first()، تنها رکورد موجود (یا null) را دریافت می‌کنیم.
        $aboutUs = AboutUs::first();
        
        // ارسال متغیر $aboutUs به ویو. اگر null باشد، ویو باید آن را مدیریت کند.
        return view('admin.Aboutus.Edit', compact('aboutUs'));
    }

    /**
     * اطلاعات "درباره ما" را به‌روزرسانی یا برای اولین بار ایجاد می‌کند.
     *
     * @param AboutUsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AboutUsRequest $request)
    {
        // ۱. دریافت داده‌های اعتبارسنجی شده از فرم
        $validatedData = $request->validated();

        // ۲. پیدا کردن رکورد موجود یا ایجاد یک نمونه جدید در حافظه
        // firstOrNew به ما اجازه می‌دهد که اگر رکوردی نبود، یک مدل جدید بسازیم.
        $aboutUs = AboutUs::firstOrNew(['id' => 1]);

        // ۳. مدیریت آپلود تصاویر
        // مسیرهای تصاویر موجود را از دیتابیس (در صورت وجود) دریافت می‌کنیم
        $imagePaths = $aboutUs->images ?? [];

        // اگر کاربر تصاویر جدیدی آپلود کرده بود
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // هر تصویر را در پوشه 'public/about-us' ذخیره کرده و مسیر آن را به آرایه اضافه می‌کنیم
                // نکته: حتما دستور `php artisan storage:link` را اجرا کرده باشید.
                $path = $imageFile->store('about-us', 'public');
                $imagePaths[] = $path;
            }
        }
        
        // ۴. مدیریت تصاویر حذف شده (در صورتی که در فرانت‌اند پیاده‌سازی شده باشد)
        // فرض می‌کنیم فرانت‌اند آرایه‌ای از تصاویر برای حذف با نام `deleted_images` ارسال می‌کند
        if ($request->has('deleted_images') && is_array($request->deleted_images)) {
            foreach ($request->deleted_images as $deletedImagePath) {
                // حذف فایل فیزیکی از دیسک
                Storage::disk('public')->delete($deletedImagePath);
                // حذف مسیر از آرایه‌ای که قرار است در دیتابیس ذخیره شود
                $imagePaths = array_diff($imagePaths, [$deletedImagePath]);
            }
        }

        // آرایه نهایی مسیرهای تصاویر را در داده‌های اعتبارسنجی شده قرار می‌دهیم
        $validatedData['images'] = array_values($imagePaths); // array_values برای مرتب‌سازی مجدد ایندکس‌ها

        // ۵. تولید خودکار اسلاگ در صورتی که خالی ارسال شده باشد
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }
        
        // ۶. ذخیره تمام اطلاعات در دیتابیس
        // متد updateOrCreate بهترین گزینه برای این سناریو است.
        // اگر رکوردی با id=1 وجود داشته باشد، آن را با داده‌های جدید به‌روزرسانی می‌کند.
        // در غیر این صورت، یک رکورد جدید با همین داده‌ها ایجاد می‌کند.
        AboutUs::updateOrCreate(['id' => 1], $validatedData);

        // ۷. بازگشت به صفحه ویرایش به همراه پیام موفقیت
        return redirect()->route('admin.about-us.edit')
                         ->with('success', 'اطلاعات صفحه "درباره ما" با موفقیت به‌روزرسانی شد.');
    }
}