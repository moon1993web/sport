<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   public function index()
{
    $menus = Menu::whereNull('parent_id')->orderBy('position')->get();
    $parentMenus = Menu::all(); // داده‌های فرم ایجاد را هم ارسال می‌کنیم
    return view('Admin.Menu.List', compact('menus', 'parentMenus'));
}
   public function create()
{
    // این متد دیگر برای نمایش یک view مجزا استفاده نمی‌شود.
    // کاربر را به صفحه اصلی منو هدایت می‌کنیم.
    return redirect()->route('admin.menus.index');
}

    public function store(MenuRequest $request)
    {
        Menu::create($request->validated());
        return redirect()->route('admin.menus.index')->with('success', 'منو با موفقیت ایجاد شد.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::where('id', '!=', $menu->id)->get(); // جلوگیری از انتخاب خود منو به عنوان والد
        return view('Admin.Menu.Edit', compact('menu', 'parentMenus'));
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        return redirect()->route('admin.menus.index')->with('success', 'منو با موفقیت ویرایش شد.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'منو با موفقیت حذف شد.');
    }
    
    public function updateOrder(Request $request)
    {
        // این متد برای ذخیره ترتیب منوها با کشیدن و رها کردن (Drag & Drop) استفاده می‌شود
        // منطق دقیق به پیاده‌سازی فرانت‌اند بستگی دارد
        // در اینجا یک نمونه ساده پیاده‌سازی شده است
        $orderData = $request->input('order'); // انتظار یک آرایه از منوها را داریم
        
        foreach ($orderData as $index => $item) {
            Menu::where('id', $item['id'])->update([
                'position' => $index,
                'parent_id' => $item['parent_id'] ?? null,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'ترتیب منوها با موفقیت به‌روزرسانی شد.']);
    }
}