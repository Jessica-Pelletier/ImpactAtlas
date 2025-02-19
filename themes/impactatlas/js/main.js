document.addEventListener( 'DOMContentLoaded', function() {
	const mapElement = document.getElementById( 'map' );

	if ( mapElement ) {
		console.log( 'Map element found, initializing Leaflet' );

		// Initialize map
		const map = L.map( 'map' ).setView( [ 0, 0 ], 1 );
		console.log( 'Map initialized' );

		// Add tile layer
		L.tileLayer( 'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
		} ).addTo( map );
		console.log( 'Tile layer added' );

		// Ensure mapData is available
		if ( typeof mapData !== 'undefined' ) {
			console.log( 'MapData found:', mapData );

			// Use a timeout to ensure fetch doesn't hang
			const controller = new AbortController();
			const timeoutId = setTimeout( () => controller.abort(), 10000 ); // 10-second timeout

			fetch( mapData.ajaxUrl, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams( {
					action: 'get_map_markers',
					nonce: mapData.nonce,
				} ),
				signal: controller.signal,
			} )
				.then( ( response ) => {
					clearTimeout( timeoutId );
					console.log( 'Fetch response received' );
					if ( ! response.ok ) {
						throw new Error( `HTTP error ${ response.status }` );
					}
					return response.json();
				} )
				.then( ( data ) => {
					console.log( 'Markers data:', data );

					if ( Array.isArray( data ) && data.length > 0 ) {
						data.forEach( ( marker ) => {
							// Create a custom marker with a popup
							const leafletMarker = L.marker( [ marker.lat, marker.lng ] )
								.addTo( map )
								.bindPopup( `
                                <h4>${ marker.title }</h4>
                                <p>${ marker.excerpt }</p>
                                <p>Date: ${ marker.date }</p>
                                <a href="${ marker.permalink }">Read more</a>
                            ` );

							// Optional: Add a custom class based on category
							leafletMarker.options.className = `marker-${ marker.category.toLowerCase().replace( /\s+/g, '-' ) }`;
						} );
						console.log( `Added ${ data.length } markers` );
					} else {
						console.log( 'No markers found or invalid data format' );
					}
				} )
				.catch( ( error ) => {
					console.error( 'Error fetching markers:', error );
				} );
		} else {
			console.error( 'mapData is undefined' );
		}
	} else {
		console.error( 'Map element not found' );
	}
} );
