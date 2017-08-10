<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

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
<button onclick="viewOnMap()">View On Map</button>

<script>
function viewOnMap() {
    window.open("getlocation3.1.php", "", "width=520,height=570");
}
</script>
<div id="infoPanel">
  <input type="text" name="Latitude" id="Latitude" placeholder="Latitude">
  <input type="text" name="Longitude" id="Longitude" placeholder="Longitude">
  </div>
</body>
</html>