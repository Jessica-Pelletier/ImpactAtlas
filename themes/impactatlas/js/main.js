const map = L.map( 'map' ).setView( [ 0, -0 ], 10 );

L.tileLayer( 'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 1,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
} ).addTo( map );
