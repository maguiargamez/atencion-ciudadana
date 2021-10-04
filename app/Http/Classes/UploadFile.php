<?php
namespace App\Http\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UploadFile{


    public function __construct()
    {

    }

    public function uploadFile($array){

        $id=0;
        try {
            DB::beginTransaction();
            $datos= new \App\Models\TramiteArchivo;

            $post['id_tramite']= $array['id_tramite'];
            $post['id_area']= $array['id_area'];
            $post['id_usuario']= Auth::User()->id;
            $post['id_tipo_archivo']= $array['id_tipo_archivo'];
            $post['nombre']= $array['fileName'];
            $post['path']=  $array['path'];
            $post['peso']= $array['size'];
            $post['extension']= $array['extension'];

            $datos->fill($post)->save();
            $id= $datos->id;
            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error];
            return $id;
            //return response()->json($message, 409);
        }
        return $id;
    }

    public function deleteFile($id){
        try {
            DB::beginTransaction();
            $datos= \App\Models\TramiteArchivo::find($id);
            $datos->delete();
            DB::commit();
            $msg= "El registro ha sido eliminado"; $route_redirect= route($this->route.'.index'); $data= $datos;
        } catch (\Throwable $th) {
            return 0;
        }
        return 1;
    }

    public function uploadFileCertificacion($array){

        $id=0;
        try {
            DB::beginTransaction();
            $datos3= new \App\Models\Certificacion_Archivo;

            $post['id_certificacion']= $array['id_certificacion'];
            $post['id_usuario']= Auth::User()->id;
            $post['id_tipo_archivo']= $array['id_tipo_archivo'];
            $post['documento']= $array['documento'];
            $post['nombre']= $array['nombre'];
            $post['path']=  $array['path'];
            $post['peso']= $array['peso'];
            $post['extension']= $array['extension'];

            $datos3->fill($post)->save();

            $id= $datos3->id;

            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error];
            return $id;
            //return response()->json($message, 409);
        }
        return $id;
    }

    public function deleteFileCertificacion($id){
        try {
            DB::beginTransaction();
            $datos= \App\Models\Certificacion_Archivo::find($id);
            $datos->delete();
            DB::commit();
            $msg= "El registro ha sido eliminado"; $route_redirect= route($this->route.'.index'); $data= $datos;
        } catch (\Throwable $th) {
            return 0;
        }
        return 1;
    }


}
?>
