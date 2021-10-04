<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    protected $table = 'users';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function buscarTodos($array=[]){
        $query=  User::select('users.id', 'users.name', 'users.nickname', 'users.activo', 'r.name as rol', 'c.nombre as cliente');
        $query= $query->join('adm_clientes as c', 'c.id', '=', 'users.id_adm_cliente');
        $query= $query->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id');
        $query= $query->join('roles as r', 'r.id', '=', 'mr.role_id');

        if(array_key_exists('id_adm_cliente', $array)){
            $filtro= $array["id_adm_cliente"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('users.id_adm_cliente','=', $filtro);
            });
        }

        if(array_key_exists('nickname', $array)){
            $filtro= $array["nickname"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('users.nickname','=', $filtro);
            });
        }

        if(array_key_exists('id_cargo', $array)){
            $filtro= $array["id_cargo"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('e.id_cargo','=', $filtro);
            });
        }

        if(array_key_exists('cliente', $array)){
            $filtro= $array["cliente"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('cliente','like', '%'.$filtro.'%');
            });
        }

        if(array_key_exists('id', $array)){
            $value= $array["id"];
            $query= $query->where( function($sql) use ($value){
                $sql->where('users.id','!=', $value);
            });
        }
        $query= $query->orderBy('cliente','DESC');
        return $query;
    }
}
