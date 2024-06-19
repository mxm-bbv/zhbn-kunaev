<?php

namespace App\Http\Requests\Articles;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.ru' => ['required', 'string'],
            'title.kz' => ['sometimes', 'string'],
            'description' => ['required', 'array'],
            'description.ru' => ['required', 'string'],
            'description.kz' => ['sometimes', 'string'],
            'status' => ['required', 'string'],
        ];
    }
}
