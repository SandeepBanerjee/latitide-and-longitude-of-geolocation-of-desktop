<html>
	<head>
		<style>
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB7UwZoWzzeOVopUvDpn8-mJJS6uVF7FwY" type="text/javascript"></script>
		<script type="text/javascript">
		
		window.onload = function () {
			var portName = 'Delhi';
			codeAddress(portName);
		}
		
		
		var geocoder, map;

		function codeAddress(address) {
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				'address': address
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var myOptions = {
						zoom: 5,
						center: results[0].geometry.location,
						mapTypeId: 'roadmap'
					}
					map = new google.maps.Map(document.getElementById("dvMap"), myOptions);
					///////////////////////
					google.maps.event.addListener(map, 'click', function (e) {
					 document.getElementById("lati").value = parseFloat(e.latLng.lat().toFixed(6));
					 document.getElementById("longi").value = parseFloat(e.latLng.lng().toFixed(6));
					 placeMarker(e.latLng,map);
					 });
					///////////////////////
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
				}
			});
		}
		//Adding marker on click
		var marker;
		function placeMarker(location,map) {
		  if ( marker ) {
			marker.setPosition(location);
		  } else {
			marker = new google.maps.Marker({
			  position: location,
			  map: map
			});
		  }
		}
		</script>
	</head>
	
	<body>
		
		<div id="dvMap" style="width: 100%; height: 400px"> </div>
		<div style="margin: 20px;text-align: center;">
			<p style="color:red">
				Zoom the map and find your Berth and then click on the Berth, Latitude and Longitude will automatically fill in the box just copy and paste the Latitude and longitude in the form.  
			</p>
		</div>
		<div style="margin: 20px;text-align: center;">
		Latitude: <input id="lati" name="latitude" type="text" maxlength="10"><br><br>
		Longitude: <input id="longi" name="longitude" type="text">
		</div>
		<script type="text/javascript">
    function getLocationConstant() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
        } else {
            alert("Your browser or device doesn't support Geolocation");
        }
    }

    // If we have a successful location update
    function onGeoSuccess(event) {
        document.getElementById("Latitude").value = event.coords.latitude;
        document.getElementById("Longitude").value = event.coords.longitude;
        document.getElementById("Position1").value = event.coords.latitude + ", " + event.coords.longitude;

    }

    // If something has gone wrong with the geolocation request
    function onGeoError(event) {
        alert("Error code " + event.code + ". " + event.message);
    }
</script>
<form action="geo/ruteplanlag.php" method="get">
    <div id="divSample" class="hideClass">Latitude:
        <input type="text" id="Latitude" name="Latitude" value="">
        <br>
        <br>Longitude:
        <input type="text" id="Longitude" name="Longitude" value="">
        <br>
    </div>
    <br>Position
    <input type="text" id="Position1" name="Position1" value="Miami">
    <br>
    <br>
    <input type="button" value="Get Location" onclick="geolocate()" />
    <br>
    <br>
</form>
		<script>
			function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            $("#Latitude").val(position.coords.latitude);
            $("#Longitude").val(position.coords.longitude);
            // Create a marker and center map on user location
            marker = new google.maps.Marker({
                position: pos,
                draggable: true,
                animation: google.maps.Animation.DROP,
                map: map
            });
            map.setCenter(pos);
        });
    }
};
			
		</script>
	</body>
</html>