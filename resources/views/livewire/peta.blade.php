<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Agricultural Land Map') }}</div>
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 600px;" wire:ignore></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts1')
<script>
var map = L.map('map').setView([16.8921, 120.4266], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/">2025</a>',
    maxZoom: 23,
    id: 'mapbox/satellite-streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoib2tpbmluYW0iLCJhIjoiY21lYTZxazBqMGFzZjJpc2l5b2dyeHN0dCJ9.-nx4JkNuM_zjmW_Tq9RE3w'
}).addTo(map);

var polygonLayers = {};
var markerLayers = {};
var originalColors = {};
var petas = {!! json_encode($petas->toArray()) !!};

// Get unique barangays & crops
var barangaySet = new Set();
var cropSet = new Set();
petas.forEach(item => {
    if(item.nama_desa) barangaySet.add(item.nama_desa);
    if(item.jenis_tanah) cropSet.add(item.jenis_tanah);
});

// Function to generate crop icons
function getCropIcon(type){
    const t = (type || '').toLowerCase();
    let emoji = '🌱';
    if(t.includes('padi') || t.includes('rice')) emoji = '🌾';
    else if(t.includes('jagung') || t.includes('corn')) emoji = '🌽';
    else if(t.includes('sayur') || t.includes('veget')) emoji = '🥬';
    else if(t.includes('kopi') || t.includes('coffee')) emoji = '☕';
    else if(t.includes('eggplant') || t.includes('eggplant')) emoji = '🍆';
    else if(t.includes('kelapa') || t.includes('coco')) emoji = '🥥';
    else if(t.includes('kakao') || t.includes('cocoa')) emoji = '🍫';
    else if(t.includes('tebu') || t.includes('sugarcane')) emoji = '🎋';
    else if(t.includes('kacang') || t.includes('bean')) emoji = '🫘';
    else if(t.includes('tomat') || t.includes('tomato')) emoji = '🍅';
    else if(t.includes('cabai') || t.includes('chili')) emoji = '🌶️';
    else if(t.includes('pisang') || t.includes('banana')) emoji = '🍌';
    else if(t.includes('mangga') || t.includes('mango')) emoji = '🥭';
    else if(t.includes('calamasi') || t.includes('calamansi')) emoji = '🍋‍🟩';
    else if(t.includes('durian')) emoji = '🟫';
    else if(t.includes('rambutan')) emoji = '🔴';
    else if(t.includes('singkong') || t.includes('cassava')) emoji = '🥔';
    else if(t.includes('ubi') || t.includes('sweet potato')) emoji = '🍠';
    else if(t.includes('kentang') || t.includes('potato')) emoji = '🥔';
    else if(t.includes('bawang') || t.includes('onion') || t.includes('garlic')) emoji = '🧅';
    return L.divIcon({
        className: 'crop-icon',
        html: `<div style="display:flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;background:#fff;border:2px solid #2e7d32;font-size:16px;box-shadow:0 2px 4px rgba(0,0,0,0.3);">${emoji}</div>`,
        iconSize: [28, 28],
        iconAnchor: [14, 14]
    });
}

// Color function
function getColorFromId(id) {
    var hue = (id * 137.508) % 360;
    return `hsl(${hue},70%,50%)`;
}

// Create polygons and markers
petas.forEach(function(item) {
    if (!item.batas_lahan || item.batas_lahan.trim() === '') return;
    try {
        var geojson = JSON.parse(item.batas_lahan);
        if (!geojson || !geojson.features || geojson.features.length === 0) return;

        var strokeColor = getColorFromId(item.id);
        var fillColor = getColorFromId(item.id + 1000);

        var layer = L.geoJSON(geojson, { style: { color: strokeColor, fillColor: fillColor, fillOpacity: 0.6 } }).addTo(map);
        polygonLayers[item.id] = layer;
        originalColors[item.id] = { stroke: strokeColor, fill: fillColor };

        var bounds = layer.getBounds();
        var centroid = bounds.getCenter();

        var popupHtml = `<div style="min-width:180px">
            <b>${item.jenis_tanah || 'Unknown Crop'}</b><br>
            Barangay: ${item.nama_desa || '-'}<br>
            Owner: ${item.nama_pemiliklahan || '-'}<br>
            Land Area: ${item.luas_lahan || '-'} m²
        </div>`;

        var marker = L.marker(centroid, { icon: getCropIcon(item.jenis_tanah) }).addTo(map);
        marker.bindPopup(popupHtml);
        layer.bindPopup(popupHtml);
        markerLayers[item.id] = marker;

        layer.on('click', () => map.fitBounds(bounds));
        marker.on('click', () => map.setView(centroid, 18));

    } catch(e) { console.error('Invalid GeoJSON for ID '+item.id, e); }
});

