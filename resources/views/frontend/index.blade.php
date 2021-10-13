@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('js/frontend/solicitud.js') }}"></script>
@endsection

@section('script')

@endsection

@section('content')

    <!--section -->
    <section>
        <!-- container -->
        <div class="container">
            <!-- profile-edit-wrap -->
            <div class="profile-edit-wrap">
                <div class="profile-edit-page-header">
                    <h2>Listado de denuncias</h2>
                    <div class="breadcrumbs">
                        <a href="#">Denuncias</a>
                        <span>Listado</span>
                    </div>
                </div>

                <div class="col-md-12">
                            @foreach ($resultados as $resultado)
                            <div class="dashboard-list">
                                <div class="dashboard-message">
                                    <div class="dashboard-message-text">
                                        <h4>{{ $resultado->tipo_servicio }} - <span>{{ $resultado->created_at }}</span></h4>
                                        <span class="booking-text"><b>Estatus: </b>{{ $resultado->status }}</span>
                                        <p>{{ substr($resultado->descripcion_reporte, 0, 500).'...' }}</p>
                                        <a href="{{ route('solicitudes.show-frontend', $resultado->id) }}" class="btn  circle-btn color-bg flat-btn">Leer más...</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                    {{ $resultados->links('vendor.pagination.custom-template') }}
                </div>

            </div>
        </div>
    </section>

@endsection


