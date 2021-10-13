<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudSeguimiento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_solicitudes_seguimientos';
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public static function buscarTodos($array=[]){
        $query= SolicitudSeguimiento::select('*');


        if(array_key_exists('id_solicitud', $array)){
            $filtro= $array["id_solicitud"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('id_solicitud', $filtro);
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
