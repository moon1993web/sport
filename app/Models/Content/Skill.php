<?php

namespace App\Models\Content;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
      use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'image',
        'short_description',
        'skill_name',
        'skill_level',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skills';
}
