<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'images',
        'video_url',
        'meta_title',
        'meta_description',
        'keywords',
        'slug',
        'address',
        'phone_number',
        'email',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
