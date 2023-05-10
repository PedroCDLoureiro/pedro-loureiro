$(document).ready(function() {
    try{
        mapa_();
    }catch(e){
        
    }
});

function mapa_() {
    //Variável apontado para o elemento HTML com id 'mapa'
    //Nesse elemento com id 'mapa' será renderizando o mapa;
    var mapa = document.getElementById('mapa');
     
    //Opções de inicialização do mapa
    var mapOptions  = {
            center: {lat: Number(-25.092176), lng: Number(-50.1619103)},
            scrollwheel: false,
            zoom : 13
        };
     
    //inicialização do mapa com as opções de inicialização
    var map = new google.maps.Map(mapa, mapOptions);
     
    if (info.endereco) {
        //Texto que será mostrado no marcador do mapa
        var texto = '<div id="content">'+
                        '<h5 class="firstHeading">'+info.title+'</h5>'+
                    '</div>';
         
        //Instancia do InfoWindow para mostrar o texto definido
        var infowindow = new google.maps.InfoWindow({
            content: texto
        });
         
         
        //Instancia o GeoCoder para conversão do endereço
        var geocoder = new google.maps.Geocoder();
         
         
        //Conversão do Endereço para coordenada e inicialização da função para colocar o mapa com o centro no endereço selecionado com marcador e texto.
        geocoder.geocode({'address': info.endereco },function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
                //marcador personalizado
                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    icon: info.template_url + '/image/map-marker.png',
                });
                map.setCenter(results[0].geometry.location);
                map.setZoom(16);
         
                //Adição de um Listener no marcador. Quando clicado aparece o texto.
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            }
        });
    }
}