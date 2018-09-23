<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Lista_negraFormReques extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //           
                'MOTIVO'=>'required|max:500',
                'FECHA'=>'required',
                'NOMBRE_AUTORIZACION'=>'required|max:50'
                //
            
        ];
    }
}
