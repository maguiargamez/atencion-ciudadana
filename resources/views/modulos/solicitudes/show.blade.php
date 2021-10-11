@extends('layouts.app')

@section('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('js/modulos/solicitudes.js') }}"></script>
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
    <li class="breadcrumb-item"><a href="{{ route($current_route.'.index', $datos->id_status) }}">Inicio</a></li>
    <li class="breadcrumb-item active">Detalle de la solicitud</li>
@endsection

@section('buttons')
<a class="btn btn-sm btn-default ml-auto waves-effect waves-themed" href="{{ route($current_route.'.index', $datos->id_status) }}"><i class="fal fa-arrow-left"></i> Atrás</a>
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



                        </div>
                    </div>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
@endsection
