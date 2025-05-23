<?php

namespace Modules\Authentication\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':
                return [
                    'user_name' => ['required', Rule::exists('clients', 'user_name')->where('is_judging', '0')],
                    'password' => 'required|min:6',
                ];
        }
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

    public function messages()
    {
        $v = [
            'user_name.exists' => __('user::client.clients.validation.user_name.exists'),
        ];

        return $v;
    }
}
