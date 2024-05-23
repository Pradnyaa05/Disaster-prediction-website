document.addEventListener('DOMContentLoaded', function() {
    // Fetch earthquake data from a public API (e.g., USGS Earthquake Catalog)
    fetch('https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson')
        .then(response => response.json())
        .then(data => displayEarthquakes(data.features))
        .catch(error => console.error('Error fetching earthquake data:', error));
});

function displayEarthquakes(earthquakes) {
    const earthquakeList = document.getElementById('earthquakeList');

    earthquakes.forEach(earthquake => {
        const { properties } = earthquake;
        const earthquakeItem = document.createElement('div');
        earthquakeItem.innerHTML = `
            <h3>${properties.place}</h3>
            <p>Magnitude: ${properties.mag}</p>
            <p>Time: ${new Date(properties.time).toLocaleString()}</p>
            <hr>
        `;
        earthquakeList.appendChild(earthquakeItem);
    });
}
