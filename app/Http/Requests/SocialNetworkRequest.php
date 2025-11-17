<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialNetworkRequest extends FormRequest
{
   /**
     * تعیین اینکه آیا کاربر مجاز به انجام این درخواست است یا خیر.
     */
    public function authorize(): bool
    {
        // در اینجا می‌توانید منطق مربوط به مجوز دسترسی کاربر را پیاده‌سازی کنید.
        // برای سادگی، فعلاً true برمی‌گردانیم.
        return true;
    }

    /**
     * دریافت قوانین اعتبارسنجی که برای این درخواست اعمال می‌شوند.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            // قوانین برای حالت ایجاد (POST)
            return [
                'name'    => 'required|string|max:100|unique:social_networks,name',
                'link'    => 'required|url|max:255',
                'icon_id' => 'required|integer|exists:icons,id',
                'status'  => 'required|boolean',
            ];
        } else {
            // قوانین برای حالت ویرایش (PUT/PATCH)
            return [
                'name'    => ['sometimes', 'required', 'string', 'max:100', Rule::unique('social_networks')->ignore($this->route('social_network'))],
                'link'    => 'sometimes|required|url|max:255',
                'icon_id' => 'sometimes|required|integer|exists:icons,id',
                'status'  => 'sometimes|required|boolean',
            ];
        }
    }

    /**
     * پیام‌های خطای سفارشی برای هر قانون اعتبارسنجی.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'نام شبکه اجتماعی الزامی است.',
            'name.string'   => 'نام شبکه اجتماعی باید یک رشته متنی باشد.',
            'name.max'      => 'نام شبکه اجتماعی نباید بیشتر از ۱۰۰ کاراکتر باشد.',
            'name.unique'   => 'این شبکه اجتماعی قبلاً ثبت شده است.',

            'link.required' => 'لینک شبکه اجتماعی الزامی است.',
            'link.url'      => 'فرمت لینک وارد شده معتبر نیست. (مثال: https://example.com)',
            'link.max'      => 'لینک نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'icon_id.required' => 'انتخاب آیکن الزامی است.',
            'icon_id.integer'  => 'شناسه آیکن باید یک عدد صحیح باشد.',
            'icon_id.exists'   => 'آیکن انتخاب شده معتبر نیست.',

            'status.required' => 'وضعیت الزامی است.',
            'status.boolean'  => 'مقدار وضعیت باید به صورت فعال یا غیرفعال مشخص شود.',
        ];
    }
}
