<?php

namespace App\Models\Content;
use App\Models\Content\Icon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialNetwork extends Model
{
      use HasFactory;

    /**
     * نام جدولی که این مدل به آن متصل است.
     *
     * @var string
     */
    protected $table = 'social_networks';

    /**
     * ویژگی‌هایی که قابلیت تخصیص انبوه (Mass Assignment) را دارند.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'link',
        'icon_id',
        'status',
    ];

    /**
     * ویژگی‌هایی که باید به نوع‌های بومی (native types) تبدیل شوند.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * تعریف رابطه "تعلق داشتن به" با مدل آیکن.
     * هر شبکه اجتماعی به یک آیکن تعلق دارد.
     */
    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }
}
