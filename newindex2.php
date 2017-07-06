<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
  <?PHP
    include "koneksi.php"
  ?>
    <div id="map"></div>

    <script>
    /*var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
          parking: {
            icon: iconBase + 'parking_lot_maps.png'
          },
          library: {
            icon: iconBase + 'library_maps.png'
          },
          info: {
            icon: iconBase + 'info-i_maps.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(-5.179, 119.460854),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-5.1792, 119.460854),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-5.1795, 119.460854),
            type: 'parking'
          }, {

        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });*/

      var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
      var icons = {
        house: {
          name: 'House',
          icon: iconBase + 'library_maps.png'
        },
        parking: {
          name: 'Parking',
          icon: iconBase + 'parking_lot_maps.png'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-5.16, 119.455),
          zoom: 14
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('mapmarkers.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};

              features.forEach(function(feature) {
                var marker = new google.maps.Marker({
                  position: point,
                  icon: icons[point].icon,
                  map: map
                });
              });

              var legend = document.getElementById('legend');
              for (var key in icons) {
                var type = icons[key];
                var name = type.name;
                var icon = type.icon;
                var div = document.createElement('div');
                div.innerHTML = '<img src="' + icon + '"> ' + name;
                legend.appendChild(div);
              }

              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX6ODOIOr_tuja3nFiEiaXdCHyZgqyerg&callback=initMap">
    </script>
  </body>
</html>