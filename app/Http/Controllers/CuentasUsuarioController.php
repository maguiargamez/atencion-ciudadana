<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Classes\ModuleValidations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Hash;

class CuentasUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $route = 'cuentas-usuario';

    public function __construct()
    {
        //$this->middleware('auth');
        view()->share('title', '<i class="fal fa-lock-alt"></i> Cuentas de usuario');
        view()->share('title_description', 'Cuentas de usuario');
        view()->share('current_route', $this->route);
    }

    public function index()
    {
        //Cliente::latest()->paginate(2);
        return view('modulos.configuracion.cuentas-usuario.index', []);
    }

    public function getAll()
    {
        $result= User::buscarTodos()->get();
        return $result;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = \App\Models\Admcliente::comboActivos(['sin_cuenta'=>1]); //Sin cuenta
        $roles = \App\Models\Roles::comboActivos();
        return view('modulos.configuracion.cuentas-usuario.create', ['clientes' => $clientes, 'roles' => $roles]);
    }

    public function store(\App\Http\Requests\StoreCuentaUsuarioRequest $request)
    {
        $validation = new ModuleValidations;
        $status= 1; $code= 201;
        $post = $request->all();
        $validation->cuentaUsuarioStore(new User, ['id'=> 0, 'id_adm_cliente'=>$post['id_adm_cliente'], 'nickname'=>$post['nickname']]);
        if(!$validation->getStatus()){
            try{
                DB::beginTransaction();
                $rol= \App\Models\Roles::find($post['id_rol']);
                $cliente= \App\Models\AdmCliente::find($post['id_adm_cliente']);
                $datos= new User;
                $post['password']= Hash::make($post['password']);
                $post['name']= $cliente->nombre;
                $datos->fill($post)->save();
                $datos->assignRole($rol->name);
                DB::commit();
                $msg= "La información ha sido registrada"; $route_redirect= route($this->route.'.index'); $data= $datos;
            }catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();
            }
        }else{
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }

    public function edit($id)
    {
        $datos= User::find($id);
        $clientes = \App\Models\Admcliente::comboActivos([]); //Sin cuenta
        $roles = \App\Models\Roles::comboActivos();
        $datos['id_rol']= \App\Models\RoleModel::select('role_id')->where('model_id', $datos->id)->first()->role_id;
        //print_r($datos['id_rol']); exit();
        return view('modulos.configuracion.cuentas-usuario.edit', ['datos'=>$datos,'clientes' => $clientes, 'roles' => $roles]);
    }

    public function update(\App\Http\Requests\StoreCuentaUsuarioRequest $request, $id)
    {
        $validation = new ModuleValidations;
        $status= 1; $code= 201;
        $post = $request->all();
        $validation->cuentaUsuarioStore(new User, ['id'=> $post['id'], 'id_adm_cliente'=>$post['id_adm_cliente'], 'nickname'=>$post['nickname']]);
        if(!$validation->getStatus()){
            try{
                DB::beginTransaction();
                $datos= User::find($id);
                $cliente= \App\Models\AdmCliente::find($post['id_adm_cliente']);
                $rol= \App\Models\Roles::find($post['id_rol']);
                $post['name']= $cliente->nombre;
                $datos->fill($post)->save();
                $datos->syncRoles($rol->name);
                DB::commit();
                $msg= "La información ha sido actualizada"; $route_redirect= route($this->route.'.index'); $data= $datos;
            }catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();
            }
        }else{
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }

    public function cambiarContrasenia($id)
    {
        $datos= User::find($id);
        $clientes = \App\Models\Admcliente::comboActivos([]); //Sin cuenta
        return view('modulos.configuracion.cuentas-usuario.change', ['datos'=>$datos,'clientes' => $clientes]);
    }

    public function updatePassword(\App\Http\Requests\UsuariosPasswordRequest $request, $id)
    {
        $validation = new ModuleValidations;
        $status= 1; $code= 201;
        $post = $request->all();
        //$validation->cuentaUsuarioStore(new User, ['id'=> $post['id'], 'id_empleado'=>$post['id_empleado'], 'nickname'=>$post['nickname']]);
        if(!$validation->getStatus()){
            try{
                DB::beginTransaction();
                $datos= User::find($id);
                $post['password']= Hash::make($post['password']);
                $datos->fill($post)->save();
                DB::commit();
                $msg= "La contraseña ha sido actualizada"; $route_redirect= route($this->route.'.index'); $data= $datos;
            }catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();
            }
        }else{
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }

    public function destroy($id)
    {
        $status= 1; $code= 201;
        try {
            DB::beginTransaction();
            $datos= User::find($id);
            $datos->delete();
            DB::commit();
            $msg= "El registro ha sido eliminado"; $route_redirect= route($this->route.'.index'); $data= $datos;
        } catch (\Throwable $th) {
            //throw $th;
            $status= 3; $code= 409; $msg= $th->getMessage(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }


}
