<?php
namespace App\Http\Classes;

class ModuleValidations{

    private $status;
    private $status_code;
    private $status_msg;

    public function __construct()
    {
        $this->status= false;
        $this->status_code= 201;
        $this->status_msg = '';
    }

    public function getStatus(){
        return $this->status;
    }

    public function getStatusCode(){
        return $this->status_code;
    }

    public function getStatusMsg(){
        return $this->status_msg;
    }

    public function clienteStore($objeto, $post){
        if($objeto->buscarTodos(['id'=>$post['id'],'razon_social'=>$post['razon_social']])->count()>0){
            $this->status= true;
            $this->status_code= 409;
            $this->status_msg= 'Existe un registro de Nombre/Razón social <br><b>"'.$post['razon_social'].'</b>" <br>Verifique la información.';
        }
    }

    public function clienteDocumentoStore($objeto, $post){
        if($objeto->buscarTodos(['id'=>$post['id'],'id_cliente'=>$post['id_cliente'], 'id_documento_adjunto'=>$post['id_documento_adjunto']])->count()>0){
            $this->status= true;
            $this->status_code= 409;
            $this->status_msg= 'Existe un documento adjunto de este tipo<br><br>Verifique la información.';
        }
    }

    public function cuentaUsuarioStore($objeto, $post){
        if($objeto->buscarTodos(['id'=>$post['id'],'id_adm_cliente'=>$post['id_adm_cliente']])->count()>0){
            $this->status= true;
            $this->status_code= 409;
            $this->status_msg= 'Existe una cuenta de usuario para este empleado. <br>Verifique la información.';
        }

        if($objeto->buscarTodos(['id'=>$post['id'],'nickname'=>$post['nickname']])->count()>0){
            $this->status= true;
            $this->status_code= 409;
            $this->status_msg= 'Existe usuario usando el nickname <br><b>"'.$post['nickname'].'</b>" <br>Verifique la información.';
        }
    }

    public function empleadoStore($objeto, $post){
        if($objeto->buscarTodos(['id'=>$post['id'],'nombre'=>$post['nombre'], 'apellido1'=>$post['apellido1'], 'apellido2'=>$post['apellido2']])->count()>0){
            $this->status= true;
            $this->status_code= 409;
            $this->status_msg= 'Existe un registro de nombre <br><b>"'.$post['nombre'].'</b>" <br>Verifique la información.';
        }
    }

    public function municipioStore($objeto, $post){
        if($objeto->buscarTodos(['id'=>$post['id'],'nombre'=>$post['nombre'],'id_estado'=>$post['id_estado']])->count()>0){
            $this->status= true;
            $this->status_code= 409;
            $this->status_msg= 'Existe un registro de nombre <br><b>"'.$post['nombre'].'</b>" en este Estado. <br>Verifique la información.';
        }
    }



}
?>
