<?php

namespace ARsig\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class EstacaoRequest extends FormRequest
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
            'nome'=>'required',
            'host'=>'required',
            'porta'=>'required',
        ];
    }
}
