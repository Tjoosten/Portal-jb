<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NoteValidator
 *
 * @package App\Http\Requests\Calendar
 */
class NoteValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Authorizatie return is gewoon een true omdat de authorizatie checks
        // Als gebeurd op controller niveau waardoor het hier een beetje onnodig zijkt.

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
            //
        ];
    }
}
