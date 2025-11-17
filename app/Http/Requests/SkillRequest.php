<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title'             => 'required|string|max:150',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'short_description' => 'nullable|string|max:255',
                // اعتبارسنجی برای آرایه‌ها
                'skill_name'        => 'required|array|min:1',
                'skill_name.*'      => 'required|string|max:100', // هر آیتم در آرایه باید این قوانین را داشته باشد
                'skill_percentage'  => 'required|array|min:1',
                'skill_percentage.*' => 'required|integer|min:0|max:100',
            ];
        } else { // قوانین ویرایش (PUT/PATCH)
            return [
                'title'             => 'sometimes|required|string|max:150',
                'image'             => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'short_description' => 'sometimes|nullable|string|max:255',
                'skill_name'        => 'sometimes|required|array|min:1',
                'skill_name.*'      => 'required|string|max:100',
                'skill_percentage'  => 'sometimes|required|array|min:1',
                'skill_percentage.*' => 'required|integer|min:0|max:100',
            ];
        }
    }
    // پیام‌های خطا را هم می‌توانید برای آرایه‌ها به‌روز کنید
}