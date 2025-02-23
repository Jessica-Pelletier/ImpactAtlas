document.addEventListener( 'DOMContentLoaded', function() {
	const mapElement = document.getElementById( 'map' );

	if ( mapElement ) {
		const categoryColors = {
			default: '#3388ff', //the leaflet blue
			environment: '#2ecc71', //green
			technology: '#e74c3c', //vermillion
			social: '#DF7D3B', //orange
			economic: '#34495e', //charcoal
			successstories: '#9b59b6', //purple
		};

		// Enhanced marker icon creation function
		function getMarkerIcon( category ) {
			// More aggressive normalization
			const normalizedCategory = category.toLowerCase().replace( /[^a-z]/g, '' );

			// Try multiple matching strategies
			const matchedColor =
                categoryColors[ normalizedCategory ] ||
                categoryColors[ normalizedCategory.replace( 'al', '' ) ] ||
                categoryColors.default;

			return L.divIcon( {
				className: 'custom-div-icon',
				html: `<div style='
                    background-color:${ matchedColor };
                    width: 20px;
                    height: 20px;
                    border-radius: 50% 50% 50% 0;
                    position: absolute;
                    transform: rotate(-45deg);
                    left: 50%;
                    top: 50%;
                    margin: -15px 0 0 -15px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.4);
                ' class='marker-pin'></div>`,
				iconSize: [ 30, 42 ],
				iconAnchor: [ 15, 42 ],
			} );
		}

		// Initialize map
		const map = L.map( 'map' ).setView( [ 0, 0 ], 1 ).setZoom( 2 );

		// Add tile layer
		L.tileLayer( 'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
		} ).addTo( map );

		// Ensure mapData is available
		if ( typeof mapData !== 'undefined' ) {
			const controller = new AbortController();
			const timeoutId = setTimeout( () => controller.abort(), 10000 );

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

					if ( ! response.ok ) {
						throw new Error( `HTTP error ${ response.status }` );
					}
					return response.json();
				} )
				.then( ( data ) => {
					if ( Array.isArray( data ) && data.length > 0 ) {
						const markerGroup = L.layerGroup().addTo( map );

						data.forEach( ( marker ) => {
							try {
								// Create a custom marker with a popup
								const markerIcon = getMarkerIcon( marker.category );

								const leafletMarker = L.marker(
									[ marker.lat, marker.lng ],
									{ icon: markerIcon }
								)
									.bindPopup( `
                                        <div class="leaflet-card">
                                <h4>${ marker.title }</h4>
                                <p>${ marker.category }</p>
                                <p>Date: ${ marker.date }</p>
                                <a href="${ marker.permalink }">Read more</a></div>
                            ` );

								markerGroup.addLayer( leafletMarker );
							} catch ( markerError ) {

							}
						} );

						// Fit map to markers
						map.fitBounds( markerGroup.getBounds(), {
							padding: [ 50, 50 ],
						} );
					} else {

					}
				} )
				.catch( ( error ) => {

				} );
		} else {

		}
	} else {

	}
} );
