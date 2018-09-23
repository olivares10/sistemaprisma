<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidacionFormReques extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ID_Empleado'=>'required',
            'ID_Causa'=>'required',
            'Dias_vacaciones'=>'required',
            'Frecuencia_P'=>'required|max:60',
            'Fecha_Inicio'=>'required',
            'Fecha_Salida'=>'required',
            'Salario_1'=>'required'
            //
        ];
    }
}
