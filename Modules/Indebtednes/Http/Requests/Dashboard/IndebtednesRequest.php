<?php

namespace Modules\Indebtednes\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndebtednesRequest extends FormRequest
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

                if ($this->request->all()['client_type'] == 'create') {

                    $response = [
                        //client
                        'client_type' => 'required|in:chose,create',

                        //general info
                        'name.*' => 'required_if:client_type,create',
                        'email' => 'nullable|unique:clients,email',
                        'national_ID' => 'required_if:client_type,create|unique:clients,national_ID|numeric|digits_between:12,12',
                        'nationality_id' => 'required_if:client_type,create',

                        //phones
                        'phones' => 'required_if:client_type,create|array',
                        'phones.*' => 'required_if:client_type,create|unique:client_phones,phone|numeric|digits_between:8,8',

                        //address
                        'state_id' => 'required_if:client_type,create',
                        'street' => 'required_if:client_type,create',

                        //attachments
                        'national_id_photo' => 'nullable|array',
                        'national_id_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                        'contract_photo' => 'nullable|array',
                        'contract_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                        //////////////////////////

                        'price' => 'required|numeric|min:0',
                    ];
                } else {

                    $response = [
                        //client
                        'client_type' => 'required|in:chose,create',
                        'client_id' => ['required', Rule::exists('clients', 'id')->where('is_judging', '0')],
                        'price' => 'required|numeric|min:0',
                    ];
                }
                return $response;

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'client_id' => ['required', Rule::exists('clients', 'id')->where('is_judging', '0')],
                    'price' => 'required|numeric|min:0',
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
            'client_id.exists' => __('user::dashboard.clients.validation.client_id.exists'),
        ];

        return $v;
    }
}
