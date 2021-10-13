@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyACINILux0NDpJKTxPZ-uwmRwGfNm0W19U"></script>
    <script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/map_infobox.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/markerclusterer.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/maps.js') }}"></script>
    <script src="{{ asset('js/frontend/solicitud.js') }}"></script>
@endsection

@section('script')
@endsection

@section('content')

{!! Form::open(['method' => 'POST', 'route' => 'solicitudes.store-frontend', 'class' => '', 'files' => true, 'id' =>
    'myform', 'name' => 'myform']) !!}
                    <!--section -->
                    <section>
                        <!-- container -->
                        <div class="container">
                            <!-- profile-edit-wrap -->
                            <div class="profile-edit-wrap">

                                <div class="profile-edit-page-header">
                                    <h2>Haz tu denuncia</h2>
                                    <div class="breadcrumbs">
                                        <a href="#">Inicio</a>
                                        <span>Haz tu denuncia</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="profile-edit-container add-list-container">
                                            <div class="profile-edit-header fl-wrap">
                                                <h4>Datos del ciudadano</h4>
                                            </div>

                                            <div class="custom-form">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Nombre <i class="fa fa-user"></i></label>
                                                        {!! Form::text('nombre', null, ['id' => 'nombre', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Apellido 1 <i class="fa fa-user"></i></label>
                                                        {!! Form::text('apellido1', null, ['id' => 'apellido1', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Apellido 2 <i class="fa fa-user"></i></label>
                                                        {!! Form::text('apellido2', null, ['id' => 'apellido2', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Teléfonos <i class="fa fa-phone"></i></label>
                                                        {!! Form::text('telefono', null, ['id' => 'telefono', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Correo electrónico <i class="fa fa-envelope"></i></label>
                                                        {!! Form::text('email', null, ['id' => 'email', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>


                                                </div>

                                            </div>
                                        </div>


                                        <div class="profile-edit-container add-list-container">
                                            <div class="profile-edit-header fl-wrap">
                                                <h4>Datos del servicio</h4>
                                            </div>

                                            <div class="custom-form">
                                                <label>Servicio</label>
                                                {!! Form::select('id_tipo_servicio', $servicios, null, ['id' => 'id_tipo_servicio', 'style' =>'width: 100%;', 'class' => 'chosen-select select2-single']) !!}

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Dirección <i class="fa fa-map-marker"></i></label>
                                                        {!! Form::text('direccion', null, ['id' => 'direccion', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Colonia <i class="fa fa-map-marker"></i></label>
                                                        {!! Form::text('colonia', null, ['id' => 'colonia', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Entre calle <i class="fa fa-map-marker"></i></label>
                                                        {!! Form::text('calle_enre_1', null, ['id' => 'calle_enre_1', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>y calle <i class="fa fa-map-marker"></i></label>
                                                        {!! Form::text('calle_enre_2', null, ['id' => 'calle_enre_2', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Código postal <i class="fa fa-map-marker"></i></label>
                                                        {!! Form::text('codigo_postal', null, ['id' => 'codigo_postal', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="map-container">
                                                <div id="singleMap" data-latitude="16.753178" data-longitude="-93.114215"></div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {!! Form::hidden('txtLat', null, ['id' => 'txtLat', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! Form::hidden('txtLng', null, ['id' => 'txtLng', 'placeholder'=> '', 'class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="custom-form">
                                                <label>Descripción del reporte</label>
                                                {!! Form::textarea('descripcion_reporte', null, ['id' => 'descripcion_reporte', 'placeholder'=> '', 'cols' => '40']) !!}
                                            </div>









                                        </div>




                                        <!-- profile-edit-container-->
                                        <div class="profile-edit-container add-list-container">
                                            <div class="profile-edit-header fl-wrap">
                                                <h4>Adjuntos</h4>
                                            </div>

                                            <div class="custom-file mb-3">

                                                <label class="custom-file-label" for="adjuntos">Adjunto 1: </label>
                                                <input type="file" class="custom-file-input" id="adj1" name="adj1">

                                                <label class="custom-file-label" for="adjuntos">Adjunto 2: </label>
                                                <input type="file" class="custom-file-input" id="adj2" name="adj2">

                                                <label class="custom-file-label" for="adjuntos">Adjunto 3: </label>
                                                <input type="file" class="custom-file-input" id="adj3" name="adj3">

                                              </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <!--profile-edit-wrap end -->
                        </div>

                        <button  type="button" class="btn  big-btn  color-bg flat-btn" onclick="button_enviar($('#myform'))"><i class="fa fa-angle-right"></i> Enviar</button>
                        <!--container end -->
                    </section>
                    <!-- section end -->


                    {!! Form::close() !!}
@endsection


