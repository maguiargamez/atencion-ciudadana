<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoZero;

class StoreCuentaUsuarioRequest extends FormRequest
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
        $id = $this->input('id');
        if (isset($id)) {
            $id = $id;
        } else {
            $id = 0;
        }

        if ($id == 0) {
            $arr = [
                'id_adm_cliente' => ['required', new NoZero],
                'id_rol' => ['required', new NoZero],
                'nickname' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed|min:6'
            ];
        } else {
            $arr = [
                'id_adm_cliente' => ['required', new NoZero],
                'id_rol' => ['required', new NoZero],
                'nickname' => 'required',
                'email' => 'required',
            ];
        }
        return $arr;
    }
}
