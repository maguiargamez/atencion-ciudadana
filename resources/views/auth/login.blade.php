@extends('layouts.app-login')

@section('content')
<?php
    //$documentos_notaria= json_encode(array_values(\App\Models\Catalogo\Requisito::select('id')->whereIn('id_proporciona', [1,3])->inRandomOrder()->pluck('id')->take(4)->all()));

    //print_r($documentos_notaria);exit();
    /*$fecha= \App\Http\Classes\DateFormat::fecha_aleatoria("Y-m-d", "2020-01-01", "2021-12-01");
    $anio= explode('-', $fecha)[0];
    print_r($fecha.' - '.$anio);exit();*/
?>

<div class="blankpage-form-field">
    <div
        class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
            <span class="page-logo-text mr-1">Atención ciudadana</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        {!! Form::open(['url' => 'login', 'method' => 'POST']) !!}
            <div class="form-group">
                <label class="form-label" for="nickname">Usuario</label>
                {!! Form::text('nickname', old('nickname'),['id'=>'nickname', 'placeholder'=>'Escriba su nombre de usuario...', 'required'=>'true', 'class'=>'form-control']) !!}
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Contraseña</label>
                {!! Form::password('password', ['id'=>'password', 'placeholder'=>'Escriba su contraseña...', 'required'=>'true', 'class'=>'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-default float-right">Ingresar</button>
        {!! Form::close() !!}
    </div>
    <div class="blankpage-footer text-center">
        <a href="#"><strong>Recuperar contraseña</strong></a>
    </div>
</div>

@endsection
