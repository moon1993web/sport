<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048',
                'title' => 'required|string|max:255',
            'date' => 'sometimes|nullable|date_format:Y/m/d',
                'author' => 'required|string|max:100',
                'short_description' => 'required|string|max:500',
                'content' => 'required|string',
                'tags' => 'nullable|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:draft,published,archived',
            ];
        } else {
            return [
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048',
                'title' => 'nullable|string|max:255',
               'date' => 'sometimes|nullable|date_format:Y/m/d',
                'author' => 'required|string|max:100',
                'short_description' => 'nullable|string|max:500',
                'content' => 'required|string',
                'tags' => 'nullable|string|max:255',
                'category_id' => 'nullable|string|max:100',
                'status' => 'required|in:draft,published,archived',
            ];
        }
    }

    /**
     * پیام‌های خطای سفارشی برای هر قانون اعتبارسنجی.
     */
    public function messages(): array
    {
        return [
            'image.image' => 'فایل تصویر باید یک تصویر معتبر باشد.',
            'image.mimes' => 'فرمت‌های مجاز برای تصویر: jpeg, png, jpg, gif, webp, tiff.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'title.required' => 'عنوان بلاگ الزامی است.',
            'title.string' => 'عنوان باید یک رشته متنی باشد.',
            'title.max' => 'عنوان نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'date.required' => 'تاریخ انتشار الزامی است.',
            'date.date' => 'فرمت تاریخ معتبر نیست.',
            // پیام‌های خطا نیز باید برای فیلد جدید به‌روز شوند
            'author.required' => 'نام نویسنده الزامی است.', // <<-- تغییر
            'author.string' => 'نام نویسنده باید یک رشته متنی باشد.', // <<-- تغییر
            'author.max' => 'نام نویسنده نباید بیشتر از ۱۰۰ کاراکتر باشد.', // <<-- تغییر
            'short_description.required' => 'توضیحات کوتاه الزامی است.',
            'short_description.string' => 'توضیحات کوتاه باید یک رشته متنی باشد.',
            'short_description.max' => 'توضیحات کوتاه نباید بیشتر از ۵۰۰ کاراکتر باشد.',
            'content.required' => 'محتوای بلاگ الزامی است.',
            'content.string' => 'محتوا باید یک رشته متنی باشد.',
            'tags.string' => 'تگ‌ها باید یک رشته متنی باشند.',
            'tags.max' => 'تگ‌ها نباید بیشتر از ۲۵۵ کاراکتر باشند.',
            'category_id.required' => 'انتخاب دسته بندی الزامی است.',
            'category_id.exists' => 'دسته بندی انتخاب شده معتبر نیست.',
            'status.required' => 'وضعیت بلاگ الزامی است.',
            'status.in' => 'وضعیت باید یکی از مقادیر: پیش‌نویس، منتشرشده یا آرشیو باشد.',
        ];
    }
}
