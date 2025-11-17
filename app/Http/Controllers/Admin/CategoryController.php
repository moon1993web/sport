<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Content\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * نمایش لیست دسته‌بندی‌ها
     */
    public function index()
    {
        $Categories = Category::latest()->get();
    
        return view('Admin.Category.List', compact('Categories'));
    }

    /**
     * نمایش فرم ایجاد دسته‌بندی
     */
    public function create()
    {
        return view('Admin.Category.Create');
    }

    /**
     * ذخیره دسته‌بندی جدید
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('Admin/assets/img/category/');
                $image->move($destinationPath, $filename);

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر']);
            }
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت ایجاد شد!')->with('show_list_tab', true); // این خط اضافه شد;
    }






    /**
     * نمایش فرم ویرایش دسته‌بندی
     */
    public function edit(Category $category)
    {
        return view('Admin.Category.Edit', compact('category'));
    }

    /**
     * به‌روزرسانی دسته‌بندی
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('Admin/assets/img/category/');
                $image->move($destinationPath, $filename);

                // حذف تصویر قدیمی در صورت وجود
                if ($category->image && file_exists(public_path('Admin/assets/img/category/' . $category->image))) {
                    unlink(public_path('Admin/assets/img/category/' . $category->image));
                }

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر']);
            }
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت به‌روزرسانی شد!')->with('show_list_tab', true); // این خط اضافه شد;
    }

    /**
     * حذف دسته‌بندی
     */
    public function destroy(Category $category)
    {
        // حذف تصویر مرتبط در صورت وجود
        if ($category->image && file_exists(public_path('Admin/assets/img/category/' . $category->image))) {
            unlink(public_path('Admin/assets/img/category/' . $category->image));
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت حذف شد!')->with('show_list_tab', true); // این خط اضافه شد;
    }
}
