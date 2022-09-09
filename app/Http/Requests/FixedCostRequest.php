<?php

// Controller namespacing.
namespace App\Http\Requests;

// Other.
use Illuminate\Foundation\Http\FormRequest;

class FixedCostRequest extends FormRequest
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
            'bankaccount_id'        => 'required|numeric|min:1',
            'category_id'           => 'required|numeric|min:1',
            'company_id'            => 'required|numeric|min:1',
            'cost'                  => 'required|between:0,9999999.99',
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
            'cost'           => (float) $this->cost,
        ]);
    }
}
