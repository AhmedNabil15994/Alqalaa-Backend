<?php

namespace Modules\Installment\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Installment\Repositories\Client\InstallmentRepository;

class InstallmentRequest extends FormRequest
{
    private $repository;
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        $this->repository = new InstallmentRepository;
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $installment = $this->repository->findById($this->id);

        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                    ''
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'pay_now' => 'required|numeric|min:0|max:' . ($installment->remaining),
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
