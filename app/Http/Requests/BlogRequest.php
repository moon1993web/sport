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
    $rules = [
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,tiff|max:2048',
        'short_description' => 'required|string',
        'content' => 'required|string',
        'tags' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'author' => 'nullable|string|max:255',
       'status' => 'required|in:draft,published,scheduled',
        'date' => 'required|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ];

    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        $blogId = $this->route('blog')->id;
        $rules['slug'] = 'required|string|max:255|unique:blogs,slug,' . $blogId;
    } else {
        $rules['slug'] = 'required|string|max:255|unique:blogs,slug';
    }

    return $rules;
}
    /**
     * پیام‌های خطای سفارشی برای هر قانون اعتبارسنجی.
     */
  public function messages(): array
{
    return [
        'title.required' => 'وارد کردن عنوان الزامی است.',
        'slug.required' => 'وارد کردن اسلاگ (آدرس) الزامی است.',
        'slug.unique' => 'این اسلاگ قبلاً استفاده شده است، لطفاً یک آدرس دیگر انتخاب کنید.',
        'image.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
        'image.mimes' => 'فرمت‌های مجاز تصویر: jpeg, png, jpg, gif, webp, tiff.',
        'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        'short_description.required' => 'نوشتن توضیحات کوتاه الزامی است.',
        'content.required' => 'نوشتن محتوای اصلی الزامی است.',
        'category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
        'category_id.exists' => 'دسته‌بندی انتخاب شده معتبر نیست.',
        'date.required' => 'انتخاب تاریخ انتشار الزامی است.',
        'status.required' => 'انتخاب وضعیت انتشار الزامی است.',
        'status.in' => 'وضعیت انتخاب شده معتبر نیست.',
        'meta_title.max' => 'عنوان متا نباید بیشتر از ۲۵۵ کاراکتر باشد.',
    ];
}
}
