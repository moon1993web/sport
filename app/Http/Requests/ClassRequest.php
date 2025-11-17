<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
        // // قوانین مشترک برای روزهای هفته
        $daysRules = [
            'nullable',
            'array', // باید یک آرایه باشد
            'min:1'    // حداقل یک روز باید انتخاب شود (در صورت نیاز می‌توانید این قانون را حذف کنید)
        ];

        // قوانین برای ایجاد کلاس جدید (POST)
        if ($this->isMethod('post')) {
            return [
                'title'             => 'required|string|max:255',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'category_id' => 'required|integer|exists:categories,id',
                'coach_id'          => 'required|integer|exists:coaches,id',
                'days'              => $daysRules,
                'days.*'            => 'string|in:شنبه,یک‌شنبه,دوشنبه,سه‌شنبه,چهارشنبه,پنج‌شنبه,جمعه',
                // 'time_type'         => 'required|in:custom,canceled,tba',
                // 'start_time'        => 'required_if:time_type,custom|nullable|date_format:H:i',
                // 'end_time'          => 'required_if:time_type,custom|nullable|date_format:H:i|after:start_time',
            ];
        }

        // قوانین برای ویرایش کلاس (PUT/PATCH)
        else {
            return [
                'title'             => 'sometimes|required|string|max:255',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // عکس در ویرایش اختیاری است
                'category_id' => 'sometimes|required|integer|exists:categories,id',
                'coach_id'          => 'sometimes|required|integer|exists:coaches,id',
                'days'              => $daysRules,
                'days.*'            => 'string|in:شنبه,یک‌شنبه,دوشنبه,سه‌شنبه,چهارشنبه,پنج‌شنبه,جمعه',
                // 'time_type'         => 'sometimes|required|in:custom,canceled,tba',
                // 'start_time'        => 'required_if:time_type,custom|nullable|date_format:H:i',
                // 'end_time'          => 'required_if:time_type,custom|nullable|date_format:H:i|after:start_time',
            ];
        }
    }

    /**
     * Get the custom error messages for validator rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'وارد کردن عنوان کلاس الزامی است.',
            'title.string'   => 'عنوان کلاس باید یک رشته متنی باشد.',
            'title.max'      => 'عنوان کلاس نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'image.required' => 'انتخاب عکس برای کلاس الزامی است.',
            'image.image'    => 'فایل انتخاب شده باید یک تصویر معتبر باشد.',
            'image.mimes'    => 'فرمت‌های مجاز برای تصویر: jpeg, png, jpg, gif, webp.',
            'image.max'      => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',

            'category_id.required' => 'انتخاب دسته‌بندی کلاس الزامی است.',
            'category_id.integer'  => 'شناسه دسته‌بندی باید یک عدد صحیح باشد.',
            'category_id.exists'   => 'دسته‌بندی انتخاب شده معتبر نیست.',

            'coach_id.required' => 'انتخاب مربی الزامی است.',
            'coach_id.integer'  => 'شناسه مربی باید یک عدد صحیح باشد.',
            'coach_id.exists'   => 'مربی انتخاب شده معتبر نیست.',

            'days.array' => 'روزهای کلاس باید به صورت لیستی از موارد باشند.',
            'days.min'   => 'حداقل یک روز برای کلاس باید انتخاب شود.',
            'days.*.in'  => 'روز انتخاب شده برای کلاس معتبر نیست.',

            // 'time_type.required' => 'انتخاب نوع زمان کلاس الزامی است.',
            // 'time_type.in'       => 'نوع زمان کلاس انتخاب شده معتبر نیست.',

            // 'start_time.required_if' => 'در صورت انتخاب زمان دلخواه، وارد کردن زمان شروع الزامی است.',
            // 'start_time.date_format' => 'فرمت زمان شروع معتبر نیست (مثال: 14:30).',

            // 'end_time.required_if' => 'در صورت انتخاب زمان دلخواه، وارد کردن زمان پایان الزامی است.',
            // 'end_time.date_format' => 'فرمت زمان پایان معتبر نیست (مثال: 16:00).',
            // 'end_time.after'       => 'زمان پایان باید بعد از زمان شروع باشد.',
        ];
    }
}
