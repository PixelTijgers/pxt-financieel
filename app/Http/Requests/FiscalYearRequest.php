<?php

// Controller namespacing.
namespace App\Http\Requests;

// Other.
use Illuminate\Foundation\Http\FormRequest;

class FiscalYearRequest extends FormRequest
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
            'year' => 'required|integer|digits:4|unique:fiscal_years,year'  . (@$this->fiscal_year->id ? ',' . $this->fiscal_year->id : null),
            'name'  => 'required|string|max:255|unique:fiscal_years,name'  . (@$this->fiscal_year->id ? ',' . $this->fiscal_year->id : null),
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
            'name.fiscal_year' => 'Dit financieel jaar bestaat al.',
            'name.unique' => 'Er is al een financieel jaar met deze naam.',
        ];
    }
}
