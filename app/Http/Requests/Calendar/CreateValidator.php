<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateValidator
 *
 * @package App\Http\Requests\Calendar
 */
class CreateValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->hasAnyRole(['leiding', 'admin', 'webmaster']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "start_datum"       => ['required', 'date', 'date_format:Y-m-d', 'after:yesterday'],
            "eind_datum"        => ['required', 'date', 'date_format:Y-m-d'],
            "aantal_personen"   => ['required', 'integer'],
            "status"            => ['required', 'string'],
            "voornaam"          => ['required', 'string'],
            "achternaam"        => ['required', 'string'],
            "email"             => ['required', 'string', 'email', 'max:255'],
        ];
    }
}
