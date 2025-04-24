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
		const map = L.map( 'map' ).setView( [ 20, 10 ], 1 ).setZoom(1.8 );

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
	fetchReliefWebJobs();
	
	// Set up filter buttons
	const filterButtons = document.querySelectorAll('[data-filter]');
	filterButtons.forEach(button => {
	  button.addEventListener('click', () => {

		filterButtons.forEach(btn => btn.classList.remove('active'));
	
		button.classList.add('active');

		currentPage = 1; 
		filterJobs(button.dataset.filter);
	  });
	});
	
	// Set up search
	const searchInput = document.getElementById('job-search');
	if (searchInput) {
	  searchInput.addEventListener('input', () => {
		currentPage = 1; // Reset to page 1 when searching
		filterJobs();
	  });
	}
  });
  
  // Store all jobs globally so we can filter them
  let allJobs = [];
  let currentPage = 1;
  const itemsPerPage = 10; 
  
  function fetchReliefWebJobs() {
	const jobsContainer = document.getElementById('reliefweb-jobs-container');
	const tableBody = document.getElementById('jobs-table-body');
	
	// Remove the d-none class to make the container visible
	jobsContainer.classList.remove('d-none');
	
	fetch('https://api.reliefweb.int/v1/jobs?appname=impact-atlas.org&limit=30&fields[include][]=title&fields[include][]=date&fields[include][]=url&fields[include][]=source')
	  .then(response => response.json())
	  .then(data => {
		// Store jobs in global variable
		allJobs = data.data.map(job => {
		  const fields = job.fields || {};
		  const title = fields.title || 'No Title';
		  const org = fields.source && fields.source.length > 0 ? fields.source[0].name : 'Not specified';
		  const posted = fields.date && fields.date.created ? new Date(fields.date.created).toLocaleDateString() : 'N/A';
		  const closing = fields.date && fields.date.closing ? new Date(fields.date.closing).toLocaleDateString() : 'N/A';
		  const url = fields.url || '#';
		  const isVolunteer = title.toLowerCase().includes('volunteer') || title.toLowerCase().includes('unpaid');
		  
		  return { title, org, posted, closing, url, isVolunteer };
		});
		
		// Display page 1 initially
		filterJobs();
	  })
	  .catch(error => {
		tableBody.innerHTML = '<tr><td colspan="6" class="text-center">Could not load jobs.</td></tr>';
	  });
  }
  
  function filterJobs(filterType) {
	const searchInput = document.getElementById('job-search');
	const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
	
	// If no filter type is provided, use the currently active button
	if (!filterType) {
	  const activeButton = document.querySelector('[data-filter].active');
	  if (activeButton) {
		filterType = activeButton.dataset.filter;
	  } else {
		filterType = 'all';
	  }
	}
	
	// Filter jobs based on type and search term
	const filteredJobs = allJobs.filter(job => {
	  // Filter by type (volunteer/paid)
	  const typeMatch = filterType === 'all' || 
					   (filterType === 'volunteer' && job.isVolunteer) || 
					   (filterType === 'paid' && !job.isVolunteer);
	  
	  // Filter by search term
	  const searchMatch = !searchTerm || 
						 job.title.toLowerCase().includes(searchTerm) || 
						 job.org.toLowerCase().includes(searchTerm);
	  
	  return typeMatch && searchMatch;
	});
	
	// Display filtered jobs with pagination
	displayJobs(filteredJobs);
	
	// Update pagination
	updatePagination(filteredJobs.length);
  }
  
  function displayJobs(jobs) {
	const tableBody = document.getElementById('jobs-table-body');
	
	if (jobs.length === 0) {
	  tableBody.innerHTML = '<tr><td colspan="6" class="text-center">No matching opportunities found.</td></tr>';
	  return;
	}
	
	// Calculate pagination
	const startIndex = (currentPage - 1) * itemsPerPage;
	const endIndex = Math.min(startIndex + itemsPerPage, jobs.length);
	const pageJobs = jobs.slice(startIndex, endIndex);
	
	let html = '';
	
	pageJobs.forEach(job => {
	  html += `
		<tr>
		  <td>${job.title}</td>
		  <td>${job.org}</td>
		  <td><span class="badge ${job.isVolunteer ? 'bg-info' : 'bg-success'}">${job.isVolunteer ? 'Volunteer' : 'Paid'}</span></td>
		  <td>${job.posted}</td>
		  <td>${job.closing}</td>
		  <td><a href="${job.url}" target="_blank" class="btn btn-sm btn-view ">View</a></td>
		</tr>  
	  `  
	  
	  
	  ;

	});

	
	tableBody.innerHTML = html;
	
  }


  
  function updatePagination(totalItems) {
	// Find or create pagination container
	let paginationContainer = document.getElementById('jobs-pagination');
	
	if (!paginationContainer) {
	  paginationContainer = document.createElement('div');
	  paginationContainer.id = 'jobs-pagination';
	  paginationContainer.className = 'mt-3 d-flex justify-content-center';
	  
	  const jobsContainer = document.getElementById('reliefweb-jobs-container');
	  jobsContainer.appendChild(paginationContainer);
	}
	
	// Calculate total pages
	const totalPages = Math.ceil(totalItems / itemsPerPage);
	
	// Create pagination HTML
	let paginationHtml = '<ul class="pagination">';
	
	// Previous button
	paginationHtml += `
	  <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
		<a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>
	  </li>
	`;
	
	// Page numbers (limit to 4 pages)
	for (let i = 1; i <= Math.min(totalPages, 4); i++) {
	  paginationHtml += `
		<li class="page-item ${currentPage === i ? 'active' : ''}">
		  <a class="page-link" href="#" data-page="${i}">${i}</a>
		</li>
	  `;
	}
	
	// Next button
	paginationHtml += `
	  <li class="page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}">
		<a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
	  </li>
	`;
	
	paginationHtml += '</ul>';
	
	// Set pagination HTML
	paginationContainer.innerHTML = paginationHtml;
	
	// Add click events to pagination links
	const pageLinks = paginationContainer.querySelectorAll('.page-link');
	pageLinks.forEach(link => {
	  link.addEventListener('click', (e) => {
		e.preventDefault();
		const pageNum = parseInt(link.dataset.page);
		
		// Only change page if it's not disabled
		if (!link.parentElement.classList.contains('disabled')) {
		  currentPage = pageNum;
		  filterJobs();
		}
	  });
	});
  }