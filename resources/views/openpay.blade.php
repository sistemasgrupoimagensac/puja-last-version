<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
        width: 100%;
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
    <div id="map"></div>
    <script>
      var map;
      var marker;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: { lat: {{$latitude}}, lng: {{$longitude}} },
          zoom: 16
        });

        marker = new google.maps.Marker({
          position: { lat: {{$latitude}}, lng: {{$longitude}} },
          map
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&callback=initMap"
    async defer></script>
  </body>
</html>