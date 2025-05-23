<?php

namespace Modules\Casee\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CaseActionRequest extends FormRequest
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
            // handle creates
            case 'post':
            case 'POST':

                return [
                    'client_id' => 'required|exists:clients,id',
                    'description' => 'required',
                    'price' => 'nullable|min:1'
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [

                    'client_id' => 'required|exists:clients,id',
                    'description' => 'required',
                    'price' => 'nullable|min:1'
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
}
