<?php

// Controller namespacing.
namespace App\Http\Requests;

// Other.
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'           => 'required|numeric|min:1',
            'payment_type_id'       => 'required|numeric|min:1',
            'company_id'            => 'required|numeric|min:1',
            'balance'               => 'required|between:0,9999999.99',
            'payment_reference'     => 'required|string|max:255',
            'payment_date'          => 'required|string|max:255',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Merge into request.
        $this->merge([
            'balance'           => (float)$this->balance,
            'payment_date'      => \Carbon\Carbon::createFromFormat('d-m-Y', $this->payment_date)->toDateTimeString(),
        ]);
    }
}