// === SEARCH & FILTER CONTROL (Smaller UI) ===
var searchControl = L.control({ position: 'topright' });
searchControl.onAdd = function() {
    var div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.style.background = '#fff';
    div.style.padding = '4px';
    div.style.minWidth = '180px';
    div.style.fontSize = '12px';
    div.innerHTML = `
        <select id="barangayFilter" style="width:100%;margin-bottom:3px;padding:3px;font-size:12px;">
            <option value="">All Barangays</option>
        </select>
        <select id="cropFilter" style="width:100%;margin-bottom:3px;padding:3px;font-size:12px;">
            <option value="">All Crops</option>
        </select>
        <input type="text" id="petaSearch" placeholder="Search land..." 
            style="width:100%;padding:3px;margin-bottom:3px;font-size:12px;">
        <div id="searchResults" 
            style="max-height:120px;overflow-y:auto;font-size:12px;line-height:1.3;"></div>
    `;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
searchControl.addTo(map);

// Populate dropdowns
const barangayFilter = document.getElementById('barangayFilter');
Array.from(barangaySet).sort().forEach(b => barangayFilter.innerHTML += `<option value="${b}">${b}</option>`);
const cropFilter = document.getElementById('cropFilter');
Array.from(cropSet).sort().forEach(c => cropFilter.innerHTML += `<option value="${c}">${c}</option>`);

// === FILTER FUNCTION ===
function applyFilters() {
    var query = document.getElementById('petaSearch').value.toLowerCase();
    var selectedBarangay = barangayFilter.value;
    var selectedCrop = cropFilter.value;
    var resultsDiv = document.getElementById('searchResults');
    resultsDiv.innerHTML = '';

    var foundAny = false;

    petas.forEach(item => {
        var matchesSearch = !query || item.nama_desa.toLowerCase().includes(query) || 
            item.nama_pemiliklahan.toLowerCase().includes(query) || 
            item.jenis_tanah.toLowerCase().includes(query);
        var matchesBarangay = !selectedBarangay || item.nama_desa === selectedBarangay;
        var matchesCrop = !selectedCrop || item.jenis_tanah === selectedCrop;

        var visible = matchesSearch && matchesBarangay && matchesCrop;

        // Show/hide layers
        if (polygonLayers[item.id]) {
            if (visible) map.addLayer(polygonLayers[item.id]); else map.removeLayer(polygonLayers[item.id]);
        }
        if (markerLayers[item.id]) {
            if (visible) map.addLayer(markerLayers[item.id]); else map.removeLayer(markerLayers[item.id]);
        }

        // Add to search results
        if (visible) {
            foundAny = true;
            var div = document.createElement('div');
            div.style.padding = '3px';
            div.style.borderBottom = '1px solid #ddd';
            div.style.cursor = 'pointer';
            div.innerHTML = `<b>${item.nama_desa}</b><br>Owner: ${item.nama_pemiliklahan}<br>Crop: ${item.jenis_tanah}`;
            div.onclick = function() {
                map.fitBounds(polygonLayers[item.id].getBounds());
                polygonLayers[item.id].openPopup();
                markerLayers[item.id].openPopup();
            };
            resultsDiv.appendChild(div);
        }
    });

    if (!foundAny && query.trim() !== '') {
        resultsDiv.innerHTML = '<div style="padding:3px;color:#999;">No matches found</div>';
    }
}

// Event listeners
document.getElementById('petaSearch').addEventListener('input', applyFilters);
barangayFilter.addEventListener('change', applyFilters);
cropFilter.addEventListener('change', applyFilters);

// Initial render
applyFilters();
</script>
@endpush
</div>
