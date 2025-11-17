<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Content\Skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    /**
     * نمایش لیست تمام گروه‌های مهارت.
     */
    public function index()
    {
        // دریافت تمام مهارت‌ها و گروه‌بندی آن‌ها بر اساس عنوان
        $skillGroups = Skill::all()->groupBy('title');
        return view('Admin.Skill.Visit', compact('skillGroups'));
    }

    /**
     * نمایش فرم ایجاد مهارت جدید.
     * از آنجایی که فرم در همان صفحه اصلی قرار دارد، این متد به سادگی همان ویو را باز می‌گرداند.
     */
    public function create()
    {
        return view('Admin.Skill.Visit');
    }

    /**
     * ذخیره یک گروه مهارت جدید در پایگاه داده.
     */
    public function store(SkillRequest $request)
    {
        //   dd($request->all()); // <<-- این خط را اضافه کنید
        // نکته: SkillRequest باید برای پذیرش آرایه برای skill_name و skill_level به‌روز شود.

        DB::beginTransaction();
        try {
            // آپلود تصویر
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/skills'), $imageName);
                $imagePath = 'images/skills/' . $imageName;
            }

            $skillNames = $request->input('skill_name');
            $skillLevels = $request->input('skill_percentage');

            // اطمینان از اینکه تعداد نام‌ها و سطوح مهارت برابر است
            if (count($skillNames) !== count($skillLevels)) {
                return back()->with('error', 'تعداد نام مهارت‌ها با سطح تسلط همخوانی ندارد.');
            }

            // ذخیره هر مهارت به عنوان یک رکورد جداگانه
            for ($i = 0; $i < count($skillNames); $i++) {
                Skill::create([
                    'title'             => $request->input('title'),
                    'short_description' => $request->input('short_description'),
                    'image'             => $imagePath,
                    'skill_name'        => $skillNames[$i],
                    'skill_level'       => $skillLevels[$i],
                    // فیلد 'name' در فرم وجود ندارد، آن را از روی عنوان می‌سازیم
                    'name'              => Str::slug($request->input('title')),
                ]);
            }

            DB::commit();
            return redirect()->route('skills.index')->with('success', 'مجموعه مهارت‌ها با موفقیت ایجاد شد.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطایی در ایجاد مهارت‌ها رخ داد. لطفا دوباره تلاش کنید.');
        }
    }

    /**
     * نمایش فرم ویرایش برای یک گروه مهارت.
     *
     * @param  \App\Models\Content\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        // پیدا کردن تمام مهارت‌هایی که به گروه مورد نظر تعلق دارند (بر اساس عنوان)
        $skillGroup = Skill::where('title', $skill->title)->get();

        if ($skillGroup->isEmpty()) {
            return redirect()->route('skills.index')->with('error', 'گروه مهارت مورد نظر یافت نشد.');
        }

        // ارسال اطلاعات گروه به یک ویوی ویرایش (می‌تواند همان ویوی ایجاد باشد)
        return view('Admin.Skill.Edit', compact('skillGroup')); // فرض بر وجود فایل Edit.blade.php
    }


    /**
     * به‌روزرسانی گروه مهارت در پایگاه داده.
     * این متد تمام رکوردهای قدیمی گروه را حذف و رکوردهای جدید را بر اساس اطلاعات فرم ایجاد می‌کند.
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $originalTitle = $skill->title;

        DB::beginTransaction();
        try {
            $originalGroup = Skill::where('title', $originalTitle)->get();
            $oldImagePath = $originalGroup->first()->image ?? null;

            $imagePath = $oldImagePath;
            if ($request->hasFile('image')) {
                // حذف تصویر قدیمی در صورت وجود
                if ($oldImagePath && File::exists(public_path($oldImagePath))) {
                    File::delete(public_path($oldImagePath));
                }

                // آپلود تصویر جدید
                $image = $request->file('image');
                $imageName = Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/skills'), $imageName);
                $imagePath = 'images/skills/' . $imageName;
            }

            // حذف تمام رکوردهای قدیمی این گروه
            Skill::where('title', $originalTitle)->delete();

            // ایجاد رکوردهای جدید بر اساس اطلاعات فرم
            $skillNames = $request->input('skill_name');
            $skillLevels = $request->input('skill_percentage');

            if (count($skillNames) === count($skillLevels)) {
                for ($i = 0; $i < count($skillNames); $i++) {
                    Skill::create([
                        'title'             => $request->input('title'),
                        'short_description' => $request->input('short_description'),
                        'image'             => $imagePath,
                        'skill_name'        => $skillNames[$i],
                        'skill_level'       => $skillLevels[$i],
                        'name'              => Str::slug($request->input('title')),
                    ]);
                }
            }

            DB::commit();
return redirect()->route('admin.skills.index')->with('success', 'مجموعه مهارت‌ها با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطایی در ویرایش مهارت‌ها رخ داد.');
        }
    }


    /**
     * حذف یک گروه کامل از مهارت‌ها.
     */
    public function destroy(Skill $skill)
    {
        try {
            $groupTitle = $skill->title;
            $skillGroup = Skill::where('title', $groupTitle)->get();

            if ($skillGroup->isEmpty()) {
                return back()->with('error', 'گروه مهارت برای حذف یافت نشد.');
            }

            // حذف فایل تصویر از سرور
            $imagePath = $skillGroup->first()->image;
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            // حذف تمام رکوردهای مربوط به گروه از پایگاه داده
            Skill::where('title', $groupTitle)->delete();

            return redirect()->route('skills.index')->with('success', 'مجموعه مهارت‌ها با موفقیت حذف شد.');

        } catch (\Exception $e) {
            return back()->with('error', 'خطایی در حذف مهارت‌ها رخ داد.');
        }
    }
}