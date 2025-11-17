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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $this->coach دسترسی به مدل مربی در زمان ویرایش (update) است
        // این کار با استفاده از Route Model Binding در کنترلر انجام می‌شود
        $coachId = $this->coach ? $this->coach->id : null;

        // قوانین اعتبارسنجی برای متد POST (ایجاد مربی جدید)
        if ($this->isMethod('post')) {
            return [
                'full_name'         => 'required|string|max:255',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'education'         => 'required|in:diploma,bachelor,master,phd',
                'short_description' => 'required|string|max:1000',
                'bio'               => 'nullable|string',
                'phone_number'      => ['sometimes', 'required', 'string', 'size:11', Rule::unique('coaches')->ignore($coachId)],
                'email'             => 'required|email|unique:coaches,email',
                'linkedin_url'      => 'nullable|url',
                'instagram_url'     => 'nullable|url',
              'specialties' => 'nullable|string|max:500',
            ];
        }

        // قوانین اعتبارسنجی برای متدهای دیگر مانند PUT/PATCH (ویرایش مربی)
        else {
            return [
                'full_name'         => 'sometimes|required|string|max:255',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // در ویرایش، آپلود عکس جدید اختیاری است
                'education'         => 'sometimes|required|in:diploma,bachelor,master,phd',
                'short_description' => 'sometimes|required|string|max:1000',
                'bio'               => 'nullable|string',
                'phone_number'      => ['sometimes', 'required', 'string', 'size:11', Rule::unique('coaches')->ignore($coachId)],
                'email'             => ['sometimes', 'required', 'email', Rule::unique('coaches')->ignore($coachId)],
                'linkedin_url'      => 'nullable|url',
                'instagram_url'     => 'nullable|url',
                'specialties'       => 'nullable|array',
               'specialties' => 'nullable|string|max:500',
            ];
        }
    }

    /**
     * Get the custom error messages for validator rules.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'وارد کردن نام و نام خانوادگی الزامی است.',
            'full_name.string'   => 'نام و نام خانوادگی باید یک رشته متنی باشد.',
            'full_name.max'      => 'نام و نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد.',

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
        ];
    }
}
