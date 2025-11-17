<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoachRequest; // استفاده از ریکوئست مخصوص مربی
use App\Models\Content\Coach;      // استفاده از مدل مربی
use Illuminate\Http\Request;

class CoachController extends Controller
{
    /**
     * نمایش لیست مربیان
     */
    public function index()
    {
        // دریافت آخرین مربیان ثبت شده
        $coaches = Coach::latest()->get();
    
         // ¡¡¡مهم!!! دسترسی به آرایه سطوح تحصیلی
        $educationLevels = Coach::$educationLevels;
    
        // ارسال هر دو متغیر به ویوی اصلی لیست
        return view('Admin.Coach.List', compact('coaches', 'educationLevels'));
    }

    /**
     * نمایش فرم ایجاد مربی جدید
     * (این متد در صورت استفاده از تب، ممکن است مستقیماً استفاده نشود ولی برای کامل بودن CRUD وجود دارد)
     */
    public function create()
    {

  // دسترسی به آرایه سطوح تحصیلی از مدل Coach
        $educationLevels = Coach::$educationLevels;

        // ارسال آرایه به ویو
        return view('Admin.Coach.Create', compact('educationLevels'));
    }

    /**
     * ذخیره مربی جدید در دیتابیس
     */
    public function store(CoachRequest $request)
    {
        // اعتبارسنجی و دریافت داده‌های معتبر
        $data = $request->validated();

        // تبدیل رشته حوزه‌های تخصصی (جدا شده با کاما) به آرایه
        if (!empty($data['specialties'])) {
            $data['specialties'] = array_map('trim', explode(',', $data['specialties']));
        }

        // مدیریت آپلود تصویر
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('Admin/assets/img/coach/');
                $image->move($destinationPath, $filename);

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر. لطفاً مجدداً تلاش کنید.'])->withInput();
            }
        }

        // ایجاد رکورد جدید در دیتابیس
        Coach::create($data);

        // بازگشت به لیست همراه با پیام موفقیت
        return redirect()->route('admin.coaches.index')->with('success', 'مربی جدید با موفقیت ایجاد شد!')->with('show_list_tab', true);
                     
                         
    }

    /**
     * نمایش فرم ویرایش مربی
     * (برای بارگذاری داده‌ها در تب ویرایش استفاده خواهد شد)
     */
    public function edit(Coach $coach)
    {

 // دسترسی به آرایه سطوح تحصیلی
        $educationLevels = Coach::$educationLevels;

        // ارسال داده‌های مربی و سطوح تحصیلی به ویوی ویرایش
        return view('Admin.Coach.Edit', compact('coach', 'educationLevels'));
    }

    /**
     * به‌روزرسانی اطلاعات مربی
     */
    public function update(CoachRequest $request, Coach $coach)
    {
        $data = $request->validated();

        //تبدیل رشته حوزه‌های تخصصی به آرایه در صورت وجود
        if (isset($data['specialties'])) {
            $data['specialties'] = $data['specialties'] ? array_map('trim', explode(',', $data['specialties'])) : null;
        }


// // در متد update، جایگزین کد قبلی کنید
// if (isset($data['specialties'])) {
//     // فیلتر کردن آیتم‌های خالی که ممکن است از فرم ارسال شوند
//     $data['specialties'] = array_filter($data['specialties']);
// }



        // مدیریت آپلود تصویر جدید
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('Admin/assets/img/coach/');
                $image->move($destinationPath, $filename);

                // حذف تصویر قدیمی در صورت وجود
                if ($coach->image && file_exists(public_path('Admin/assets/img/coach/' . $coach->image))) {
                    unlink(public_path('Admin/assets/img/coach/' . $coach->image));
                }

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر جدید.'])->withInput();
            }
        }

        // به‌روزرسانی رکورد در دیتابیس
        $coach->update($data);

        // بازگشت به لیست همراه با پیام موفقیت
        return redirect()->route('admin.coaches.index')
                         ->with('success', 'اطلاعات مربی با موفقیت به‌روزرسانی شد!')
                         ->with('show_list_tab', true);
    }

    /**
     * حذف مربی از دیتابیس
     */
    public function destroy(Coach $coach)
    {
        // حذف تصویر مرتبط با مربی از پوشه public
        if ($coach->image && file_exists(public_path('Admin/assets/img/coach/' . $coach->image))) {
            unlink(public_path('Admin/assets/img/coach/' . $coach->image));
        }

        // حذف رکورد از دیتابیس
        $coach->delete();

        // بازگشت به لیست همراه با پیام موفقیت
        return redirect()->route('admin.coaches.index')
                         ->with('success', 'مربی با موفقیت حذف شد!')
                         ->with('show_list_tab', true);
    }
}