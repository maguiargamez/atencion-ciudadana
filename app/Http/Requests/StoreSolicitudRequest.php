<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoZero;

class StoreSolicitudRequest extends FormRequest
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
        $arr = [
            //'folio' => 'required',
            'nombre' => 'required',
            'apellido1' => 'required',
            'apellido2' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'id_tipo_servicio' => ['required', new NoZero],
            'colonia' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'descripcion_reporte' => 'required',
        ];
        return $arr;
    }
}
