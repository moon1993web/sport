<?php

namespace App\Models\Content;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //  فراخوانی SoftDeletes
use Illuminate\Database\Eloquent\Casts\Attribute; //  برای تعریف Accessor مدرن

class Contact extends Model
{
        use HasFactory, SoftDeletes;


   protected $fillable = [
        'name',
        'email',
        'mobile',
        'subject',
        'message',
        'reply_text',
        'status',
    ];



       protected function jalaliCreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn () => jdate($this->created_at)->format('%A, %d %B %Y - H:i')
        );
    }

}
