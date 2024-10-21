@extends('Mix.layouts.app')
@section('pagetitle', __('messages.branches'))
@section('content')
<form method="POST" action="{{ route('admin.branches.update',$Branch) }}">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.store_title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Branch['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.store_title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Branch['title_en'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="address_ar">@lang('dashboard.store_address_ar')</label>
            <input type="text" name="address_ar" id="address_ar" class="form-control" required value="{{ $Branch['address_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="address_en">@lang('dashboard.store_address_en')</label>
            <input type="text" name="address_en" id="address_en" class="form-control" required value="{{ $Branch['address_en'] }}">
        </div>
        
        <div class="form-group col-md-6">
            <label for="block">@lang('dashboard.block')</label>
            <input type="text" name="block" id="block" class="form-control" required value="{{ $Branch['block'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="road">@lang('dashboard.road')</label>
            <input type="text" name="road" id="road" class="form-control" required value="{{ $Branch['road'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="building_no">@lang('website.building_no')</label>
            <input type="text" name="building_no" id="building_no" class="form-control" required value="{{ $Branch['building_no'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="floor_no">@lang('dashboard.floor_no')</label>
            <input type="text" name="floor_no" id="floor_no" class="form-control" value="{{ $Branch['floor_no'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="apartment">@lang('dashboard.apartment')</label>
            <input type="text" name="apartment" id="apartment" class="form-control" value="{{ $Branch['apartment'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="phone">@lang('dashboard.phone')</label>
            <input type="text" name="phone" id="phone" class="form-control" required value="{{ $Branch['phone'] }}">
        </div>
        
        
        <div class="form-group col-md-6">
            <label for="working_time_ar">@lang('dashboard.working_time_ar')</label>
            <input type="text" name="working_time_ar" id="working_time_ar" class="form-control" required value="{{ $Branch['working_time_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="working_time_en">@lang('dashboard.working_time_en')</label>
            <input type="text" name="working_time_en" id="working_time_en" class="form-control" required value="{{ $Branch['working_time_en'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="whatsapp">@lang('dashboard.whatsapp')</label>
            <input type="text" name="whatsapp" id="whatsapp" class="form-control" required value="{{ $Branch['whatsapp'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="email">@lang('dashboard.email')</label>
            <input type="text" name="email" id="email" class="form-control" required value="{{ $Branch['email'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="countries">@lang('dashboard.countries')</label>
            <select class="form-control" required name="country_id">
                @foreach ($countries as $country)
                <option  {{ in_array($country->id ,[$Branch->country_id]) ? 'selected' : ''  }}  value="{{ $country->id }}">{{ $country->title() }}</option>
                @endforeach
            </select>
        </div>

        <input readonly type="hidden"  value="{{ $Branch['lat'] ?? 26.227934462972144 }}" name="lat" id="lat" class="form-control" required>
        <input readonly type="hidden"  value="{{ $Branch['long'] ?? 50.58910840410498 }}" name="long" id="long" class="form-control" required>
       
        <div class="clearfix"></div>
        <div class="text-center col-12 mx-auto  mt-3">
            <label class="control-label text-danger">
                @lang('dashboard.working_periods')
            </label>
        </div>
        <div class="openclose text-center col-12 mx-auto">
            <div class="row item">
                <div class="form-group  col-md-5 col-sm-12">
                    <label>@lang('dashboard.open')</label>
                    <input type="time" placeholder="@lang('dashboard.open')" id="open" class="form-control text-center">
                </div>
                <div class="form-group  col-md-5 col-sm-12">
                    <label>@lang('dashboard.close')</label>
                    <input type="time" placeholder="@lang('dashboard.close')" id="close" class="form-control text-center">
                </div>

                <div class="form-group  col-md-2 col-sm-12">
                    <label>@lang('messages.add')</label>
                    <button id="add_desc" class="btn btn-primary waves-effect waves-light w-100" type="button">+</button>
                </div>
            </div>
            @foreach ($Branch->WorkTime as $WorkTime)
                <div class="row my-3">
                    <div class="col-md-5 col-sm-12">
                    <label>Open</label>
                    <input value="{{ $WorkTime->open }}" class="form-control" name="open[]" type="text" required="">
                </div>
                <div class="col-md-5 col-sm-12">
                    <label>Close</label>
                    <input value="{{ $WorkTime->close }}" class="form-control" name="close[]" type="text" required="">
                </div>
                    <div class="col-md-2 col-sm-12">
                        <button class="btn btn-danger mt-4 w-100" type="button">-</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-group col-12 my-3">
            <div class="col-md-12" id="map" style="height: 500px;width: 100%">

            </div>
        </div>


        <div class="clearfix"></div>
        <div class="col-12 my-4">
            <div class="button-group">
                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                    {{ __('messages.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>

@endsection



@section('css')
      <style>
        input[type=text] {
          background-color: #fff;
          border: 0;
          border-radius: 2px;
          box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
          margin: 10px;
          padding: 0 0.5em;
          font: 400 18px Roboto, Arial, sans-serif;
          overflow: hidden;
          line-height: 40px;
          margin-right: 0;
          min-width: 25%;
        }

        input[type=button] {
          background-color: #fff;
          border: 0;
          border-radius: 2px;
          box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
          margin: 10px;
          padding: 0 0.5em;
          font: 400 18px Roboto, Arial, sans-serif;
          overflow: hidden;
          height: 40px;
          cursor: pointer;
          margin-left: 5px;
        }

        input[type=button]:hover {
          background: rgb(235, 235, 235);
        }

        input[type=button].button-primary {
          background-color: #1a73e8;
          color: white;
        }

        input[type=button].button-primary:hover {
          background-color: #1765cc;
        }

        input[type=button].button-secondary {
          background-color: white;
          color: #1a73e8;
        }

        input[type=button].button-secondary:hover {
          background-color: #d2e3fc;
        }
        @media (max-width: 575.98px) {
            #map input{
              top: 50px !important;
            }
        }

        #response-container {
          background-color: #fff;
          border: 0;
          border-radius: 2px;
          box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
          margin: 10px;
          padding: 0 0.5em;
          font: 400 18px Roboto, Arial, sans-serif;
          overflow: hidden;
          overflow: auto;
          max-height: 50%;
          max-width: 90%;
          background-color: rgba(255, 255, 255, 0.95);
          font-size: small;
        }

        #instructions {
          background-color: #fff;
          border: 0;
          border-radius: 2px;
          box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
          margin: 10px;
          padding: 0 0.5em;
          font: 400 18px Roboto, Arial, sans-serif;
          overflow: hidden;
          padding: 1rem;
          font-size: medium;
        }
    </style>
@endsection



@section('js')
    <script>
        $(document).on("click", "#add_desc", function() {
            if($('#open').val() && $('#close').val()){
                $('<div class="row my-3">' +
                    '<div class="col-md-5 col-sm-12">' +
                        '<label>@lang("dashboard.open")</label>' +
                        '<input value="' + $('#open').val() + '" class="form-control" name="open[]"  type="text" required >' +
                    '</div>' +
                    '<div class="col-md-5 col-sm-12">' +
                        '<label>@lang("dashboard.close")</label>' +
                        '<input value="' + $('#close').val() + '" class="form-control" name="close[]"  type="text" required >' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-12">' +
                        '<button class="btn btn-danger mt-4 w-100" type="button">-</button>' +
                    '</div>' +
                '</div>').insertAfter(".openclose .item");
                $('#open').val('');
                $('#close').val('');
            }
        });
        $(document).on('click', '.btn-danger', function() {
            $(this).parent().parent().remove();
        });
        $(document).on('click', 'input[type="checkbox"]', function() {
            $(this).parent().parent().find("input[type='text']").val('');
            $(this).parent().parent().find("i").toggleClass('bg-danger-900 bg-success-900');
            $(this).parent().parent().find("i").toggleClass('fa-xmark fa-check');
            $(this).parent().parent().find("input[type='text']").prop('disabled', function(i, v) { return !v; });
        });
    </script>
    <script>
        let map;
        let marker;
        let geocoder;
        let response;
        var markers = [];

        
        
        function addMarker(location) {
            clearMarkers();
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        function clearMarkers() {
            setMapOnAll(null);
        }

        function initMap() {
          var haightAshbury = {lat: parseFloat({{ $Branch['lat'] }}), lng: parseFloat({{ $Branch['long'] }})};
          map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: haightAshbury,
            mapTypeControl: false,
          });
          geocoder = new google.maps.Geocoder();
    
          const inputText = document.createElement("input");
          inputText.type = "text";
          inputText.placeholder = "{{ __('messages.pick_your_location') }}";
    
          const submitButton = document.createElement("input");
          submitButton.type = "button";
          submitButton.value = "{{ __('messages.search') }}";
          submitButton.classList.add("button", "button-primary");
    
  
          response = document.createElement("pre");
          response.id = "response";
          response.innerText = "";
    
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);
          marker = new google.maps.Marker({
            map,
            animation: google.maps.Animation.DROP,
            position: haightAshbury
          });
           addYourLocationButton(map, marker);
           map.addListener('click', function(event) {
                geocode({ location: event.latLng });
                var latitude = event.latLng.lat();
                var longitude = event.latLng.lng();
           });
          submitButton.addEventListener("click", () =>
            geocode({ address: inputText.value })
          );
          marker.setMap(null);
          addMarker(haightAshbury);
          
          map.setZoom(15);


        }
        function addYourLocationButton(map, marker){
            var controlDiv = document.createElement('div');
            var firstChild = document.createElement('button');
            firstChild.style.backgroundColor = '#fff';
            firstChild.style.border = 'none';
            firstChild.style.outline = 'none';
            firstChild.style.width = '40px';
            firstChild.style.height = '40px';
            firstChild.style.borderRadius = '2px';
            firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
            firstChild.style.cursor = 'pointer';
            firstChild.style.marginRight = '10px';
            firstChild.style.padding = '0px';
            firstChild.title = 'Your Location';
            controlDiv.appendChild(firstChild);
    
            var secondChild = document.createElement('div');
            secondChild.style.margin = '10px';
            secondChild.style.width = '18px';
            secondChild.style.height = '18px';
            secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
            secondChild.style.backgroundSize = '180px 18px';
            secondChild.style.backgroundPosition = '0px 0px';
            secondChild.style.backgroundRepeat = 'no-repeat';
            secondChild.id = 'you_location_img';
            firstChild.appendChild(secondChild);
    
            google.maps.event.addListener(map, 'dragend', function() {
                $('#you_location_img').css('background-position', '0px 0px');
            });
    
            firstChild.addEventListener('click', function(event) {
                event.preventDefault();
                var imgX = '0';
                var animationInterval = setInterval(function(){
                    if(imgX == '-18') imgX = '0';
                    else imgX = '-18';
                    $('#you_location_img').css('background-position', imgX+'px 0px');
                }, 500);
                if(navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        marker.setPosition(latlng);
                        map.setCenter(latlng);
                        clearInterval(animationInterval);
                        $('#you_location_img').css('background-position', '-144px 0px');
                        if ("geolocation" in navigator){
                			navigator.geolocation.getCurrentPosition(function(position){
                				var currentLatitude = position.coords.latitude;
                				var currentLongitude = position.coords.longitude;
                				var infoWindowHTML = "Latitude: " + currentLatitude + "<br>Longitude: " + currentLongitude;
                				var infoWindow = new google.maps.InfoWindow({map: map, content: infoWindowHTML});
                				var currentLocation = { lat: currentLatitude, lng: currentLongitude };
                				infoWindow.setPosition(currentLocation);
                                geocode({ location: latlng });
                			});
                		}
                    });
                }
                else{
                    clearInterval(animationInterval);
                    $('#you_location_img').css('background-position', '0px 0px');
                }
    
            });
    
            controlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
        }
        
        window.initMap = initMap;

        function geocode(request) {
          marker.setMap(null);
          geocoder.geocode(request).then((result) => {
              const { results } = result;
              map.setCenter(results[0].geometry.location);
              marker.setPosition(results[0].geometry.location);
              marker.setMap(map);
              response.innerText = JSON.stringify(result, null, 2);
      
              $("#lat").val(results[0].geometry.location.lat());
              $("#long").val(results[0].geometry.location.lng());
              return results;
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap"></script>
@endsection
