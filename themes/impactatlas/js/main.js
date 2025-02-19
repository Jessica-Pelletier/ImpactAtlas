const map = L.map( 'map' ).setView( [ 0, -0 ], 1 );

L.tileLayer( 'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 15,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
} ).addTo( map );

//POPup

const popup = L.popup();
let marker;

function onMapClick( e ) {
	popup
		.setLatLng( e.latlng )
		.setContent( 'You clicked the map at ' + e.latlng.toString() )
		.openOn( map );

	// if ( marker ) {
	// 	map.removeLayer( marker );
	// }

	// marker = L.marker( e.latlng ).addTo( map );
}

map.on( 'click', onMapClick );
