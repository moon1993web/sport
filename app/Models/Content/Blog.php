<?php

namespace App\Models\Content;

use App\Models\Content\Category;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs'; // نام جدول در دیتابیس

    protected $fillable = [
        'image',
        'title',
        'date',
        'author',
        'short_description',
        'content',
        'tags',
        'category_id',
        'status',
    ];


       public function category()
    {
        // فرض بر این است که مدل دسته بندی شما در app/Models/Category.php قرار دارد
        return $this->belongsTo(Category::class);
    }


     protected $casts = [
        'date' => 'date', // تبدیل ستون date به نوع تاریخ
        'status' => 'string', // اطمینان از اینکه status به‌صورت رشته است
 ];
}
