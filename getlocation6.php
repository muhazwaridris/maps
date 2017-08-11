<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    function initialize() {
      var map;
      var position = new google.maps.LatLng(-5.16, 119.455);    // set your own default location.
      var myOptions = {
        zoom: 14,
        center: position
      };
      var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

      // We send a request to search for the location of the user.  
      // If that location is found, we will zoom/pan to this place, and set a marker
      navigator.geolocation.getCurrentPosition(locationFound, locationNotFound);

      function locationFound(position) {
        // we will zoom/pan to this place, and set a marker
        var location = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        // var accuracy = position.coords.accuracy;

        map.setCenter(location);
        var marker = new google.maps.Marker({
            position: location, 
            map: map, 
            draggable: true,
            title: "Lokasi anda disini! Geser marker ini ke lokasi anda sebenarnya."
        });
        // set the value an value of the <input>
        updateInput(location.lat(), location.lng());

        // Add a "drag end" event handler
        google.maps.event.addListener(marker, 'dragend', function() {
          updateInput(this.position.lat(), this.position.lng());
        });


      }

      function locationNotFound() {
        // location not found, you might want to do something here
      }

    }
    function updateInput(lat, lng) {
      document.getElementById("lat").innerHTML = lat;
      document.getElementById("lng").innerHTML = lng;
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
#map-canvas {
  width: 500px;
  height: 400px;
}
</style>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX6ODOIOr_tuja3nFiEiaXdCHyZgqyerg&callback=initialize">
</script>
</head>
<body>
  <style>
  #mapCanvas {
    width: 500px;
    height: 400px;
    float: left;
  }
  #mapCanvas2 {
    width: 500px;
    height: 400px;
    visibility:hidden;
  }
  #infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
  </style>
  <div id="infoPanel">
    <b>Lat:</b>
    <input type="text" name="Latitude" id="Latitude" placeholder="Latitude" value="">
    <b>Lng:</b>
    <input type="text" name="Longitude" id="Longitude" placeholder="Longitude" value="">
    <button onclick="viewMap()">Show Map</button>
    <script>
      function viewMap() {
          var viewMap = document.getElementById('mapCanvas2');
          if (viewMap.style.visibility === 'visible') {
              viewMap.style.visibility = 'hidden';
          } else {
              viewMap.style.visibility = 'visible';
          }
      }
    </script>
  </div>
  <div id="mapCanvas2">
    <div id="mapCanvas"></div>
    <div id="infoPanel">
      <b>Marker status:</b>
      <div id="markerStatus"><i>Tentukan lokasi anda</i></div>
      <b>Lat:</b>
      <span id="lat"></span></br>
      <b>Lng:</b>
      <span id="lng"></span></br>
      <button id="getLocation">Get Location</button></br>
    </div>
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
</html>