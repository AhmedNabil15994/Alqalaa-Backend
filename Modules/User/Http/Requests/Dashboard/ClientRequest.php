<?php

namespace Modules\User\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'name.*' => 'required',
                    'email' => 'nullable|unique:clients,email',
                    'national_ID' => 'required|unique:clients,national_ID|numeric|digits_between:12,12',
                    'nationality_id' => 'required|exists:nationalities,id',

                    //phones
                    'phones' => 'required|array',
                    'phones.*' => 'required|unique:client_phones,phone|numeric|digits_between:8,8',

                    //address
                    'state_id' => 'required|exists:states,id',
                    'street' => 'required',

                    //attachments
                    'national_id_photo' => 'required|array',
                    'national_id_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                    'contract_photo' => 'nullable|array',
                    'contract_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                    'other_attachments' => 'nullable|array',
                    'other_attachments.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    //general info
                    'name.*' => 'required',
                    'email' => 'nullable|unique:clients,email,'.$this->client.'',
                    'national_ID' => 'required|unique:clients,national_ID,'.$this->client.'',
                    'nationality_id' => 'required|exists:nationalities,id',

                    //phones
                    'phones' => 'required|array',
                    'phones.*' => 'required|unique:client_phones,phone,'.$this->client.',client_id',

                    //address
                    'state_id' => 'required|exists:states,id',
                    'street' => 'required',

                    //attachments
                    'national_id_photo' => 'nullable|array',
                    'national_id_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                    'contract_photo' => 'nullable|array',
                    'contract_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                    'other_attachments' => 'nullable|array',
                    'other_attachments.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
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

//    public function messages()
//    {
//
//    }
}
