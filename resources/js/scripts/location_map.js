// Definir `initMap` en el objeto `window` para que Google Maps la encuentre correctamente
window.initMap = function () {
  const mapDiv = document.getElementById("map");
  const input = document.getElementById("place_input");
  const direccionInput = document.getElementById("direccion");
  const distritoInput = document.getElementById("distrito");
  const provinciaInput = document.getElementById("provincia");
  const departamentoInput = document.getElementById("departamento");
  const latitudeInput = document.getElementById("latitude");
  const longitudeInput = document.getElementById("longitude");

  // Coordenadas iniciales de ejemplo o del proyecto si existen
  const defaultLocation = {
    lat: parseFloat(latitudeInput?.value) || -12.04596,
    lng: parseFloat(longitudeInput?.value) || -77.03054
  };

  let map, marker, autocomplete, geocoder;

  // Definir el estilo del mapa
  const mapStyles = [
    { featureType: "poi", stylers: [{ visibility: "off" }] },
    { featureType: "transit.station", stylers: [{ visibility: "off" }] }
  ];

  // Crear el mapa con las coordenadas predeterminadas
  map = new google.maps.Map(mapDiv, {
    center: defaultLocation,
    zoom: 14,
    styles: mapStyles
  });

  // Definir el geocoder y el marcador
  geocoder = new google.maps.Geocoder();

  marker = new google.maps.Marker({
    position: defaultLocation,
    map: map,
    draggable: true,
    icon: {
      url: "/images/svg/marker_puja.svg",
      scaledSize: new google.maps.Size(80, 80),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(40, 80)
    }
  });

  // Inicializar la funcionalidad de Autocomplete
  initAutocomplete();

  // Actualizar la ubicación al hacer clic en el mapa
  map.addListener('click', (event) => updateMapElements(event.latLng));

  // Actualizar la ubicación cuando se arrastra el marcador
  marker.addListener('dragend', () => updateMapElements(marker.getPosition()));

  // Función para inicializar Autocomplete en el campo de entrada
  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener("place_changed", () => {
      const place = autocomplete.getPlace();
      if (place.geometry) {
        const newLocation = place.geometry.location;
        updateMapElements(newLocation);
        map.setCenter(newLocation);
        fillLocationDetails(place);
      }
    });
  }

  // Función para actualizar los elementos del mapa y los campos de entrada
  function updateMapElements(location) {
    marker.setPosition(location);
    map.panTo(location);

    if (latitudeInput) latitudeInput.value = location.lat();
    if (longitudeInput) longitudeInput.value = location.lng();

    console.log("Latitud actualizada:", latitudeInput.value);
    console.log("Longitud actualizada:", longitudeInput.value);

    geocodeLocation(location);
  }

  // Función para geocodificar la ubicación y extraer los detalles
  function geocodeLocation(location) {
    geocoder.geocode({ 'location': location }, (results, status) => {
      if (status === 'OK' && results[0]) {
        fillLocationDetails(results[0]);
      }
    });
  }

  // Función para llenar los campos de la dirección, distrito, provincia y departamento
  function fillLocationDetails(place) {
    const addressComponents = place.address_components;
    let direccion = '';
    let distrito = '';
    let provincia = '';
    let departamento = '';

    let streetName = '';
    let streetNumber = '';

    // Recorrer cada componente de la dirección y asignar los valores
    addressComponents.forEach(component => {
      const componentType = component.types[0];
      switch (componentType) {
        case 'street_number':
          streetNumber = component.long_name; // Número de la calle
          break;
        case 'route':
          streetName = component.long_name; // Nombre de la calle
          break;
        case 'locality':
          distrito = component.long_name; // Distrito
          break;
        case 'administrative_area_level_2':
          provincia = component.long_name; // Provincia
          break;
        case 'administrative_area_level_1':
          departamento = component.long_name; // Departamento
          break;
      }
    });

    // Concatenar la dirección en el formato `Nombre de la calle Número`
    direccion = `${streetName} ${streetNumber}`.trim();

    if (direccionInput) direccionInput.value = direccion;
    if (distritoInput) distritoInput.value = distrito;
    if (provinciaInput) provinciaInput.value = provincia;
    if (departamentoInput) departamentoInput.value = departamento;

    // Asignar el `formatted_address` al input de búsqueda principal si existe
    if (input) input.value = direccion;
  }
};

// Invocar `initMap` desde el contexto global cuando la API de Google Maps esté lista
document.addEventListener('DOMContentLoaded', () => {
  const script = document.createElement('script');
  script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&libraries=places&callback=initMap`;
  script.async = true;
  document.head.appendChild(script);
});