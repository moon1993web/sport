<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coaches';












    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'image',
        'education',
        'short_description',
        'bio',
        'phone_number',
        'email',
        'linkedin_url',
        'instagram_url',
        'specialties',
    ];


    public static $educationLevels = [
        'diploma'  => 'دیپلم',
        'bachelor' => 'کارشناسی',
        'master'   => 'کارشناسی ارشد',
        'phd'      => 'دکتری',
    ];




    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
            'specialties' => 'array',
        'education' => 'string', // گرچه enum است، کست به string مشکلی ایجاد نمی‌کند
    ];
}
