<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoFormReques extends FormRequest
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
            //
            'ID_Cargo'=>'required',
            'PRIMER_NOMBRE'=>'required|max:20',
            'PRIMER_APELLIDO'=>'required|max:20',          
            'NO_INSS'=>'required',
            
            'CEDULA'=>'required',
            'DIRECCION'=>'required|max:100',
            'ESTADO_CIVIL'=>'required|max:20',
            'FECHA_INGRESO'=>'required',
            'Telefono'=>'required',
            'Imagen'=>'mimes:jpeg,bmp,png'
        ];
    }
}
