@extends('frontend.layouts.app')

@section('js')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyACINILux0NDpJKTxPZ-uwmRwGfNm0W19U"></script>

    <script src="{{ asset('assets/frontend/js/map_infobox.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/markerclusterer.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/maps.js') }}"></script>
@endsection

@section('script')

@endsection

@section('content')

    <!-- home-map-->
    <div class="home-map fl-wrap">
        <!-- Map -->
        <div class="map-container fw-map">
            <div id="map-main">
            </div>
        </div>
        <!-- Map end -->
        <div class="absolute-main-search-input">
            <div class="container">
                <div class="main-search-input fl-wrap">
                    <div class="main-search-input-item">
                        {!! Form::select('id_tipo_servicio', $tipos_servicios, null, ['id' => 'id_tipo_servicio', 'style' =>
                            'width: 100%;', 'class' => 'chosen-select', 'data-placeholder'=>'Servicio']) !!}
                    </div>
                    <button class="main-search-button" onclick="reload_map()">Filtrar</button>
                </div>
            </div>
        </div>
        <!-- home-map end-->
    </div>
    <!-- section end -->

        <!--section -->
        <section>
            <!-- container -->
            <div class="container">
                <!-- profile-edit-wrap -->
                <div class="profile-edit-wrap">
                    <div class="profile-edit-page-header">
                        <h2>Últimas denuncias</h2>

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



                    </div>

                    <div class="col-md-12">
                        <a href="{{ route('solicitudes.index-frontend') }}" class="btn  big-btn  color-bg flat-btn">Ver más...</a>
                    </div>

                </div>
            </div>
        </section>

@endsection


