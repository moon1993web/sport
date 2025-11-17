<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'name' => 'required|string|max:255',
        
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048',
                'description' => 'nullable|string',
                'status' => 'required|boolean',
                'category_type' => 'required|in:blog,class',
            ];
        } else {
            return [
                'name' => 'nullable|string|max:255',
             
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048',
                'description' => 'nullable|string',
                'status' => 'nullable|boolean',
                'category_type' => 'nullable|in:blog,class',
            ];
        }
    }

    /**
     * پیام‌های خطای سفارشی برای هر قانون اعتبارسنجی.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.string' => 'نام دسته‌بندی باید یک رشته متنی باشد.',
            'name.max' => 'نام دسته‌بندی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
        
            'image.image' => 'فایل تصویر باید یک تصویر معتبر باشد.',
            'image.mimes' => 'فرمت‌های مجاز برای تصویر: jpeg, png, jpg, gif, webp, tiff.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'description.string' => 'توضیحات باید یک رشته متنی باشد.',
            'status.required' => 'وضعیت دسته‌بندی الزامی است.',
            'status.boolean' => 'وضعیت باید یک مقدار بولین (فعال/غیرفعال) باشد.',
            'category_type.required' => 'نوع دسته‌بندی الزامی است.',
            'category_type.in' => 'نوع دسته‌بندی باید یکی از مقادیر: blog, class یا باشد.',
        ];
    }
}
