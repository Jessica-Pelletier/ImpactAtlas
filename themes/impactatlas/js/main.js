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


// API calls
(() => {
    window.addEventListener('load', (event) => {
        fetchElectricityAccessData();
    });

    async function fetchElectricityAccessData() {
        const apiUrl = 'https://api.worldbank.org/v2/country/1W/indicator/EG.ELC.ACCS.ZS?format=json&date=1998:2022';

        try {
            const response = await fetch(apiUrl);
            const data = await response.json();

            if (data && data[1]) {
                const processedData = processWorldBankData(data[1]);
                renderElectricityAccessChart(processedData);
            } else {
                throw new Error('No data found');
            }
        } catch (error) {
            handleError(error);
        }
    }

    function processWorldBankData(apiData) {
        return apiData
            .filter(entry => entry.value !== null)
            .sort((a, b) => a.date - b.date)
            .map(entry => ({
                year: entry.date,
                accessPercentage: entry.value
            }));
    }

    function renderElectricityAccessChart(data) {
    
        const chartCanvas = document.getElementById('electricity-access-chart');
        
        if (!chartCanvas) {
            console.error("Canvas element not found");
            return;
        }
        
        if (typeof Chart === 'undefined') {
            console.error("Chart.js not loaded");
            return;
        }
        
      
        const existingChart = Chart.getChart(chartCanvas);
        if (existingChart) {
            existingChart.destroy();
        }
        
  
        try {
            new Chart(chartCanvas, {
                type: 'line',
                data: {
                    labels: data.map(d => d.year),
                    datasets: [{
                        label: 'Electricity Access (%)',
                        data: data.map(d => d.accessPercentage),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Electricity Access: ${context.parsed.y.toFixed(2)}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Percentage of Population'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toFixed(1) + '%';
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        }
                    }
                }
            });
        } catch (e) {
            console.error("Error creating chart:", e);
            
      
            const container = document.getElementById('electricity-access-container');
            if (container) {
                const errorElement = document.createElement('div');
                errorElement.className = 'error-message';
                errorElement.innerHTML = `<p>Chart error: ${e.message}</p>`;
                container.appendChild(errorElement);
            }
        }
    }

    function handleError(error) {
        console.error('API error:', error);
        
        const chartCanvas = document.getElementById('electricity-access-chart');
        if (chartCanvas) {
        
            const errorDiv = document.createElement('div');
            errorDiv.className = 'chart-error';
            errorDiv.innerHTML = `<p>Unable to load data: ${error.message}</p>`;
            
      
            chartCanvas.parentNode.insertBefore(errorDiv, chartCanvas.nextSibling);
        }
    }
})();

//Job posting from Relief Web
document.addEventListener('DOMContentLoaded', () => {

	const jobsContainer = document.getElementById('reliefweb-jobs-container');
	if (jobsContainer) {
	  fetchReliefWebJobs();
	}
  });
  
 //get refief jobs data 
  async function fetchReliefWebJobs() {
	try {
	  const jobsContainer = document.getElementById('reliefweb-jobs-container');
	  if (!jobsContainer) return;
	  
	
	  const apiUrl = new URL('https://api.reliefweb.int/v1/jobs');
	  apiUrl.searchParams.append('appname', 'impact-atlas.org');
	  apiUrl.searchParams.append('limit', '10');
	  
//Add these fields to be searched
	  ['title', 'date', 'url', 'source'].forEach(field => {
		apiUrl.searchParams.append('fields[include][]', field);
	  });
	  

	  const response = await fetch(apiUrl);
	  const data = await response.json();
	  

	  const table = document.createElement('table');
	  table.className = 'jobs-table';
	  

	  const thead = document.createElement('thead');
	  thead.innerHTML = `
		<tr>
		  <th class="job-title-header">Job Title</th>
		  <th class="job-org-header">Organization</th>
		  <th class="job-posted-header">Posted Date</th>
		  <th class="job-closing-header">Closing Date</th>
		</tr>
	  `;
	  table.appendChild(thead);
	  

	  const tbody = document.createElement('tbody');
	  
	
	  data.data.forEach((job) => {
		const fields = job.fields || {};


		const row = document.createElement('tr');
		row.className = 'job-row';
		

		const titleCell = document.createElement('td');
		titleCell.className = 'job-title-cell';
		titleCell.innerHTML = `
		  <a href="${fields.url || '#'}" target="_blank" class="job-link">
			${fields.title || 'No Title'}
		  </a>
		`;
		

		const orgCell = document.createElement('td');
		orgCell.className = 'job-org-cell';
		orgCell.textContent = fields.source && fields.source.length > 0 
		  ? fields.source[0].name 
		  : 'Organization not specified';
		
		
		const postedCell = document.createElement('td');
		postedCell.className = 'job-posted-cell';
		postedCell.textContent = fields.date && fields.date.created 
		  ? new Date(fields.date.created).toLocaleDateString() 
		  : 'Not available';
		

		const closingCell = document.createElement('td');
		closingCell.className = 'job-closing-cell';
		closingCell.textContent = fields.date && fields.date.closing 
		  ? new Date(fields.date.closing).toLocaleDateString() 
		  : 'Not specified';
		

		row.appendChild(titleCell);
		row.appendChild(orgCell);
		row.appendChild(postedCell);
		row.appendChild(closingCell);

		tbody.appendChild(row);
	  });
	  
	
	  table.appendChild(tbody);
	  

	  jobsContainer.innerHTML = '';
	  jobsContainer.appendChild(table);
	  
	} catch (error) {
	  console.error('Error:', error);

	  const jobsContainer = document.getElementById('reliefweb-jobs-container');
	  if (jobsContainer) {
		jobsContainer.innerHTML = `<p class="jobs-error">Failed to load jobs: ${error.message}</p>`;
	  }
	}
  }