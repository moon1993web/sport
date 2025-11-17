<?php

namespace App\Models\Content;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class TrainingClass extends Model
{
        use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image',
        'category_id',
        'coach_id',
        'days',
        // 'time_type',
        // 'start_time',
        // 'end_time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'days' => 'array', // این خط بسیار مهم است! آرایه روزها را به صورت خودکار به JSON تبدیل می‌کند و برعکس
    ];

    /**
     * Define the relationship with the Category model.
     * هر کلاس به یک دسته‌بندی تعلق دارد
     */
    public function category(): BelongsTo
    {
        // به مدل Category که در ادامه می‌سازیم متصل می‌شود
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Define the relationship with the Coach model.
     * هر کلاس به یک مربی تعلق دارد
     */
    public function coach(): BelongsTo
    {
        // به مدل Coach که از قبل داشتیم متصل می‌شود
        return $this->belongsTo(Coach::class, 'coach_id');
    }
}
