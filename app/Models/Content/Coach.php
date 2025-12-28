<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coach extends Model
{
  
  use HasFactory, SoftDeletes;

    // 🟩 تمام فیلدهایی که قراره از فرم بیاد رو اینجا لیست کردم تا MassAssignmentException نگیریم
    protected $fillable = [
        'full_name',
        'slug',
        'image',
        'education',
        'short_description',
        'bio',
        'phone_number',
        'email',
        'linkedin_url',
        'instagram_url',
        'specialties',
        'is_active',
        'sort_order',
    ];

    // 🟩 تبدیل خودکار داده‌ها موقع گرفتن از دیتابیس
    protected $casts = [
        'is_active' => 'boolean',     // 0/1 رو به true/false تبدیل می‌کنه
        'specialties' => 'array',     // JSON دیتابیس رو تبدیل به آرایه PHP می‌کنه
        'sort_order' => 'integer',
    ];
}