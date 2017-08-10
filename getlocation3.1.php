<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('lat').innerHTML = [
    latLng.lat()
  ];
  document.getElementById('lng').innerHTML = [
    latLng.lng()
  ];
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function initialize() {
  var latLng = new google.maps.LatLng(-5.16, 119.455);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 9,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Lokasi Anda',
    map: map,
    draggable: true
  });

  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);

  google.maps.event.addListener(map,'click',function(event) {
    document.getElementById('latlongclicked').value = event.latLng.lat()
    document.getElementById('latlongclicked').value = event.latLng.lng()
  });

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX6ODOIOr_tuja3nFiEiaXdCHyZgqyerg&callback=initMap">
    </script>
</head>
<body>
  <style>
  #mapCanvas {
    width: 500px;
    height: 400px;
    float: left;
  }
  #infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
  </style>
  <div id="mapCanvas"></div>
  <div id="infoPanel">
    <b>Marker status:</b>
    <div id="markerStatus"><i>Klik dan geser lokasi anda</i></div>
    <b>Lat:</b>
    <span id="lat"></span></br>
    <b>Lng:</b>
    <span id="lng"></span></br>
    <b>Closest matching address:</b>
    <div id="address"></div>
    <button id="getLocation">Get Location</button></br>
  </div>
  <script>
document.getElementById("getLocation").
addEventListener("click", getLocation);
 
function getLocation() {
    var lat=document.getElementById("lat").innerHTML;
    var lng=document.getElementById("lng").innerHTML;
    document.getElementById("Latitude").value=lat;
    document.getElementById("Longitude").value=lng;
}
</script>
</body>
</html>