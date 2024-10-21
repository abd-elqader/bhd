    <div class="top_img py-4" style="height: 100px">
        <div class="container"></div>
    </div>

    <div class="cart_2 my-4">
        <div class="container">
            <div class="row my-4">
                <div class="col-12 col-md-6 {{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                    <div class="m-2">
                        <form method="POST" action="{{ route('client.address.store') }}">
                            @csrf
                            <input id="lat" type="hidden" name="lat" required value="{{ old('lat') }}">
                            <input id="long" type="hidden" name="long" required value="{{ old('long') }}">
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('dashboard.country')</span>
                                <select name="country_id" id="country_id" class="border rounded p-2 w-100">
                                    <option value="" disabled hidden selected>@lang('messages.Select')</option>
                                    @foreach(Countries() as $Country)
                                        <option {{ ($country_id && $country_id == $Country['id']) ? 'selected' : '' }} value="{{ $Country['id'] }}">{{ $Country['title_' . lang()] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-2">
                                <span class="main_bold p-2 BahrainCountry">@lang('website.region')</span>
                                <span class="main_bold p-2 d-none OtherCountries">@lang('website.city')</span>
                                <select name="region_id" id="region_id" class="border rounded p-2 w-100">
                                    <option value="" disabled hidden selected>@lang('messages.Select')</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2 BahrainCountry">@lang('website.block')</span>
                                <span class="main_bold p-2 d-none OtherCountries">@lang('website.district')</span>
                                <input type="text" name="district" class="border rounded p-2 w-100 OtherCountries">
                                <input type="hidden" name="block_id"  id="block_id" class="border rounded p-2 w-100">
                                <select name="block" id="block" class="border rounded p-2 w-100 BahrainCountry">
                                    <option value="" disabled hidden selected>@lang('messages.Select')</option>
                                    @foreach($blocks as $block)
                                        <option data-uuid="{{ $block['uuid'] }}"  value="{{ $block['id'] }}">{{ $block['number'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2 BahrainCountry">@lang('website.road')</span>
                                <span class="main_bold p-2 d-none OtherCountries">@lang('website.street')</span>
                                <input  type="number" min="1" max="99999" name="road" class="border rounded p-2 w-100" value="{{ old('road') }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('website.building_no')</span>
                                <input type="text" name="building_no" class="border rounded p-2 w-100" value="{{ old('building_no') }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('dashboard.floor_no')</span>
                                <input type="text" name="floor_no" class="border rounded p-2 w-100" value="{{ old('floor_no') }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('website.apartmentNo')</span>
                                <input type="text" name="apartment" class="border rounded p-2 w-100" value="{{ old('apartment') }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('website.type')</span>
                                <input type="text" name="type" class="border rounded p-2 w-100" value="{{ old('type') }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('website.additionalDirection')</span>
                                <textarea name="additional_directions" class="border rounded p-2 w-100" rows="6">{{ old('additional_directions') }}</textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="mx-2 bt_details_reverce transition_me w-100 py-3 border-0 rounded">@lang('website.save')</button>
                                <button href="{{ route('client.address.index') }}" class="mx-2 bt_details_reverce transition_me w-100 py-3 border-0 rounded text-center">@lang('website.cancel')</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mx-2 my-4">
                        <div class="form-group" id="map" style="height: 600px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map;
        var markers = [];

        function initMap() {
            var haightAshbury = {lat: 26.22170100683176, lng: 50.58556788820532};

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: haightAshbury,
                mapTypeId: 'terrain'
            });

            $('#lat').val('26.22170100683176');
            $('#long').val('50.58556788820532');
            // This event listener will call addMarker() when the map is clicked.
            map.addListener('click', function(event) {
                addMarker(event.latLng);
                var latitude = event.latLng.lat();
                var longitude = event.latLng.lng();
                $('#lat').val(latitude);
                $('#long').val(longitude);

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

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        $(document).ready(function () {


            $("#lat").on("input", function(){
                // // Print entered value in a div box
                var lat=$("#lat").val();
                var lang=$("#long").val();

                var haightAshbury =  {lat: 26.22170100683176, lng: 50.58556788820532};
                haightAshbury["lat"]=Number(lat);
                haightAshbury["lng"]=Number(lang);

                // Adds a marker at the center of the map.
                addMarker(haightAshbury);


                console.log(haightAshbury);
            });


            $("#long").on("input", function(){
                // // Print entered value in a div box
                var lat=$("#lat").val();
                var lang=$("#long").val();

                var haightAshbury =  {lat: 26.22170100683176, lng: 50.58556788820532};
                haightAshbury["lat"]=Number(lat);
                haightAshbury["lng"]=Number(lang);

                // Adds a marker at the center of the map.
                addMarker(haightAshbury);


                console.log(haightAshbury);
            });
        });
    </script>


    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap">
    </script>

    <script>
        @if($country_id)
            if({{ $country_id }} == 1){
                $('.BahrainCountry').removeClass('d-none');
                $('.OtherCountries').addClass('d-none');
            }else{
                $('.BahrainCountry').addClass('d-none');
                $('.OtherCountries').removeClass('d-none');
            }
            $(document).on("change", "#block", function () {
                $('#block_id').val( $('#block option:selected').val() );
            });
            $.ajax({
                type:'POST',
                url:'/country_regions/'+ {{ $country_id }},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success:function(data){
                    $('#region_id').empty().append(data);
                },
                error: function (xhr, exception) {
                    var msg = "";
                    if (xhr.status === 0) {
                        msg = "Not connect.\n Verify Network." + xhr.responseText;
                    } else if (xhr.status == 404) {
                        msg = "Requested page not found. [404]" + xhr.responseText;
                    } else if (xhr.status == 500) {
                        msg = "Internal Server Error [500]." +  xhr.responseText;
                    } else if (exception === "parsererror") {
                        msg = "Requested JSON parse failed.";
                    } else if (exception === "timeout") {
                        msg = "Time out error." + xhr.responseText;
                    } else if (exception === "abort") {
                        msg = "Ajax request aborted.";
                    } else {
                        msg = "Error:" + xhr.status + " " + xhr.responseText;
                    }
                   console.log(msg);
                }
            }); 
        @endif
        $(document).on("change", "#country_id", function () {
            if($('#country_id option:selected').val() == 1){
                $('.BahrainCountry').removeClass('d-none');
                $('.OtherCountries').addClass('d-none');
            }else{
                $('.BahrainCountry').addClass('d-none');
                $('.OtherCountries').removeClass('d-none');
            }
            $.ajax({
                type:'POST',
                url:'/country_regions/'+$('#country_id option:selected').val(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success:function(data){
                    $('#region_id').empty().append(data);
                },
                error: function (xhr, exception) {
                    var msg = "";
                    if (xhr.status === 0) {
                        msg = "Not connect.\n Verify Network." + xhr.responseText;
                    } else if (xhr.status == 404) {
                        msg = "Requested page not found. [404]" + xhr.responseText;
                    } else if (xhr.status == 500) {
                        msg = "Internal Server Error [500]." +  xhr.responseText;
                    } else if (exception === "parsererror") {
                        msg = "Requested JSON parse failed.";
                    } else if (exception === "timeout") {
                        msg = "Time out error." + xhr.responseText;
                    } else if (exception === "abort") {
                        msg = "Ajax request aborted.";
                    } else {
                        msg = "Error:" + xhr.status + " " + xhr.responseText;
                    }
                   console.log(msg);
                }
            }); 
        });
    </script>
    
