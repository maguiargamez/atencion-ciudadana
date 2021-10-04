<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class AdmCliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'adm_clientes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function comboActivos($array=[]){
        $query= AdmCliente::select('adm_clientes.id', 'adm_clientes.nombre', 'adm_clientes.deleted_at', 'u.id_adm_cliente');
        $query= $query->leftJoin('users as u', 'u.id_adm_cliente', '=', 'adm_clientes.id');

        $query= $query->where('adm_clientes.activo', 1);
        if(array_key_exists('sin_cuenta', $array)){
            //if($array['id_estado']!=0){
                $query= $query->whereNull('u.id_adm_cliente');
            //}
        }

        $query= $query->orderBy('nombre','ASC')->pluck('nombre','id')->prepend('--AdmCliente--', "")->all();
        return $query;
    }


    public static function buscarTodos($array=[]){
        $query=  AdmCliente::select('*');

        if(array_key_exists('nombre', $array)){
            $filtro= $array["nombre"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('nombre','=', $filtro);
            });
        }

        if(array_key_exists('id', $array)){
            $value= $array["id"];
            $query= $query->where( function($sql) use ($value){
                $sql->where('id','!=', $value);
            });
        }
        $query= $query->orderBy('nombre','DESC');
        return $query;
    }
}
