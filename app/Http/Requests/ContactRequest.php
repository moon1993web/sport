<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            // 🟩 قوانین اعتبارسنجی
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['nullable', 'email', 'max:255'], // اختیاری ولی اگر بود، فرمت ایمیل صحیح
            'mobile'  => ['required', 'string', 'max:20'], // می‌تونی regex:/(09)[0-9]{9}/ هم بذاری
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ];
    }



  public function attributes(): array
    {
        return [
            'name'    => 'نام',
            'email'   => 'ایمیل',
            'mobile'  => 'شماره موبایل',
            'subject' => 'موضوع پیام',
            'message' => 'متن پیام',
        ];
    }



    public function messages(): array
    {
        return [
            'required' => 'لطفاً فیلد :attribute را وارد کنید.',
            'string'   => 'فیلد :attribute باید شامل متن باشد.',
            'max'      => 'فیلد :attribute نباید بیشتر از :max کاراکتر باشد.',
            'email'    => 'لطفاً یک آدرس ایمیل معتبر وارد کنید.',
            'numeric'  => 'فیلد :attribute باید عدد باشد.',
        ];
    }



}
