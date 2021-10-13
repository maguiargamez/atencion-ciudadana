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

<section id="sec1">
    <div class="container">
        <div class="section-title">
            <h2>Detalle de la denuncia</h2>
        </div>
        <div class="row">

            <div class="col-md-8">
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
                    <!-- article> -->
                    <article>
                        <div class="list-single-main-media fl-wrap">
                            <div class="single-slider-wrapper fl-wrap">
                                <div class="single-slider fl-wrap"  >

                                    @foreach ($datos->adjuntos as $adjunto)
                                        <div class="slick-slide-item"><img src="{{ asset('img/solicitudes/'.$adjunto) }}" alt=""></div>
                                    @endforeach


                                </div>
                                <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                                <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                            </div>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3><a href="blog-single.html">{{ $datos->servicio }}</a></h3>
                            </div>
                            <p>{{ $datos->descripcion_reporte }}</p>

                            <div class="post-opt">
                                <ul>
                                    <li><i class="fa fa-calendar-check-o"></i> <span>{{ $datos->created_at }}</span></li>
                                </ul>
                            </div>

                        </div>
                    </article>
                </div>
            </div>
            <!--box-widget-wrap -->
            <div class="col-md-4">
                <div class="box-widget-wrap">
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap">
                        <div class="list-single-main-item-title fl-wrap">
                            <h3>Ubicación</h3>
                        </div>
                        <div class="map-container">
                            <div id="singleMap" data-latitude="{{ $datos->latitud }}" data-longitude="{{ $datos->longitud }}"></div>
                        </div>
                    </div>

                </div>
            </div>
            <!--box-widget-wrap end -->
        </div>
        <br><br>




        <section>
            <div class="container">
                <div class="section-title">
                    <h2>Últimas denuncias</h2>
                </div>
            </div>
            <!-- carousel -->
            <div class="list-carousel fl-wrap card-listing ">
                <!--listing-carousel-->
                <div class="listing-carousel  fl-wrap ">

                    @foreach ($denuncias as $denuncia)
                        <?php $denuncia['adjuntos']= json_decode($denuncia['adjuntos']); $i=0; ?>
                                        <!--slick-slide-item-->
                                        <div class="slick-slide-item">
                                            <!-- listing-item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img">


                                                        @foreach ($denuncia->adjuntos as $adj )
                                                            @if($i==0)
                                                            <img src="{{ asset('img/solicitudes/'.$adj) }}" alt="">
                                                            @endif
                                                            <?php $i++; ?>
                                                        @endforeach

                                                    </div>
                                                    <div class="geodir-category-content fl-wrap">
                                                        <a class="listing-geodir-category">{{ $denuncia->status }}</a>

                                                        <h3><a href="{{ route('solicitudes.show-frontend', $denuncia->id) }}">{{ substr($denuncia->tipo_servicio, 0, 10). "..." }}</a></h3>
                                                        <p>{{ substr($denuncia->descripcion_reporte, 0, 80). "..." }}</p>
                                                        <div class="geodir-category-options fl-wrap">

                                                            <div class="geodir-category-location">
                                                                <a href="{{ route('solicitudes.show-frontend', $denuncia->id) }}"><i class="fa fa-search" aria-hidden="true"></i>Leer más</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <!-- listing-item end-->
                                        </div>
                                        <!--slick-slide-item end-->


                    @endforeach


                </div>
                <!--listing-carousel end-->
                <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
            </div>
            <!--  carousel end-->

        </section>




    </div>
</section>




@endsection


