<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Content\TrainingClass;
use App\Models\Content\Category;
use App\Models\Content\Coach;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    /**
     * نمایش لیست کلاس‌ها
     */
     public function index()
    {
        // دریافت کلاس‌ها
        $classes = TrainingClass::with(['coach', 'category'])
            ->latest()
            ->paginate(10);

        // 🟩 اضافه شده: دریافت لیست مربیان و دسته‌بندی‌ها برای تب "افزودن"
        $coaches = Coach::all();
        $categories = Category::all();

        // ارسال همه متغیرها به ویو
        return view('Admin.Classes.List', compact('classes', 'coaches', 'categories'));
    }
    /**
     * نمایش فرم ایجاد کلاس
     */
    public function create()
    {
        // دریافت لیست دسته‌بندی‌ها و مربیان برای نمایش در سلکت‌باکس
        $categories = Category::all();
        $coaches = Coach::all();

        return view('Admin.Classes.Create', compact('categories', 'coaches'));
    }

    /**
     * ذخیره کلاس جدید
     */
    public function store(ClassRequest $request)
    {
        $inputs = $request->validated();

        // مدیریت آپلود تصویر
        if ($request->hasFile('image')) {
            $inputs['image'] = $request->file('image')->store('classes', 'public');
        }

        // نکته: تبدیل آرایه 'days' به JSON به صورت خودکار توسط Casts مدل انجام می‌شود.

        TrainingClass::create($inputs);

        return redirect()->route('admin.classes.index')
            ->with('swal-success', 'کلاس جدید با موفقیت ایجاد شد.');
    }

    /**
     * نمایش فرم ویرایش
     * پارامتر ورودی $id است چون در روت {class} تعریف شده اما مدل TrainingClass است.
     */
    public function edit($id)
    {
        $class = TrainingClass::findOrFail($id);
        $categories = Category::all();
        $coaches = Coach::all();

        return view('Admin.Classes.Edit', compact('class', 'categories', 'coaches'));
    }

    /**
     * بروزرسانی کلاس
     */
    public function update(ClassRequest $request, $id)
    {
        $class = TrainingClass::findOrFail($id);
        $inputs = $request->validated();

        // مدیریت آپلود تصویر جدید و حذف قبلی
        if ($request->hasFile('image')) {
            if ($class->image && Storage::exists('public/' . $class->image)) {
                Storage::delete('public/' . $class->image);
            }
            $inputs['image'] = $request->file('image')->store('classes', 'public');
        }

        $class->update($inputs);

        return redirect()->route('admin.classes.index')
            ->with('swal-success', 'اطلاعات کلاس با موفقیت ویرایش شد.');
    }

    /**
     * حذف کلاس
     */
    public function destroy($id)
    {
        $class = TrainingClass::findOrFail($id);

        // حذف تصویر از حافظه
        if ($class->image && Storage::exists('public/' . $class->image)) {
            Storage::delete('public/' . $class->image);
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('swal-success', 'کلاس با موفقیت حذف شد.');
    }
}