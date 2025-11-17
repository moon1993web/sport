<?php

namespace App\Models\Content;

use App\Models\Content\Category;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs'; // نام جدول در دیتابیس

    protected $fillable = [
        'title',
    'slug',
    'image',
    'short_description',
    'content',
    'tags',
    'category_id',
    'author',
    'status',
    'date',
    'meta_title',
    'meta_description',
    'meta_keywords',
    ];


  public function category()
{
    return $this->belongsTo(Category::class);
}


     protected $casts = [
        'date' => 'date', // تبدیل ستون date به نوع تاریخ
        'status' => 'string', // اطمینان از اینکه status به‌صورت رشته است
 ];
}
