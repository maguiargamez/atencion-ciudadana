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
@if($datos->id_status==1)
<button class="btn btn-sm btn-danger ml-auto waves-effect waves-themed" type="button" onclick="add_seguimiento(3)"><i class="fal fa-ban"></i> Cancelar</button>
<button class="btn btn-sm btn-success ml-auto waves-effect waves-themed" type="button" onclick="add_seguimiento(2)"><i class="fal fa-check"></i> Aceptar</button>
@endif
<button class="btn btn-sm btn-success ml-auto waves-effect waves-themed" type="button" onclick="add_seguimiento(4)"><i class="fal fa-check"></i> Completado</button>
<button class="btn btn-sm btn-primary ml-auto waves-effect waves-themed" type="button" onclick="add_seguimiento(0)"><i class="fal fa-check"></i> Agregar seguimiento</button>
<button class="btn btn-sm btn-primary ml-auto waves-effect waves-themed" type="button" onclick="button_submit($('#myform'))"><i class="fal fa-save"></i> Guardar</button>
<a class="btn btn-sm btn-default ml-auto waves-effect waves-themed" href="{{ route($current_route.'.index', $datos->id_status) }}"><i class="fal fa-arrow-left"></i> Atrás</a>

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


            {{-- Modal --}}
    <div id="modal-seguimiento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                {!! Form::open(['method' => 'POST', 'route' => $current_route .'.add-seguimiento', 'class' => '', 'files' => true, 'id' =>
                'myform-add-seguimiento', 'name' => 'myform-add-seguimiento']) !!}

                <div class="modal-header">
                    <h5 class="modal-title h4"> <span id="txt-titulo">Agregar segumiento</span></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="panel">
                        <div class="panel-hdr">
                            <h2>
                                <i class="fal fa-info-circle"></i> &nbsp; Información general
                            </h2>
                        </div>
                        <div class="panel-container show">

                            <div class="panel-content">

                                {!! Form::text('id_solicitud', $datos->id, ['id' => 'id_solicitud', 'placeholder' => '', 'class' =>'form-control']) !!}
                                {!! Form::text('id_accion', 0, ['id' => 'id_accion', 'placeholder' => '', 'class' =>'form-control']) !!}


                                <div id="msg-modal-add-md" class="alert alert-warning d-none" role="alert">
                                    <strong>Advertencia!</strong> Hay campos pendientes por llenar marcados con (*).
                                    <div id="msg-modal-add-md-detail"></div>
                                </div>

                                <div  class="form-group">
                                    <label id="txt-descripcion" class="form-label" for="observaciones">Descripción</label>
                                    {!! Form::textarea('descripcion', null, ['id' => 'descripcion', 'placeholder' => '', 'class' =>
                                    'form-control', 'rows'=>8]) !!}
                                    <div id="el-descripcion" for="descripcion" class="invalid-feedback"></div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-themed" data-dismiss="modal"><i class="fal fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fal fa-check"></i>  Aceptar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection
