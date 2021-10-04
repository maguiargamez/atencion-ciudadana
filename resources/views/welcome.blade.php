@extends('frontend.layouts.app')

@section('js')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key="></script>

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
                        <select data-placeholder="All Categories" class="chosen-select" >
                            <option>All Categories</option>
                            <option>Shops</option>
                            <option>Hotels</option>
                            <option>Restaurants</option>
                            <option>Fitness</option>
                            <option>Events</option>
                        </select>
                    </div>
                    <button class="main-search-button" onclick="reload_map()">Buscar</button>
                </div>
            </div>
        </div>
        <!-- home-map end-->
    </div>
    <!-- section end -->

@endsection


