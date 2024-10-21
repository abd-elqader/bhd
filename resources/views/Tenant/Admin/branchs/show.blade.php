@extends('Mix.layouts.app')
@section('pagetitle', __('messages.branches'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <td>{{ __('messages.title_ar') . ':' }}</td>
            <td>{{ $Branch['title_ar'] }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.title_en') . ':' }}</td>
            <td>{{ $Branch['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.status') . ':' }}</td>
            <td>{{ $Branch['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

<div class="col-md-12" id="map" style="height: 500px;width: 100%"></div>
@endsection


@section('js')

    <script>

        var map;
        var markers = [];

        function initMap() {
            var haightAshbury = {lat: parseFloat('{{ $Branch['lat'] ?? 26.227934462972144 }}'), lng: parseFloat('{{ $Branch['long'] ?? 50.58910840410498 }}')};

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: haightAshbury,
                mapTypeId: 'terrain'
            });

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);
        }

        // Adds a marker to the map and push to the array.
        function addMarker(location) {
            clearMarkers();
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
            setMapOnAll(map);
        }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap"></script>

@endsection
