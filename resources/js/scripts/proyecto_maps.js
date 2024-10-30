window.initMap = function () {
  const mapDiv = document.getElementById("map");
  let map, marker

  const defaultLocation = {
    lat: parseFloat(lat_saved),
    lng: parseFloat(lng_saved)
  };

  const mapStyles = [
    { featureType: "poi", stylers: [{ visibility: "off" }] }, // Ocultar POI
    { featureType: "transit.station", stylers: [{ visibility: "off" }] } // Ocultar estaciones de transporte
  ];

  map = new google.maps.Map(mapDiv, {
    center: defaultLocation,
    zoom: 16,
    styles: mapStyles,
  });

  marker = new google.maps.Marker({
    position: defaultLocation,
    map: map,
    icon: {
      url: "/images/svg/marker_puja.svg",
      scaledSize: new google.maps.Size(80, 80),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(40, 80)
    }
  });

}

// Invocar `initMap` desde el contexto global cuando la API de Google Maps esté lista
document.addEventListener('DOMContentLoaded', () => {
  const script = document.createElement('script');
  script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&libraries=places&callback=initMap`;
  script.async = true;
  script.defer = true;
  document.head.appendChild(script);
});