<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // در این مرحله، منطق احراز هویت را به Policy واگذار می‌کنیم.
        // فعلاً true برمی‌گردانیم تا اعتبارسنجی انجام شود.
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
            'name'      => ['required', 'string', 'max:255'],
            'type'      => ['required', 'string', 'max:255'],
            'link'      => ['required', 'string', 'max:255'],
            'position'  => ['required', 'integer', 'min:0'],
            'status'    => ['required', 'boolean'],
            'parent_id' => ['nullable', 'integer', 'exists:menus,id'],
        ];
    }





  public function messages(): array
    {
        return [
            'name.required'      => 'وارد کردن نام منو الزامی است.',
            'name.max'           => 'نام منو نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'type.required'      => 'انتخاب نوع منو الزامی است.',
            'link.required'      => 'وارد کردن لینک منو الزامی است.',
            'position.required'  => 'تعیین موقعیت منو الزامی است.',
            'position.integer'   => 'موقعیت باید یک عدد صحیح باشد.',
            'status.required'    => 'تعیین وضعیت منو الزامی است.',
            'status.boolean'     => 'مقدار وضعیت نامعتبر است.',
            'parent_id.integer'  => 'شناسه والد باید یک عدد باشد.',
            'parent_id.exists'   => 'منوی والد انتخاب شده معتبر نیست.',
        ];
    }



}