<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Rules\AvailableForBook;
use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
        $hallId = $this->input('hall_id') ?? '';

        return [
            'film_id' => ['required', 'string'],
            'hall_id' => ['required', 'string'],
            'start_date' => ['required', new AvailableForBook($hallId)],
            'end_date' => ['required',  new AvailableForBook($hallId)],
        ];
    }
}
