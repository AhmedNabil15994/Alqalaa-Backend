<?php

namespace Modules\Contract\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MonthPercentageRequest extends FormRequest
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
                    'month_number' => 'required|unique:month_percentages,month_number|min:0',
                    'presentage' => 'required|min:0',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'month_number' => 'required|unique:month_percentages,month_number,'.$this->id.'|min:0',
                    'presentage' => 'required|min:0',
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
