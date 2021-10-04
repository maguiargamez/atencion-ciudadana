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

    public function getAllFrontend()
    {
        $result= Solicitud::buscarTodos(['isFolio'=>1])->get();
        return $result;
    }




}
