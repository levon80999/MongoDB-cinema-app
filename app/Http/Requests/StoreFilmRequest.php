<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'date' => ['required', 'date'],
            'image' => ['required', 'image'],
            'producer_id' => ['required', 'string'],
            'actors' => ['required', 'array'],
            'comingSoon' => ['boolean'],
            'best' => ['boolean'],
            'description' => ['required', 'string', 'max:1000'],
        ];
    }
}
