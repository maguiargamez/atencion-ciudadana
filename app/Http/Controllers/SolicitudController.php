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
        $datos= Solicitud::find($id);
        $denuncias= Solicitud::buscarTodos([])->limit(5)->get();
        $status= \App\Models\Catalogos\Status::find($datos->id_status);
        $servicio= \App\Models\Catalogos\TipoServicio::find($datos->id_tipo_servicio);
        $datos['status']= $status->nombre;
        $datos['servicio']= $servicio->nombre;
        $datos['adjuntos']= json_decode($datos['adjuntos']);
        //dd($datos['adjuntos']);
        return view('frontend.show', compact('datos', 'denuncias'));
    }

    public function createFrontend()
    {

        $servicios= \App\Models\Catalogos\TipoServicio::comboActivos();
        //dd($datos['adjuntos']);
        return view('frontend.create', compact('servicios'));
    }

    public function storeFrontend(\App\Http\Requests\StoreSolicitudRequest $request)
    {
        $validation = new ModuleValidations;
        $status= 1; $code= 201;
        $post = $request->all();
        //$validation->cuentaUsuarioStore(new User, ['id'=> 0, 'id_adm_cliente'=>$post['id_adm_cliente'], 'nickname'=>$post['nickname']]);
        if(!$validation->getStatus()){
            try{
                DB::beginTransaction();
                $datos= new Solicitud;

                $post['id_status']= 1;
                $post['id_tipo_solicitud']= 1;
                $post['id_prioridad']= 2;
                $post['id_canal_acceso']= 3;
                $post['codigo_rastreo']= Str::random(8);
                $path= public_path().'/img/solicitudes';
                $adjuntos= [];

                if($request->hasFile('adj1')) {
                    if ($request->file('adj1')->isValid()) {
                        $file= $request->adj1;
                        $extension= $file->extension();
                        $fileName = Str::random(20).'_'.time().'.'.$extension;
                        $file->move($path, $fileName);
                        array_push($adjuntos, $fileName);
                    }
                }

                if($request->hasFile('adj2')) {
                    if ($request->file('adj2')->isValid()) {
                        $file= $request->adj2;
                        $extension= $file->extension();
                        $fileName = Str::random(20).'_'.time().'.'.$extension;
                        $file->move($path, $fileName);
                        array_push($adjuntos, $fileName);
                    }
                }

                if($request->hasFile('adj3')) {
                    if ($request->file('adj3')->isValid()) {
                        $file= $request->adj3;
                        $extension= $file->extension();
                        $fileName = Str::random(20).'_'.time().'.'.$extension;
                        $file->move($path, $fileName);
                        array_push($adjuntos, $fileName);
                    }
                }

                $post['adjuntos']= json_encode($adjuntos);
                $datos->fill($post)->save();
                DB::commit();
                $msg= "La información ha sido registrada"; $route_redirect= route('solicitudes.create-frontend'); $data= $datos;
            }catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();
            }
        }else{
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }


}
