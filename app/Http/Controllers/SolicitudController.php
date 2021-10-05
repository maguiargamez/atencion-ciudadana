<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Http\Classes\ModuleValidations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Hash;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $route = 'solicitudes';

    public function __construct()
    {
        //$this->middleware('auth');
        view()->share('title', '<i class="fal fa-lock-alt"></i> Solicitudes');
        view()->share('title_description', 'Solicitudes');
        view()->share('current_route', $this->route);
    }

    public function getAllFrontend(Request $request)
    {
        $post = $request->all();
        $data= ['isFolio'=>1];
        if(isset($post['id_tipo_servicio'])){
            if($post['id_tipo_servicio']!=0){
            $data= ['isFolio'=>1, 'id_tipo_servicio'=>$post['id_tipo_servicio']];
            }
        }
        $result= Solicitud::buscarTodos($data)->get();
        return $result;
    }

    public function showFrontend($id)
    {
        $datos= Solicitud::edit($id)->get();
        return view('detalle', []);
    }


}
