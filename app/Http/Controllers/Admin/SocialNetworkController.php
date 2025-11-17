<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SocialNetworkRequest; // مسیر Form Request
use App\Models\Content\SocialNetwork; // مسیر مدل شبکه اجتماعی
use App\Models\Content\Icon; // مسیر مدل آیکن

class SocialNetworkController extends Controller
{
      /**
     * نمایش لیست تمام شبکه‌های اجتماعی.
     * این متد داده‌ها را به ویوی List.blade.php ارسال می‌کند.
     */
    public function index()
    {
         // دریافت داده‌ها برای تب لیست
        $socialNetworks = SocialNetwork::latest()->paginate(20);
        
        // دریافت داده‌ها برای تب ایجاد (که include می‌شود)
        $icons = Icon::all();

        // ارسال هر دو مجموعه داده به ویو
        return view('Admin.SocialNetwork.List', compact('socialNetworks', 'icons'));
    }

    /**
     * نمایش فرم ایجاد شبکه اجتماعی جدید.
     */
    public function create()
    {
        // دریافت لیست تمام آیکن‌ها برای نمایش در فرم
        $icons = Icon::all();
        
        // نمایش فرم ایجاد به همراه لیست آیکن‌ها
        return view('Admin.SocialNetwork.Create', compact('icons'));
    }

    /**
     * ذخیره یک شبکه اجتماعی جدید در پایگاه داده.
     */
    public function store(SocialNetworkRequest $request)
    {
        // اعتبارسنجی داده‌ها از طریق SocialNetworkRequest و دریافت داده‌های معتبر
        $validated = $request->validated();
        
        // ایجاد رکورد جدید در دیتابیس
        SocialNetwork::create($validated);

        // بازگشت به صفحه لیست به همراه پیام موفقیت
        return redirect()->route('admin.social-networks.index')
                         ->with('success', 'شبکه اجتماعی جدید با موفقیت ایجاد شد.');
    }

    /**
     * نمایش فرم ویرایش یک شبکه اجتماعی مشخص.
     */
    public function edit(SocialNetwork $social_network)
    {
        // لاراول به صورت خودکار شبکه اجتماعی مورد نظر را با استفاده از Route Model Binding پیدا می‌کند
        $icons = Icon::all();
        
        // نمایش فرم ویرایش به همراه اطلاعات شبکه اجتماعی و لیست آیکن‌ها
        return view('Admin.SocialNetwork.Edit', compact('social_network', 'icons'));
    }

    /**
     * به‌روزرسانی اطلاعات یک شبکه اجتماعی در پایگاه داده.
     */
    public function update(SocialNetworkRequest $request, SocialNetwork $social_network)
    {
        // اعتبارسنجی داده‌ها
        $validated = $request->validated();
        
        // به‌روزرسانی رکورد موجود
        $social_network->update($validated);

        // بازگشت به صفحه لیست به همراه پیام موفقیت
        return redirect()->route('admin.social-networks.index')
                         ->with('success', 'شبکه اجتماعی با موفقیت ویرایش شد.');
    }

    /**
     * حذف یک شبکه اجتماعی از پایگاه داده.
     */
    public function destroy(SocialNetwork $social_network)
    {
        // حذف رکورد
        $social_network->delete();

        // بازگشت به صفحه لیست به همراه پیام موفقیت
        return redirect()->route('admin.social-networks.index')
                         ->with('success', 'شبکه اجتماعی با موفقیت حذف شد.');
    }
}
