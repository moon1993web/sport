<?php

namespace App\Models\Content;
use App\Models\Content\Blog; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
       use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories'; // نام جدول مرتبط با این مدل

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // 'slug',
        'image',
        'description',
        'status',
        'category_type',
    ];



    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean', // تبدیل خودکار فیلد 'status' به نوع boolean
        'category_type' => 'string', // تبدیل خودکار فیلد 'category_type' به نوع string
    ];
}