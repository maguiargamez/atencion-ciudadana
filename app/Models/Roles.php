<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $table = 'roles';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function comboActivos($array=[]){
        $query= Roles::select('id', 'nombre');
        $query= $query->orderBy('nombre','ASC')->pluck('nombre','id')->prepend('--Rol--', "")->all();
        return $query;
    }



}
