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

// Debug: Log data to console to check for missing crop types
console.log('Peta data loaded:', petas);
console.log('Total farms found:', petas.length);

// Collect all unique crop types for debugging
const uniqueCrops = new Set();
petas.forEach(function(item, index) {
    console.log(`Farm ${index}:`, {
        id: item.id,
        crop: item.jenis_tanah,
        owner: item.nama_pemiliklahan,
        barangay: item.nama_desa,
        hasBoundary: !!item.batas_lahan
    });
    
    if (item.jenis_tanah) {
        uniqueCrops.add(item.jenis_tanah);
    }
    
    if (!item.jenis_tanah) {
        console.warn(`Item ${index} (ID: ${item.id}) missing crop type:`, item);
    }
    if (!item.batas_lahan) {
        console.warn(`Item ${index} (ID: ${item.id}) missing boundary data:`, item);
    }
});

console.log('All unique crop types found:', Array.from(uniqueCrops));

// Simple emoji crop icons with better matching
function getCropIcon(type){
    const t = (type || '').toString().toLowerCase().trim();
    let emoji = '🌱'; // default
    
    console.log('Getting icon for crop type:', t); // Debug log
    
    if(t.includes('padi') || t.includes('rice') || t.includes('beras')) emoji = '🌾';
    else if(t.includes('jagung') || t.includes('corn') || t.includes('maize')) emoji = '🌽';
    else if(t.includes('sayur') || t.includes('veget') || t.includes('kangkung') || t.includes('bayam')) emoji = '🥬';
    else if(t.includes('kopi') || t.includes('coffee')) emoji = '☕';
    else if(t.includes('kelapa') || t.includes('coco') || t.includes('coconut')) emoji = '🥥';
    else if(t.includes('kakao') || t.includes('cocoa') || t.includes('coklat')) emoji = '🍫';
    else if(t.includes('tebu') || t.includes('sugarcane')) emoji = '🎋';
    else if(t.includes('kacang') || t.includes('bean') || t.includes('soy')) emoji = '🫘';
    else if(t.includes('tomat') || t.includes('tomato')) emoji = '🍅';
    else if(t.includes('cabai') || t.includes('chili') || t.includes('pepper')) emoji = '🌶️';
    else if(t.includes('pisang') || t.includes('banana')) emoji = '🍌';
    else if(t.includes('mangga') || t.includes('mango')) emoji = '🥭';
    else if(t.includes('calamasi') || t.includes('calamansi')) emoji = '🍋‍🟩';
    else if(t.includes('durian')) emoji = '🟫';
    else if(t.includes('rambutan')) emoji = '🔴';
    else if(t.includes('singkong') || t.includes('cassava') || t.includes('tapioka')) emoji = '🥔';
    else if(t.includes('ubi') || t.includes('sweet potato')) emoji = '🍠';
    else if(t.includes('kentang') || t.includes('potato')) emoji = '🥔';
    else if(t.includes('bawang') || t.includes('onion') || t.includes('garlic')) emoji = '🧅';
    else if(t.includes('padi sawah') || t.includes('wet rice')) emoji = '🌾';
    else if(t.includes('padi gogo') || t.includes('dry rice')) emoji = '🌾';
    else if(t.includes('padi ladang') || t.includes('upland rice')) emoji = '🌾';

    return L.divIcon({
        className: 'crop-div-icon-' + Math.random().toString(36).substr(2, 9),
        html: `<div style="display:flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:#ffffffcc;border:2px solid #2e7d32;font-size:20px;box-shadow: 0 2px 4px rgba(0,0,0,0.3);">${emoji}</div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 16]
    });
}

// Unique colors based on ID
function getColorFromId(id) {
    var hue = (id * 137.508) % 360; // golden angle
    return `hsl(${hue}, 70%, 50%)`;
}

petas.forEach(function(item) {
    // Skip if no boundary data or if data is invalid
    if (!item.batas_lahan || item.batas_lahan.trim() === '') {
        console.log(`Skipping item ${item.id} - no boundary data`);
        return;
    }

    try {
        var geojson = JSON.parse(item.batas_lahan);
        
        // Skip if geojson is empty or invalid
        if (!geojson || !geojson.features || geojson.features.length === 0) {
            console.log(`Skipping item ${item.id} - invalid geojson`);
            return;
        }

        var strokeColor = getColorFromId(item.id);
        var fillColor = getColorFromId(item.id + 1000);

        var layer = L.geoJSON(geojson, {
            style: { color: strokeColor, fillColor: fillColor, fillOpacity: 0.6 }
        }).addTo(map);

        polygonLayers[item.id] = layer;
        originalColors[item.id] = { stroke: strokeColor, fill: fillColor };

        // Detailed popup for polygon
        const popupHtml = `
            <div style="min-width:220px">
                <div style="font-weight:700;margin-bottom:4px;">${item.jenis_tanah || 'Unknown Crop'}</div>
                <div><strong>Barangay:</strong> ${item.nama_desa || '-'}</div>
                <div><strong>Owner:</strong> ${item.nama_pemiliklahan || '-'}</div>
                <div><strong>Land:</strong> ${item.luas_lahan || '-'} m²</div>
            </div>`;
        layer.bindPopup(popupHtml);

        // Get centroid using multiple methods for accuracy
        var centroid;
        
        // Method 1: Try to get centroid from GeoJSON feature
        try {
            if (geojson.features && geojson.features.length > 0) {
                var feature = geojson.features[0];
                if (feature.geometry && feature.geometry.coordinates) {
                    var coords = feature.geometry.coordinates[0]; // First ring of polygon
                    if (coords && coords.length > 0) {
                        var sumLat = 0, sumLng = 0;
                        coords.forEach(function(coord) {
                            sumLng += coord[0]; // longitude
                            sumLat += coord[1]; // latitude
                        });
                        centroid = L.latLng(sumLat / coords.length, sumLng / coords.length);
                        console.log(`Method 1 - GeoJSON centroid for farm ${item.id}:`, centroid);
                    }
                }
            }
        } catch (e) {
            console.log('Method 1 failed:', e);
        }
        
        // Method 2: Try to get centroid from layer geometry
        if (!centroid) {
            try {
                if (layer.getLayers && layer.getLayers().length > 0) {
                    var polygon = layer.getLayers()[0];
                    if (polygon.getLatLngs && polygon.getLatLngs().length > 0) {
                        var latlngs = polygon.getLatLngs()[0];
                        if (latlngs && latlngs.length > 0) {
                            var sumLat = 0, sumLng = 0;
                            latlngs.forEach(function(point) {
                                sumLat += point.lat;
                                sumLng += point.lng;
                            });
                            centroid = L.latLng(sumLat / latlngs.length, sumLng / latlngs.length);
                            console.log(`Method 2 - Layer centroid for farm ${item.id}:`, centroid);
                        }
                    }
                }
            } catch (e) {
                console.log('Method 2 failed:', e);
            }
        }
        
        // Method 3: Fallback to bounds center
        if (!centroid) {
            var bounds = layer.getBounds();
            centroid = bounds.getCenter();
            console.log(`Method 3 - Bounds center for farm ${item.id}:`, centroid);
        }

        // Create crop icon
        var cropIcon = getCropIcon(item.jenis_tanah);
        console.log(`Creating marker for farm ${item.id} with crop: ${item.jenis_tanah}, icon:`, cropIcon);
        
        var marker = L.marker(centroid, { 
            icon: cropIcon,
            title: item.jenis_tanah || 'Unknown Crop'
        }).addTo(map);

        // Marker popup
        marker.bindPopup(popupHtml);
        marker.bindTooltip(`${item.jenis_tanah || 'Unknown Crop'} — ${item.nama_pemiliklahan || 'Unknown Owner'}`, { direction: 'top' });
        markerLayers[item.id] = marker;
        
        console.log(`Marker created for farm ${item.id} at:`, centroid);

        // Zoom feature on polygon click
        layer.on('click', function() {
            map.fitBounds(layer.getBounds());
            layer.openPopup();
            marker.openPopup();
        });

        // Zoom feature on marker click
        marker.on('click', function() {
            map.setView(marker.getLatLng(), 18, { animate: true });
            marker.openPopup();
            layer.openPopup();
        });

    } catch(err) {
        console.error('Invalid GeoJSON for ID '+item.id, err);
    }
});

// Summary of markers created
console.log(`Total markers created: ${Object.keys(markerLayers).length}`);
console.log('Marker layers:', markerLayers);

// SEARCH BAR
var searchControl = L.control({ position: 'topright' });
searchControl.onAdd = function(map) {
    var div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.style.background = '#fff';
    div.style.padding = '5px';
    div.style.minWidth = '200px';
    div.innerHTML = `
        <input type="text" id="petaSearch" placeholder="Search land..." 
               style="width: 100%; padding: 5px; margin-bottom: 5px;">
        <div id="searchResults" style="max-height:150px; overflow-y:auto; font-size: 13px;"></div>
    `;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
searchControl.addTo(map);

// Legend control for crop icons
const legend = L.control({ position: 'bottomright' });
legend.onAdd = function(){
    const div = L.DomUtil.create('div', 'info legend');
    div.style.background = '#ffffffcc';
    div.style.padding = '8px 10px';
    div.style.border = '1px solid #ccc';
    div.style.borderRadius = '6px';
    div.style.maxHeight = '180px';
    div.style.overflowY = 'auto';

    const entries = [
        ['Rice', '🌾'],
        ['Corn', '🌽'],
        ['Vegetables', '🥬'],
        ['calamansi', '🍋‍🟩'],
        ['Coffee', '☕'],
        ['Coconut', '🥥'],
        ['Cocoa', '🍫'],
        ['Sugarcane', '🎋'],
        ['Beans', '🫘'],
        ['Tomato', '🍅'],
        [' Chili', '🌶️'],
        ['Banana', '🍌'],
        ['Mango', '🥭'],
        ['Cassava', '🥔'],
        ['Sweet Potato', '🍠'],
        ['Onion', '🧅'],
        ['🌱 Other Crops', '🌱'],
    ];
    div.innerHTML = entries.map(([label, svg]) => (
        `<div style="display:flex;align-items:center;gap:8px;margin:4px 0;">
            <span style="display:inline-block;width:20px;height:20px;">${svg}</span>
            <span style="font-size:12px;">${label}</span>
        </div>`
    )).join('');
    return div;
};
legend.addTo(map);

function searchPeta(query) {
    var resultsDiv = document.getElementById('searchResults');
    resultsDiv.innerHTML = '';
    var foundAny = false;

    petas.forEach(function(item) {
        if (
            item.nama_desa.toLowerCase().includes(query.toLowerCase()) ||
            item.nama_pemiliklahan.toLowerCase().includes(query.toLowerCase()) ||
            item.jenis_tanah.toLowerCase().includes(query.toLowerCase())
        ) {
            foundAny = true;

            var resultItem = document.createElement('div');
            resultItem.style.padding = '4px';
            resultItem.style.cursor = 'pointer';
            resultItem.style.borderBottom = '1px solid #ddd';
            resultItem.innerHTML = `<b>${item.nama_desa}</b><br>Owner: ${item.nama_pemiliklahan}<br>Soil: ${item.jenis_tanah}`;

            resultItem.addEventListener('click', function() {
                var polygon = polygonLayers[item.id];
                var marker = markerLayers[item.id];

                if(polygon.getBounds) map.fitBounds(polygon.getBounds());

                polygon.setStyle({ color: 'yellow', weight: 5 });
                setTimeout(() => {
                    polygon.setStyle({ color: originalColors[item.id].stroke, fillColor: originalColors[item.id].fill, weight: 2 });
                }, 2000);

                marker.openPopup();
                polygon.openPopup();
                resultsDiv.innerHTML = '';
            });

            resultsDiv.appendChild(resultItem);
        }
    });

    if (!foundAny && query.trim() !== '') {
        resultsDiv.innerHTML = '<div style="padding:4px;color:#999;">No matches found</div>';
    }
}

document.getElementById('petaSearch').addEventListener('input', function() {
    searchPeta(this.value);
});

// Refresh map when Livewire updates
document.addEventListener('livewire:load', function() {
    console.log('Livewire loaded - peta map should be ready');
});

document.addEventListener('livewire:update', function() {
    console.log('Livewire updated - refreshing peta map data');
    // Clear existing layers
    Object.values(polygonLayers).forEach(layer => map.removeLayer(layer));
    Object.values(markerLayers).forEach(marker => map.removeLayer(marker));
    polygonLayers = {};
    markerLayers = {};
    
    // Reload data (this will be handled by the page refresh)
    location.reload();
});
</script>
@endpush
</div>
