<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CoachRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // دریافت ID مربی از طریق Route Model Binding
        // اگر روت به صورت resource تعریف شده باشد، پارامتر معمولاً 'coach' است
        $coachId = $this->route('coach') ? $this->route('coach')->id : null;

        $rules = [
            // قوانین مشترک یا پیش‌فرض
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer|min:0',
            'slug'        => ['nullable', 'string', 'max:255', Rule::unique('coaches')->ignore($coachId)],
        ];

        // قوانین اختصاصی برای ایجاد (POST)
        if ($this->isMethod('post')) {
            return array_merge($rules, [
                'full_name'         => 'required|string|max:255',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'education'         => 'required|in:diploma,bachelor,master,phd',
                'short_description' => 'required|string|max:1000',
                'bio'               => 'nullable|string',
                'phone_number'      => ['required', 'string', 'size:11', Rule::unique('coaches')->ignore($coachId)],
                'email'             => 'required|email|unique:coaches,email',
                'linkedin_url'      => 'nullable|url',
                'instagram_url'     => 'nullable|url',
                'specialties'       => 'nullable|string|max:500', // فرض بر ورودی متنی (مثلاً جدا شده با ویرگول)
            ]);
        }

        // قوانین اختصاصی برای ویرایش (PUT/PATCH)
        else {
            return array_merge($rules, [
                'full_name'         => 'sometimes|required|string|max:255',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'education'         => 'sometimes|required|in:diploma,bachelor,master,phd',
                'short_description' => 'sometimes|required|string|max:1000',
                'bio'               => 'nullable|string',
                'phone_number'      => ['sometimes', 'required', 'string', 'size:11', Rule::unique('coaches')->ignore($coachId)],
                'email'             => ['sometimes', 'required', 'email', Rule::unique('coaches')->ignore($coachId)],
                'linkedin_url'      => 'nullable|url',
                'instagram_url'     => 'nullable|url',
                'specialties'       => 'nullable|string|max:500',
            ]);
        }
    }

    /**
     * پیام‌های فارسی برای خطاها
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'وارد کردن نام و نام خانوادگی الزامی است.',
            'full_name.string'   => 'نام و نام خانوادگی باید یک رشته متنی باشد.',
            'full_name.max'      => 'نام و نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'slug.unique'        => 'این نامک (Slug) قبلاً استفاده شده است.',

            'image.required' => 'انتخاب عکس مربی الزامی است.',
            'image.image'    => 'فایل انتخاب شده باید یک تصویر معتبر باشد.',
            'image.mimes'    => 'فرمت‌های مجاز برای تصویر: jpeg, png, jpg, gif, webp.',
            'image.max'      => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',

            'education.required' => 'انتخاب درجه تحصیلات الزامی است.',
            'education.in'       => 'درجه تحصیلات انتخاب شده معتبر نیست.',

            'short_description.required' => 'وارد کردن توضیحات کوتاه الزامی است.',
            'short_description.string'   => 'توضیحات کوتاه باید یک رشته متنی باشد.',
            'short_description.max'      => 'توضیحات کوتاه نباید بیشتر از ۱۰۰۰ کاراکتر باشد.',

            'bio.string' => 'بیوگرافی باید یک رشته متنی باشد.',

            'phone_number.required' => 'وارد کردن شماره تلفن الزامی است.',
            'phone_number.size'     => 'شماره تلفن باید دقیقاً ۱۱ رقم باشد.',
            'phone_number.unique'   => 'این شماره تلفن قبلاً ثبت شده است.',

            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email'    => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.unique'   => 'این ایمیل قبلاً ثبت شده است.',

            'linkedin_url.url'  => 'فرمت لینکدین وارد شده صحیح نیست.',
            'instagram_url.url' => 'فرمت اینستاگرام وارد شده صحیح نیست.',

            'specialties.string' => 'حوزه‌های تخصصی باید به صورت متنی وارد شوند.',
            'specialties.max'    => 'طول متن حوزه‌های تخصصی بیش از حد مجاز است.',

            'is_active.boolean' => 'وضعیت فعال بودن باید صحیح یا غلط باشد.',
            'sort_order.integer' => 'ترتیب نمایش باید عدد باشد.',
        ];
    }
}
