<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_solicitudes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function comboActivos($array=[]){
        $query= Solicitud::select('id', 'nombre', 'deleted_at')->where('activo',1);
        $query= $query->orderBy('nombre','ASC')->pluck('nombre','id')->prepend('--Cargo--', 0)->all();
        return $query;
    }

    public static function buscarTodos($array=[]){
        $query= Solicitud::select(
            't_solicitudes.id',
            't_solicitudes.folio',
            't_solicitudes.descripcion_reporte',
            't_solicitudes.latitud',
            't_solicitudes.longitud',
            'ts.nombre as tipo_servicio',
            't_solicitudes.adjuntos',
            'stat.nombre as status'
        );

        $query= $query->join('c_tipos_servicios as ts', 'ts.id', '=', 't_solicitudes.id_tipo_servicio');
        $query= $query->join('c_status as stat', 'stat.id', '=', 't_solicitudes.id_status');

        if(array_key_exists('isFolio', $array)){
            $query= $query->whereNotNull('t_solicitudes.folio');
        }
        if(array_key_exists('id_status', $array)){
            $filtro= $array["id_status"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->whereIn('t_solicitudes.id_status', $filtro);
            });
        }

        if(array_key_exists('id_tipo_servicio', $array)){
            $filtro= $array["id_tipo_servicio"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('t_solicitudes.id_tipo_servicio', $filtro);
            });
        }

        if(array_key_exists('nombre', $array)){
            $filtro= $array["nombre"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('t_solicitudes.nombre','like', '%'.$filtro.'%');
            });
        }
        if(array_key_exists('id', $array)){
            $value= $array["id"];
            $query= $query->where( function($sql) use ($value){
                $sql->where('t_solicitudes.id','!=', $value);
            });
        }
        $query= $query->orderBy('t_solicitudes.created_at','DESC');
        return $query;
    }
}
