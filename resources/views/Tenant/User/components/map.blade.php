<style>

    #map .gm-style-iw-d {
      color: #000;
    }

    #map input[type=text] {
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

    #map input[type=button] {
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

    #map input[type=button]:hover {
      background: rgb(235, 235, 235);
    }

    #map input[type=button].button-primary {
      background-color: #1a73e8;
    }

    #map input[type=button].button-primary:hover {
      background-color: #1765cc;
    }

    #map input[type=button].button-secondary {
      background-color: white;
      color: #1a73e8;
    }

    #map input[type=button].button-secondary:hover {
      background-color: #d2e3fc;
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
<div class="row  position-relative" style="height: 300px;" wire:ignore>
    <div id="map"></div>
</div>

<script>
    let map;
    let marker;
    let geocoder;
    let response;
    
    console.log(3265);
    
    function initMap() {
      var haightAshbury = {lat: 26.0667 ,lng: 50.5577};
      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: haightAshbury,
        mapTypeControl: false,
        draggableCursor:'default',
        
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

        firstChild.addEventListener('click', function() {
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
            				var currentLocation = { lat: currentLatitude, lng: currentLongitude };
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
              @this.set('latitude', results[0].geometry.location.lat());
              @this.set('longitude', results[0].geometry.location.lng());
              return results;
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap&language={{ lang() }}"></script>
