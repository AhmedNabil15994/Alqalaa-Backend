<?php

namespace Modules\Contract\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $maxPrice = setting('contract','max_price') ?? null;
        $minPrice = setting('contract','min_price') ?? 0;

        $priceValidation = "required|numeric|min:$minPrice". ($maxPrice ? "|max:$maxPrice" : "");

        $maxTransactionDate = (now()->addDays(60)->format('Y-m-d'));

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

                        //address
                        'state_id' => 'required_if:client_type,create',
                        'street' => 'required_if:client_type,create',

                        //phones
                        'phones' => 'required_if:client_type,create|array',
                        'phones.*' => 'required_if:client_type,create|unique:client_phones,phone|numeric|digits_between:8,8',

                        //attachments
                        'national_id_photo' => 'nullable|array',
                        'national_id_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                        'contract_photo' => 'nullable|array',
                        'contract_photo.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:3048',

                        //////////////////////////

                        'transaction_date' => ['required', 'date', 'before:'.$maxTransactionDate],
                        'down_payment' => 'required|numeric|min:0|lt:price',
                        'price' => $priceValidation,
                    ];
                } else {

                    $response = [
                        //client
                        'client_type' => 'required|in:chose,create',
                        'client_id' => ['required', Rule::exists('clients', 'id')->where('is_judging', '0')],

                        'transaction_date' => ['required', 'date', 'before:'.$maxTransactionDate],
                        'down_payment' => 'required|numeric|min:0|lt:price',
                        'price' => $priceValidation,
                    ];
                }

                if (auth()->user()->can('edit_contract_percentages')) {
                    $response['installment_fees'] = 'required|numeric|min:0';
                    $response['months_num'] = 'required|numeric|min:0';
                } else {

                    $response['month_percentage_id'] = 'required|exists:month_percentages,id';
                }

                return $response;

            //handle updates
            case 'put':
            case 'PUT':
                $response = [
                    'client_id' => ['required', Rule::exists('clients', 'id')->where('is_judging', '0')],
                    'transaction_date' => ['required', 'date', 'before:'.$maxTransactionDate],
                    'down_payment' => 'required|numeric|min:0',
                    'price' => $priceValidation,
                ];

                if (auth()->user()->can('edit_contract_percentages')) {
                    $response['installment_fees'] = 'required|numeric|min:0';
                    $response['months_num'] = 'required|numeric|min:0';
                } else {

                    $response['month_percentage_id'] = 'required|exists:month_percentages,id';
                }

                return $response;
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
