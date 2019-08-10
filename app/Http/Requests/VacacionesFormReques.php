<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacacionesFormReques extends FormRequest
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
            'ID_EMPLEADO'=>'required',
           // 'FECHA_SOLICITUD'=>'required',
            'FECHA_INICIO'=>'required',
            'FECHA_FIN'=>'required',
            'NUMERO_DIAS'=>'required'         
        ];
    }
}
