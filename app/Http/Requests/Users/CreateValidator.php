<?php

namespace App\Http\Requests\Users;

use Gate;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateValidator
 *
 * @package App\Http\Requests\Users
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
        return Gate::allows('store', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'  => ['required', 'string', 'exists:roles,name'],
        ];
    }
}
