<?php

namespace Modules\User\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientProfileRequest extends FormRequest
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
                    //general info
                    'user_name' => 'required|unique:clients,user_name,'.$this->client,
                    'password' => 'nullable|confirmed|min:6',
                ];

            //handle updates

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
}
