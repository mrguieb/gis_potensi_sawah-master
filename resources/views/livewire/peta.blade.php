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

// Unique colors based on ID
function getColorFromId(id) {
    var hue = (id * 137.508) % 360; // golden angle
    return `hsl(${hue}, 70%, 50%)`;
}

petas.forEach(function(item) {
    if (!item.batas_lahan) return;

    try {
        var geojson = JSON.parse(item.batas_lahan);

        var strokeColor = getColorFromId(item.id);
        var fillColor = getColorFromId(item.id + 1000);

        var layer = L.geoJSON(geojson, {
            style: { color: strokeColor, fillColor: fillColor, fillOpacity: 0.6 }
        }).addTo(map);

        polygonLayers[item.id] = layer;
        originalColors[item.id] = { stroke: strokeColor, fill: fillColor };

        // Popup for polygon
        layer.bindPopup(
            `<b>ID:</b> ${item.id}<br>
            <b>Village:</b> ${item.nama_desa}<br>
            <b>Land Owner:</b> ${item.nama_pemiliklahan}<br>
            <b>Soil Type:</b> ${item.jenis_tanah}<br>
            <b>Elevation:</b> ${item.ketinggian} mdpl<br>
            <b>Humidity:</b> ${item.kelembaban}%<br>
            <b>Land Area:</b> ${item.luas_lahan} m²`
        );

        // Marker at polygon centroid
        var latlngs = layer.getLayers()[0].getLatLngs()[0];
        var centroid = latlngs.reduce((acc, val) => [acc[0]+val.lat, acc[1]+val.lng], [0,0]).map(v => v/latlngs.length);

        var marker = L.marker(centroid, {
            icon: L.divIcon({
                className: 'custom-marker',
                html: `
                    <div style="
                        width: 40px;
                        height: 40px;
                        border: 3px solid black;
                        border-radius: 50%;
                        background: white;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                        font-weight:bold;
                        color: ${strokeColor};
                        box-shadow: 1px 1px 4px rgba(0,0,0,0.4);
                    ">
                        <i class="fa fa-map-marker" style="font-size: 22px;"></i>
                    </div>
                `,
                iconSize: [40, 40],
                iconAnchor: [20, 40],
            })
        }).addTo(map);

        // Marker popup
        marker.bindPopup(`<b>Farmer:</b> ${item.nama_pemiliklahan}<br><b>Barangay:</b> ${item.nama_desa}`);
        markerLayers[item.id] = marker;

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
</script>
@endpush
</div>
