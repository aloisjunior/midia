<?php

namespace ARsig\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'permission_title'=>'required',
            'permission_slug'=>'required',
            'permission_description'=>'required',
            'ativo'=>'required'
        ];
    }
}
