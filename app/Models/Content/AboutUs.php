<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    //  نام جدول رو صریح می‌نویسیم تا لاراول گیج نشه
    protected $table = 'about_us';

    //  تمام فیلدهای قابل ویرایش رو اینجا لیست می‌کنیم (Security)
    protected $fillable = [
        'title',
        'short_description',
        'image',
        'video_url',
        'meta_title',
        'meta_description',
        'keywords',
        'slug',
        'address',
        'phone_number',
        'email',
    ];

    // 💡 نکته: اگر بخوایم کلمات کلیدی رو به صورت آرایه بگیریم، اینجا Cast اضافه می‌کنیم.
    // فعلاً چون text هست، همین‌طوری استاندارده.
}