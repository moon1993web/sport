<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AboutUsRequest extends FormRequest
{
    /**
     * مشخص می‌کند آیا کاربر مجاز به انجام این درخواست است یا خیر.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قوانین اعتبارسنجی که برای این درخواست اعمال می‌شود.
     */
    public function rules(): array
    {
        // دریافت آبجکت مدل در حالت ویرایش (با فرض اینکه نام پارامتر روت about_us است)
        // نکته: اگر Route Model Binding استفاده نشده باشد، این مقدار ممکن است ID باشد.
        $aboutUsId = $this->route('about_us') ? $this->route('about_us')->id : null;

        // قوانین مشترک
        $commonRules = [
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string',
            'video_url'         => 'nullable|url',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'keywords'          => 'nullable|string|max:255',
            'address'           => 'nullable|string|max:1000',
            'phone_number'      => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:255',
        ];

        // اگر متد POST بود (ایجاد رکورد جدید)
        if ($this->isMethod('post')) {
            return array_merge($commonRules, [
                //  قبلی: 'images' => 'nullable|array',
                //  اصلاح شده: آپلود تکی
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                
                'slug'  => 'required|string|max:255|unique:about_us,slug',
            ]);
        } 
        
        // اگر متد PUT یا PATCH بود (ویرایش رکورد موجود)
        else {
            return array_merge($commonRules, [
                //  قبلی: 'images.*' => ...
                //  اصلاح شده: آپلود تکی
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('about_us')->ignore($aboutUsId),
                ],
            ]);
        }
    }

    /**
     * پیام‌های خطای سفارشی.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'وارد کردن عنوان الزامی است.',
            'title.max'      => 'عنوان نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            
            //  پیام‌های اصلاح شده برای تصویر تکی
            'image.image'    => 'فایل انتخابی باید یک تصویر معتبر باشد.',
            'image.mimes'    => 'فرمت‌های مجاز تصویر: jpeg, png, jpg, gif, webp.',
            'image.max'      => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',

            'slug.unique'    => 'این اسلاگ قبلاً استفاده شده است.',
            'slug.required'  => 'اسلاگ الزامی است.',
            'email.email'    => 'فرمت ایمیل صحیح نیست.',
            'video_url.url'  => 'آدرس ویدیو معتبر نیست.',
        ];
    }
}