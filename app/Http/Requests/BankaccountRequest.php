<?php

// Controller namespacing.
namespace App\Http\Requests;

// Other.
use Illuminate\Foundation\Http\FormRequest;

class BankaccountRequest extends FormRequest
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
            'name'                  => 'required|string|max:255|',
            'accountnumber'         => 'required|string|max:255|unique:bankaccounts,accountnumber'  . (@$this->bankaccount->id ? ',' . $this->bankaccount->id : null),
            'bankaccount_type_id'   => 'required|numeric|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'accountnumber.unique' => 'Dit rekeningnummer bestaat al.',
        ];
    }
}
