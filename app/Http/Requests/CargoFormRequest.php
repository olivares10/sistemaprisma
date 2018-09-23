<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoFormRequest extends FormRequest
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
            'Nombre_Cargo'=>'required|max:20',
            'Descripcion'=>'required|max:100',
            'Salario_Base'=>'required',
            'ID_Area'=>'required'
            //
        ];
    }
}
