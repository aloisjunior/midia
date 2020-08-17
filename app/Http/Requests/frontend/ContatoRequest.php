<?php

namespace ARsig\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
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
            'email'=>'required|email',
            'telefone'=>'required',
            'empresa'=>'required',
            'cargo'=>'required',
            'assunto'=>'required',
            'mensagem'=>'required',

        ];
    }
}
