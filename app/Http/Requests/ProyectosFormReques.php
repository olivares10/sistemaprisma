<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectosFormReques extends FormRequest
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
            'NOMBRE_PROYECTO'=>'required|max:100',
            'DESCRIPCION'=>'required|max:100',
            'FECHA_INICIO'=>'required',
            
            //
        ];
    }
}
