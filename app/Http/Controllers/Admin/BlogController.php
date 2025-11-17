<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Content\Blog;
use App\Models\Content\Category;
use Illuminate\Support\Facades\File; 
use Morilog\Jalali\Jalalian;

use Illuminate\Http\Request;

class BlogController extends Controller
{

 public function index()
    {
    $blogs = Blog::latest()->with('category')->paginate(15);
    
      

   $categories = Category::where('category_type', 'blog')->get();
        return view('Admin.Blog.index', compact('blogs','categories'));


    }



     /**
     * نمایش فرم ایجاد بلاگ
     */
    public function create()
    {
           $categories = Category::where('category_type', 'blog')->get();
        return view('Admin.Blog.Create', compact('categories'));
    }

    /**
     * ذخیره بلاگ جدید
     */
    public function store(BlogRequest $request)
    {
 
        $data = $request->validated();




// if (isset($data['date'])) {
 if (!empty($data['date'])) {
            $data['date'] = Jalalian::fromFormat('Y/m/d', $data['date'])->toCarbon();
        }



        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('Admin/assets/img/blog/');
                $image->move($destinationPath, $filename);

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر']);
            }
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'بلاگ با موفقیت ایجاد شد!');
    }

    /**
     * نمایش فرم ویرایش بلاگ
     */
    public function edit(Blog $blog)
    {
              // برای فرم ویرایش نیز به دسته‌بندی‌ها نیاز داریم
      $categories = Category::where('category_type', 'blog')->get();
        return view('Admin.Blog.Edit', compact('blog', 'categories'));
    }

    /**
     * به‌روزرسانی بلاگ
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();


// if (isset($data['date'])) {
 if (!empty($data['date'])) {
            $data['date'] = Jalalian::fromFormat('Y/m/d', $data['date'])->toCarbon();
        } else {
        // FIXED: added - Handle the case where the user clears the date field.
        $data['date'] = null;
    }





        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('Admin/assets/img/blog/');
                $image->move($destinationPath, $filename);



if ($blog->image) {
                    $oldImagePath = public_path('Admin/assets/img/blog/' . $blog->image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }



                // // حذف تصویر قدیمی در صورت وجود
                // if ($blog->image && file_exists(public_path('Admin/assets/img/blog/' . $blog->image))) {
                //     unlink(public_path('Admin/assets/img/blog/' . $blog->image));
                // }

                $data['image'] = $filename;
            } else {
                return redirect()->back()->withErrors(['image' => 'خطا در آپلود تصویر']);
            }
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'بلاگ با موفقیت به‌روزرسانی شد!');
    }





  
public function destroy(Blog $blog)
    {
        // FIXED: start
        // باگ: فایل تصویر مرتبط با بلاگ از روی سرور حذف نمی‌شد
        if ($blog->image) {
            $imagePath = public_path('Admin/assets/img/blog/' . $blog->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'بلاگ با موفقیت حذف شد!');
        // FIXED: end
    }





}
