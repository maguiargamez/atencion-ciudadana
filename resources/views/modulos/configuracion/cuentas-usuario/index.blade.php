@extends('layouts.app')

@section('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/modulos/cuentas-usuario.js') }}"></script>
@endsection

@section('script')
    fill_table({});
@endsection

@section('title')
    {!! $title !!}
    <small>
        {{ $title_description }}
    </small>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('buttons')
@endsection

@section('content')
    {!! Form::open(['method' => 'DELETE', 'route' => [$current_route . '.destroy', 0], 'class' => '', 'id' =>
    'frmdestroy', 'name' => 'frmdestroy']) !!}
    {!! Form::close() !!}

    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Usuarios registrados
            </h2>
            <div class="panel-toolbar">
                <a class="btn btn-sm btn-primary ml-auto waves-effect waves-themed" href="{{ route($current_route.'.create') }}"><i class="fal fa-plus"></i> Agregar usuario</a>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <table id="dt_default" class="table table-bordered table-hover table-striped w-100">
                </table>
            </div>
        </div>
    </div>

@endsection
