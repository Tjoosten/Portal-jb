<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BillableValidator
 *
 * @package App\Http\Requests\Tenants
 */
class BillableValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(['leiding', 'admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'voornaam'      => ['required', 'string', 'max:191'],
            'achternaam'    => ['required', 'string', 'max:191'],
            'email'         => ['required', 'string', 'max:191'],
            'postcode'      => ['required', 'integer', 'max:30'],
            'stad'          => ['required', 'string', 'max:191'],
            'land'          => ['required', 'string', 'max:191'],
            'adres'         => ['required', 'string', 'max:191']
        ];
    }
}
