$(document).ready(function(){
    var point = [43.2883, 5.5439];
    var mymap = L.map('mapid').setView(point, 14);

// Trouvé sur http://leaflet-extras.github.io/leaflet-providers/preview/index.html
    var OpenStreetMap_France = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mymap);
    
// Ajouter le point
// var marker = L.marker(point, {title: "Le présage"}).addTo(mymap);
    var popup = L.popup()
        .setLatLng(point)
        .setContent('<p>Le Présage<br />1460 route de la Légion<br />13400 Aubagne</p>')
        .openOn(mymap);
})

