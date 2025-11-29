<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRequest extends FormRequest
{
    /**
     * تعیین سطح دسترسی
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قوانین اعتبارسنجی
     */
    public function rules(): array
    {
        // 👇 دریافت پارامتر روت (ممکن است آبجکت باشد یا فقط یک ID رشته‌ای)
        $routeParam = $this->route('class'); 
        
        // 🟩 اصلاح مهم: اگر آبجکت بود ID را بگیر، اگر رشته بود خودش را بردار
        $classId = is_object($routeParam) ? $routeParam->id : $routeParam;

        return [
            'title'       => 'required|string|max:255',
            'slug'        => [
                'required',
                'string',
                'max:255',
                // نادیده گرفتن رکورد فعلی هنگام بررسی یکتا بودن
                Rule::unique('classes', 'slug')->ignore($classId),
            ],
            'description' => 'nullable|string',
            
            // تصویر (تکی)
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            
            'price'       => 'nullable|numeric|min:0',
            'capacity'    => 'nullable|integer|min:1',
            
            'category_id' => 'nullable|exists:categories,id',
            'coach_id'    => 'required|exists:coaches,id',
            
            'days'        => 'nullable|array',
            'days.*'      => 'string',
            
            'start_time'  => 'nullable|date_format:H:i',
            'end_time'    => 'nullable|date_format:H:i|after:start_time',
            
            'status'      => 'required|boolean',
        ];
    }

    /**
     * پیام‌های خطا
     */
    public function messages(): array
    {
        return [
            'title.required'      => 'وارد کردن عنوان کلاس الزامی است.',
            'slug.unique'         => 'این اسلاگ (URL) قبلاً استفاده شده است.',
            'coach_id.required'   => 'انتخاب مربی برای کلاس الزامی است.',
            'coach_id.exists'     => 'مربی انتخاب شده معتبر نیست.',
            'price.numeric'       => 'قیمت باید مقدار عددی باشد.',
            'days.array'          => 'فرمت روزهای برگزاری معتبر نیست.',
            'end_time.after'      => 'ساعت پایان باید بعد از ساعت شروع باشد.',
            'image.max'           => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'image.image'         => 'فایل انتخابی باید تصویر باشد.',
        ];
    }
}