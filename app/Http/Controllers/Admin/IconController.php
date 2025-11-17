<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\Icon; 

class IconController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $icons = Icon::latest()->get();
        return view('Admin.Icon.List', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'required|string',
        ]);

        $icon = Icon::create($request->all());

        return redirect()->route('admin.icons.index')->with('success', 'آیکون با موفقیت اضافه شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Icon $icon)
    {
        $icon->delete();
        return redirect()->route('admin.icons.index')->with('success', 'آیکون با موفقیت حذف شد.');
    }
}
