<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Coach;
use App\Http\Requests\CoachRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoachController extends Controller
{
    /**
     * نمایش لیست مربی‌ها
     */
    public function index()
    {
        // 🟩 استفاده از صفحه‌بندی و مرتب‌سازی
        $coaches = Coach::orderBy('sort_order', 'asc')->latest()->paginate(10);
        // 🟩 مسیر ویو طبق ساختار پوشه‌بندی شما (Admin/Coach/List)
        return view('Admin.Coach.List', compact('coaches'));
    }

    /**
     * نمایش فرم ایجاد
     */
    public function create()
    {
        return view('Admin.Coach.Create');
    }

    /**
     * ذخیره مربی جدید
     */
    public function store(CoachRequest $request)
    {
        $inputs = $request->validated();

        // 🟩 آپلود تصویر در پوشه public/coaches
        if ($request->hasFile('image')) {
            $inputs['image'] = $request->file('image')->store('coaches', 'public');
        }

        // 🟩 ساخت اسلاگ (اگر خالی بود از روی نام بساز)
        if (empty($inputs['slug'])) {
            $inputs['slug'] = Str::slug($inputs['full_name']);
        }

        // 🟩 تبدیل رشته تخصص‌ها به آرایه (چون دیتابیس JSON است)
        if (!empty($inputs['specialties']) && is_string($inputs['specialties'])) {
            $inputs['specialties'] = array_map('trim', explode(',', $inputs['specialties']));
        }

        Coach::create($inputs);

        return redirect()->route('admin.coaches.index')
            ->with('swal-success', 'مربی جدید با موفقیت ثبت شد');
    }

    /**
     * نمایش فرم ویرایش
     */
    public function edit(Coach $coach)
    {
        return view('Admin.Coach.Edit', compact('coach'));
    }

    /**
     * بروزرسانی اطلاعات
     */
    public function update(CoachRequest $request, Coach $coach)
    {
        $inputs = $request->validated();

        // 🟩 مدیریت تصویر: حذف قبلی و آپلود جدید
        if ($request->hasFile('image')) {
            if (!empty($coach->image) && Storage::disk('public')->exists($coach->image)) {
                Storage::disk('public')->delete($coach->image);
            }
            $inputs['image'] = $request->file('image')->store('coaches', 'public');
        }

        // 🟩 مدیریت اسلاگ در ویرایش
        if (empty($inputs['slug'])) {
            $inputs['slug'] = Str::slug($inputs['full_name']);
        }

        // 🟩 تبدیل تخصص‌ها به آرایه
        if (isset($inputs['specialties']) && is_string($inputs['specialties'])) {
            $inputs['specialties'] = array_map('trim', explode(',', $inputs['specialties']));
        }

        $coach->update($inputs);

        return redirect()->route('admin.coaches.index')
            ->with('swal-success', 'اطلاعات مربی با موفقیت ویرایش شد');
    }

    /**
     * حذف (Soft Delete)
     */
    public function destroy(Coach $coach)
    {
        $coach->delete();
        return redirect()->route('admin.coaches.index')
            ->with('swal-success', 'مربی به سطل زباله منتقل شد');
    }
}