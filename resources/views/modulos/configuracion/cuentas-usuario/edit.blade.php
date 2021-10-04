@extends('layouts.app')

@section('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('js/modulos/cuentas-usuario.js') }}"></script>
@endsection

@section('script')
    tipo_persona(<?php echo $datos->id_tipo_persona; ?>)
    documentacion_adjunta(<?php echo $datos->id; ?>)
@endsection

@section('title')
    {!! $title !!}
    <small>
        {{ $title_description }}
    </small>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route($current_route.'.index') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Editar cuenta de usuario</li>
@endsection

@section('buttons')
<a class="btn btn-sm btn-default ml-auto waves-effect waves-themed" href="{{ route($current_route.'.index') }}"><i class="fal fa-arrow-left"></i> Atrás</a>
<button class="btn btn-sm btn-primary ml-auto waves-effect waves-themed" type="button" onclick="button_submit($('#myform'))"><i class="fal fa-check"></i> Actualizar</button>
@endsection


@section('content')

    {!! Form::model($datos,['method' => 'PUT', 'route' => [$current_route . '.update', $datos->id], 'class' => '', 'files' => true, 'id' =>
    'myform', 'name' => 'myform']) !!}
    {!! Form::hidden('id', null, ['id' => 'id', 'placeholder' => '', 'class' =>
    'form-control']) !!}
        <div class="row">
            <div class="col-xl-8">
                <div class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class="fal fa-info-circle"></i> &nbsp; Información general
                        </h2>
                        <div class="panel-toolbar">
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label" for="id_adm_cliente">Cliente*</label>
                                {!! Form::select('id_adm_cliente', $clientes, null, ['id' => 'id_adm_cliente', 'style' =>
                                'width: 100%;', 'class' => 'form-control select2-single']) !!}
                                <div id="el-id_adm_cliente" for="id_adm_cliente" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="id_rol">Rol*</label>
                                {!! Form::select('id_rol', $roles, null, ['id' => 'id_rol', 'style' =>
                                'width: 100%;', 'class' => 'form-control select2-single']) !!}
                                <div id="el-id_rol" for="id_rol" class="invalid-feedback"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="correo">Nickname*</label>
                                        {!! Form::text('nickname', null, ['id' => 'nickname', 'placeholder'
                                        => '', 'class' => 'form-control']) !!}
                                        <div id="el-nickname" for="nickname" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email*</label>
                                        {!! Form::text('email', null, ['id' => 'email', 'placeholder' => '', 'class' =>
                                        'form-control']) !!}
                                        <div id="el-email" for="email" class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
@endsection
