<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TipoServicio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'c_tipos_servicios';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function comboActivos($array=[]){
        $query= TipoServicio::select('id', 'nombre', 'deleted_at')->where('activo',1);
        $query= $query->orderBy('nombre','ASC')->pluck('nombre','id')->prepend('--Servicio--', 0)->all();
        return $query;
    }

    public static function buscarTodos($array=[]){
        $query= TipoServicio::select('*');
        if(array_key_exists('nombre', $array)){
            $filtro= $array["nombre"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('nombre','like', '%'.$filtro.'%');
            });
        }
        if(array_key_exists('id', $array)){
            $value= $array["id"];
            $query= $query->where( function($sql) use ($value){
                $sql->where('id','!=', $value);
            });
        }
        $query= $query->orderBy('created_at','DESC');
        return $query;
    }
}
