
function loadGoogleMapAjax() {
    var listUrl = "veiculo/getCoordenadaVeiculo?page=1&rows=100";
    $.ajax({
        url: listUrl,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        error: function (xhr, status, err) {
            console.log(err);
        },
        success: function (response) {
            inicializarMapa(response);
            console.log(response);
        }
    });
}


// Função para inicializar o mapa
function inicializarMapa(marcadoresVeiculo) {
    
    var centroMapa = { lat: -34.397, lng: 150.644 };
    // Opções do mapa
    var mapaOptions = {
        zoom: 8,
        center: centroMapa
    };
    var mapa = new google.maps.Map(document.getElementById('mapDiv'), mapaOptions);
    
    for (var i = 0; i < marcadoresVeiculo.length; i++) {
        console.log(marcadoresVeiculo[i]);
        var marcador = new google.maps.Marker({
            position: { lat: parseFloat(marcadoresVeiculo[i].latitude), lng: parseFloat(marcadoresVeiculo[i].longitude) },
            map: mapa,
            title: marcadoresVeiculo[i].placa
        });
    }
 }



// Inicializa el mapa
function initMap() {
    // Coordenadas del centro del mapa
    var mapCenter = { lat: -12.9716, lng: -38.5014 };
  
    var map = new google.maps.Map(document.getElementById('mapDiv'), {
      zoom: 6,
      center: mapCenter
    });
     
    var markers = [
      {
        position: { lat: -12.9716 , lng: -38.5014 },
        title: 'Ivan Amado Cardoso -PLACA OKB-1234'
      },
      {
        position: { lat: -12.2575, lng:  -38.9668 },
        title: 'Sofia de Jesus PLACA GDG-1564'
      },
      {
        position: { lat:-14.8661, lng: -40.8394 },
        title: 'Samile Amado Cardoso -PLACA: PQL-12456'
      },
      {
        position: { lat:-14.1661, lng: -40.7394 },
        title: 'Marcio Santos -PLACA: PQL-12456'
      },
      {
        position: { lat:-15.1661, lng: -39.7394 },
        title: 'Marcio Santos -PLACA: PQL-12456'
      }

    ];
    markers.forEach(function(markerInfo) {
      var marker = new google.maps.Marker({
        position: markerInfo.position,
        map: map,
        title: markerInfo.title
      });
      var infowindow = new google.maps.InfoWindow({
        content: '<h5>' + markerInfo.title + '</h5>'
      });
      infowindow.open(map, marker);
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      });
    });
  }
