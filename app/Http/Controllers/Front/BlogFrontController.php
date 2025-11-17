<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Content\Category;
use App\Models\Content\Blog;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class BlogFrontController extends Controller
{
    /**
     * نمایش لیست بلاگ‌ها در بخش فرانت
     */
    public function index(Request $request)
    {
        // کوئری اصلی برای دریافت بلاگ‌های منتشر شده
        $blogsQuery = Blog::where('status', 'published')->with('category');

        // اعمال جستجو
        if ($request->filled('search')) {
            $blogsQuery->where('title', 'like', '%' . $request->search . '%')
                       ->orWhere('short_description', 'like', '%' . $request->search . '%');
        }
        
        $blogs = $blogsQuery->latest('date')->paginate(6);

        // ===================================================================
        // >> این بخش مشکل شما را حل می‌کند <<
        // دریافت پست‌های محبوب (مثلا ۳ پست آخر که منتشر شده‌اند)
        $popularPosts = Blog::where('status', 'published')->latest('date')->take(3)->get();
        // ===================================================================

        // دریافت دسته‌بندی‌های فعال
        $categories = Category::where('status', true)
            ->where('category_type', 'blog')
            ->withCount(['blogs' => fn($q) => $q->where('status', 'published')])
            ->get()
            ->filter(fn($c) => $c->blogs_count > 0);

        // استخراج و یکتاسازی تگ‌ها
        $allTags = Blog::where('status', 'published')->whereNotNull('tags')->pluck('tags');
        $tags = $allTags->flatMap(fn($t) => array_map('trim', explode(',', $t)))->unique()->values();

        // ارسال تمام متغیرها، از جمله popularPosts به ویو
        return view('Front.Blog.blogs', compact(
            'blogs',
            'popularPosts', // متغیر ارسال شد
            'categories',
            'tags'
        ));
    }

    /**
     * نمایش جزئیات یک بلاگ
     */
    public function show(Blog $blog)
    {
        if ($blog->status !== 'published') {
            abort(404);
        }
        return view('Front.Blog.show', compact('blog'));
    }
}