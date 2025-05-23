<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCVProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod())
        {
            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'state_id'              => 'required',
                    'qualification_id'      => 'required',
                    'graduate_year'         => 'required',
                    'major'                 => 'required',
                    'gender'                => 'required',
                    'faculty'               => 'required',
                ];
        }
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
            'name.required'           => __('user::api.users.validation.name.required'),
        ];

        return $v;
    }
}
