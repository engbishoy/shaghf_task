<?php

namespace Modules\Provider\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ['required', 'string'],
            "email" => ['required','email',Rule::unique('providers','email')->ignore($this->provider)],
            "password" => ['nullable', 'min:8'],
            "user_name" => ['required',Rule::unique('providers','user_name')->ignore($this->provider)]
        
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
