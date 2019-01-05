<?php

namespace App\Http\Requests\Helpdesk;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Helpdesk;

/**
 * Class CreateValidator 
 * 
 * @package App\Http\Requests\Helpdesk
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
        return Gate::allows('store', Helpdesk::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'titel'         => ['required', 'string', 'max:191'], 
            'categorie'     => ['required', 'string'],
            'beschrijving'  => ['required', 'string']
        ];
    }
}
