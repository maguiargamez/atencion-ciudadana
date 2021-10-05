<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Http\Classes\ModuleValidations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Hash;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $route = 'welcome';

    public function __construct()
    {
        view()->share('current_route', $this->route);
    }

    public function index()
    {
        $tipos_servicios= \App\Models\Catalogos\TipoServicio::comboActivos();
        return view('welcome', ['tipos_servicios'=>$tipos_servicios]);
    }




}
