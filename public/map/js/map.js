var map;
var feature;

function load_map() {
	map = new L.Map('map', {zoomControl: true});

	var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
		osmAttribution = 'Map data &copy; 2012 <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
		osm = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});

	map.setView(new L.LatLng(43.296482, 5.36978), 13).addLayer(osm);
}

function chooseAddr(lat1, lng1, lat2, lng2, osm_type) {
	var loc1 = new L.LatLng(lat1, lng1);
	var loc2 = new L.LatLng(lat2, lng2);
	var bounds = new L.LatLngBounds(loc1, loc2);
	

	if (feature) {
		map.removeLayer(feature);
	}
	if (osm_type == "node") {
		feature = L.circle( loc1, 25, {color: 'green', fill: false}).addTo(map);
		map.fitBounds(bounds);
		map.setZoom(18);
	} else {
		feature = L.marker([lat1,lng1]).addTo(map);
		document.getElementById("add_event_latitude").value = lat1;
		document.getElementById("add_event_longitude").value = lng1;

		map.fitBounds(bounds);
	}
}



window.onload = load_map;
