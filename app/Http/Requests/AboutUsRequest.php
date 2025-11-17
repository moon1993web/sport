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
        // در اینجا می‌توانید منطق مربوط به مجوز دسترسی را پیاده‌سازی کنید.
        // برای سادگی، فعلاً true برمی‌گردانیم.
        return true;
    }

    /**
     * قوانین اعتبارسنجی که برای این درخواست اعمال می‌شود را برمی‌گرداند.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // دریافت نمونه مدل در زمان ویرایش (update)
        $aboutUs = $this->route('about_us'); // فرض بر این است که نام پارامتر در روت 'about_us' است

        // اگر متد POST بود (ایجاد رکورد جدید)
        if ($this->isMethod('post')) {
            return [
                'title'             => 'required|string|max:255',
                'short_description' => 'required|string',
                'images'            => 'nullable|array',
                'images.*'          => 'image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048', // اعتبارسنجی برای هر تصویر
                'video_url'         => 'nullable|url',
                'meta_title'        => 'nullable|string|max:255',
                'meta_description'  => 'nullable|string|max:500',
                'keywords'          => 'nullable|string|max:255',
                'slug'              => 'required|string|max:255|unique:about_us,slug',
                'address'           => 'nullable|string|max:1000',
                'phone_number'      => 'nullable|string|max:20',
                'email'             => 'nullable|email|max:255',
            ];
        } 
        
        // اگر متد PUT یا PATCH بود (ویرایش رکورد موجود)
        else {
            return [
                'title'             => 'sometimes|required|string|max:255',
                'short_description' => 'sometimes|required|string',
                'images'            => 'nullable|array',
                'images.*'          => 'image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048',
                'video_url'         => 'nullable|url',
                'meta_title'        => 'nullable|string|max:255',
                'meta_description'  => 'nullable|string|max:500',
                'keywords'          => 'nullable|string|max:255',
                'slug'              => [
                    'sometimes',
                    'required',
                    'string',
                    'max:255',
                    // اسلاگ باید یکتا باشد، به جز برای رکورد فعلی که در حال ویرایش است
                    Rule::unique('about_us')->ignore($aboutUs ? $aboutUs->id : null),
                ],
                'address'           => 'nullable|string|max:1000',
                'phone_number'      => 'nullable|string|max:20',
                'email'             => 'nullable|email|max:255',
            ];
        }
    }

    /**
     * پیام‌های خطای سفارشی برای قوانین اعتبارسنجی.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'وارد کردن عنوان الزامی است.',
            'title.string' => 'عنوان باید یک رشته متنی باشد.',
            'title.max' => 'عنوان نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'short_description.required' => 'وارد کردن توضیحات کوتاه الزامی است.',
            'short_description.string' => 'توضیحات کوتاه باید یک رشته متنی باشد.',

            'images.array' => 'فرمت داده تصاویر باید به صورت آرایه باشد.',
            'images.*.image' => 'هر فایل انتخاب شده باید یک تصویر معتبر باشد.',
            'images.*.mimes' => 'فرمت‌های مجاز برای تصویر: jpeg, png, jpg, gif, webp, tiff.',
            'images.*.max' => 'حجم هر تصویر نباید بیشتر از ۲ مگابایت باشد.',

            'video_url.url' => 'آدرس ویدیو باید یک URL معتبر باشد.',

            'meta_title.string' => 'عنوان متا باید یک رشته متنی باشد.',
            'meta_title.max' => 'عنوان متا نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'meta_description.string' => 'توضیحات متا باید یک رشته متنی باشد.',
            'meta_description.max' => 'توضیحات متا نباید بیشتر از ۵۰۰ کاراکتر باشد.',

            'keywords.string' => 'کلمات کلیدی باید یک رشته متنی باشد.',
            'keywords.max' => 'کلمات کلیدی نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'slug.required' => 'وارد کردن اسلاگ الزامی است.',
            'slug.string' => 'اسلاگ باید یک رشته متنی باشد.',
            'slug.max' => 'اسلاگ نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.unique' => 'این اسلاگ قبلاً استفاده شده است. لطفاً یک اسلاگ دیگر انتخاب کنید.',

            'address.string' => 'آدرس باید یک رشته متنی باشد.',
            'address.max' => 'آدرس نباید بیشتر از ۱۰۰۰ کاراکتر باشد.',

            'phone_number.string' => 'شماره تماس باید یک رشته متنی باشد.',
            'phone_number.max' => 'شماره تماس نباید بیشتر از ۲۰ کاراکتر باشد.',

            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max' => 'ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }
}