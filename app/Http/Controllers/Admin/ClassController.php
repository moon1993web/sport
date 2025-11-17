<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\TrainingClass;
use App\Models\Content\Category;
use App\Models\Content\Coach; 
use App\Http\Requests\ClassRequest;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * نمایش لیست کلاس‌ها و فرم ایجاد.
     */
    public function index()
    {
        // Eager Loading برای جلوگیری از مشکل N+1 در view
        $classes = TrainingClass::latest()->with('coach', 'category')->get();
        
        // دریافت تمام دسته‌بندی‌ها و مربیان برای استفاده در فرم ایجاد
        $categories = Category::all();
        $coaches = Coach::all();

        // ارسال همه داده‌ها به view
        // فرض بر این است که فرم ایجاد (Create) در همان view لیست (List) قرار دارد
        return view('Admin.Classes.List', compact('classes','categories', 'coaches'));
    }

    /**
     * نمایش فرم ایجاد کلاس (در صورت استفاده از صفحه جداگانه).
     */
    public function create()
    {
        $categories = Category::all();
        $coaches = Coach::all();
        return view('Admin.Classes.Create', compact('categories', 'coaches'));
    }

    /**
     * ذخیره کلاس جدید در دیتابیس.
     */
    public function store(ClassRequest $request)
    {
        $data = $request->validated();

        // مدیریت آپلود تصویر
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // مسیر ذخیره‌سازی از اطلاعات شما گرفته شده است
                $destinationPath = public_path('Admin/assets/img/class/');
                $image->move($destinationPath, $filename);

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر. لطفاً مجدداً تلاش کنید.'])->withInput();
            }
        }

        // ایجاد رکورد جدید در دیتابیس
        TrainingClass::create($data);

        // بازگشت به لیست همراه با پیام موفقیت
        return redirect()->route('admin.classes.index')->with('success', 'کلاس جدید با موفقیت ایجاد شد!');
    }

    /**
     * نمایش فرم ویرایش کلاس.
     */
    public function edit(TrainingClass $class) // استفاده از Route Model Binding
    {
        // دریافت تمام دسته‌بندی‌ها و مربیان برای dropdown های فرم ویرایش
        $categories = Category::all();
        $coaches = Coach::all();
        
        return view('Admin.Classes.Edit', compact('class', 'categories', 'coaches'));
    }

    /**
     * به‌روزرسانی اطلاعات کلاس.
     */
    public function update(ClassRequest $request, TrainingClass $class)
    {
        $data = $request->validated();

        // مدیریت آپلود تصویر جدید
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('Admin/assets/img/class/');
                $image->move($destinationPath, $filename);

                // حذف تصویر قدیمی در صورت وجود
                if ($class->image && file_exists(public_path('Admin/assets/img/class/' . $class->image))) {
                    unlink(public_path('Admin/assets/img/class/' . $class->image));
                }

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر جدید.'])->withInput();
            }
        }

        // به‌روزرسانی رکورد در دیتابیس
        $class->update($data);

        // بازگشت به لیست همراه با پیام موفقیت
        return redirect()->route('admin.classes.index')->with('success', 'اطلاعات کلاس با موفقیت به‌روزرسانی شد!');
    }

    /**
     * حذف کلاس از دیتابیس.
     */
    public function destroy(TrainingClass $class)
    {
        // حذف تصویر مرتبط با کلاس از پوشه public (مهم برای جلوگیری از فایل‌های بیهوده)
        if ($class->image && file_exists(public_path('Admin/assets/img/class/' . $class->image))) {
            unlink(public_path('Admin/assets/img/class/' . $class->image));
        }

        // حذف رکورد از دیتابیس
        $class->delete();

        // بازگشت به لیست همراه با پیام موفقیت
        return redirect()->route('admin.classes.index')->with('success', 'کلاس با موفقیت حذف شد!');
    }
}
