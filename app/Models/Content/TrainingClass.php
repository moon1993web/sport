<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Content\Category; //  ایمپورت صحیح مدل دسته‌بندی
use App\Models\Content\Coach;    //  ایمپورت صحیح مدل مربی

class TrainingClass extends Model
{
    use HasFactory;

    // 💡 چون اسم مدل (TrainingClass) با اسم جدول (classes) فرق داره، اینجا باید دستی بگیم
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'price',
        'capacity',
        'category_id',
        'coach_id',
        'days',       // داده‌های روزهای هفته (JSON)
        'start_time',
        'end_time',
        'status',
    ];

    /**
     * تبدیل خودکار داده‌ها هنگام دریافت از دیتابیس
     */
    protected $casts = [
        'days' => 'array',    // 🪄 JSON دیتابیس -> آرایه PHP
        'status' => 'boolean',
    ];

    // --- روابط (Relationships) ---

    /**
     * ارتباط با دسته‌بندی
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * ارتباط با مربی
     */
    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }
}