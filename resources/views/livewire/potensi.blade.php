<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Land Area Information') }}</div>

                    <div class="card-body">
                        <!-- Add Button -->
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button class="btn btn-primary" wire:click='tambah'>Add Data</button>
                            </div>
                        </div>

                        <!-- Pagination & Search -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <select wire:model="perPage" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" wire:model="search" class="form-control" placeholder="Search">
                            </div>
                        </div>

                        <!-- Success Message -->
                        @if(session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <!-- Data Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Barangay</th>
                                    <th>Farmer/Land Owner</th>
                                    <th>Crop Type</th>
                                    <th>Land Area</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($potensi as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->barangay_name }}</td>
                                        <td>{{ $item->farmer_name }}</td>
                                        <td>{{ $item->crop_type }}</td>
                                        <td>{{ $item->land_area }} m²</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm mb-1" wire:click="potensiId({{ $item->id }})">Edit</button>
                                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $item->id }})">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $potensi->links() }}

                        <!-- Modal: Add/Update Form -->
                        <div class="modal fade" id="potensiModal" tabindex="-1" aria-labelledby="potensiModalLabel" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $isUpdate ? 'Update Data' : 'Add Data' }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="potensiForm" wire:submit.prevent='{{ $isUpdate ? "update" : "store" }}'>
                                            @csrf
                                            <!-- Barangay -->
                                            <div class="mt-2">
                                                <label>Barangay</label>
                                                <select wire:model="barangay_id" class="form-control">
                                                    <option value="">Pick Barangay</option>
                                                    @foreach($desa as $d)
                                                        <option value="{{ $d->id }}">{{ $d->barangay_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('barangay_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Farmer -->
                                            <div class="mt-2" style="position: relative;">
                                                <label>Farmer/Land Owner</label>
                                                <input type="text" wire:model="searchFarmer" class="form-control" placeholder="Search Farmer/Land Owner...">
                                                @error('farmer_id') <span class="text-danger">{{ $message }}</span> @enderror

                                                @if(!empty($pemiliklahan) && strlen($searchFarmer) > 0)
                                                    <ul class="list-group position-absolute w-100 mt-1" style="z-index: 1000; max-height: 150px; overflow-y: auto;">
                                                        @foreach($pemiliklahan as $p)
                                                            <li class="list-group-item list-group-item-action" 
                                                                wire:click="selectFarmer({{ $p->id }}, '{{ $p->farmer_name }}')">
                                                                {{ $p->farmer_name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>


                                            <!-- Crop Type -->
                                            <div class="mt-2">
                                                <label>Crop Type</label>
                                                <select wire:model="crop_id" class="form-control">
                                                    <option value="">Pick Crop Type</option>
                                                    @foreach($infotanah as $i)
                                                        <option value="{{ $i->id }}">{{ $i->crop_type }}</option>
                                                    @endforeach
                                                </select>
                                                @error('crop_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Land Area -->
                                            <div class="mt-2">
                                                <label>Land Area (m²)</label>
                                                <input 
                                                    type="number" 
                                                    step="0.01" 
                                                    wire:model="land_area" 
                                                    class="form-control @error('land_area') is-invalid @enderror">
                                                @error('land_area') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>


                                            <!-- Upload -->
                                            <div class="mt-2">
                                                <label>Upload GeoJSON/JSON</label>
                                                <input type="file" id="file-upload" class="form-control" accept=".geojson,.json">
                                            </div>

                                            <!-- Map -->
                                            <div class="mt-2">
                                                <div id="map" style="width: 100%; height: 400px;" wire:ignore></div>
                                            </div>

                                            <!-- Boundaries -->
                                            <div class="mt-2">
                                                <label>Land Boundaries (GeoJSON)</label>
                                                <textarea class="form-control" id="get-data" rows="5" wire:model="land_boundaries"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" form="potensiForm" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map Script -->
                        @push('scripts')
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@2.14.0/dist/leaflet-geoman.css" />
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@2.14.0/dist/leaflet-geoman.min.js"></script>
<script>
document.addEventListener('livewire:load', () => {
    // Default center and zoom
    const defaultCenter = [16.8921, 120.4266];
    const defaultZoom = 13;

    const map = L.map('map', { minZoom: 12 }).setView(defaultCenter, defaultZoom);
    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles © Esri'
    }).addTo(map);

    let polygonLayerGroup = L.layerGroup().addTo(map);
    let markerLayerGroup = L.layerGroup().addTo(map);

    map.pm.addControls({ position: 'topleft', drawPolygon: true, editMode: true, removalMode: true });

    function getCropIcon(type) {
        const name = (type || '').toLowerCase();
        let iconPath = '/images/icons/default.png';
        if (name.includes('rice')) iconPath = '/images/icons/rice.png';
        else if (name.includes('corn')) iconPath = '/images/icons/corn.png';
        else if (name.includes('calamansi')) iconPath = '/images/icons/calamansi.png';
        else if (name.includes('eggplant')) iconPath = '/images/icons/eggplant.png';
        else if (name.includes('cassava')) iconPath = '/images/icons/cassava.png';
        return L.icon({ iconUrl: iconPath, iconSize: [32, 32] });
    }

    function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    function updateTextarea() {
        const geojson = polygonLayerGroup.toGeoJSON();
        @this.set('land_boundaries', JSON.stringify(geojson));
        document.getElementById('get-data').value = JSON.stringify(geojson);
    }

    // ✅ Zoom with a max zoom limit
    function zoomToBounds(bounds) {
        map.fitBounds(bounds, { maxZoom: 16 }); // Prevent zooming out too far
    }

    // Draw polygons and fit bounds but keep closer zoom
    function drawPolygons(lahan, fitAll = true) {
        polygonLayerGroup.clearLayers();
        markerLayerGroup.clearLayers();

        let allBounds = [];

        lahan.forEach(item => {
            if (item.land_boundaries) {
                try {
                    const geojson = JSON.parse(item.land_boundaries);
                    const geoLayer = L.geoJSON(geojson, { style: { color: getRandomColor(), fillOpacity: 0.5 } })
                        .on('click', function () { zoomToBounds(this.getBounds()); })
                        .addTo(polygonLayerGroup);

                    geoLayer.eachLayer(layer => {
                        if (layer.getBounds) {
                            allBounds.push(layer.getBounds());
                            const center = layer.getBounds().getCenter();
                            const popup = `<b>${item.crop_type || 'Crop'}</b><br>Barangay: ${item.barangay_name || '-'}<br>Owner: ${item.farmer_name || '-'}<br>Land: ${item.land_area || '-'} m²`;
                            L.marker(center, { icon: getCropIcon(item.crop_type) }).bindPopup(popup).addTo(markerLayerGroup);
                            layer.bindPopup(popup);
                        }
                    });
                } catch (e) { console.error('Invalid GeoJSON', e); }
            }
        });

        // Only zoom if there are polygons
        if (fitAll && allBounds.length > 0) {
            let combinedBounds = allBounds[0];
            for (let i = 1; i < allBounds.length; i++) {
                combinedBounds = combinedBounds.extend(allBounds[i]);
            }
            zoomToBounds(combinedBounds);
        } else {
            // If no polygons, reset to default view
            map.setView(defaultCenter, defaultZoom);
        }
    }

    // Load polygons from DB
    let lahan = {!! json_encode($lahan->toArray()) !!};
    drawPolygons(lahan, true);

    window.addEventListener('refreshMap', e => drawPolygons(e.detail.lahan, true));

    // Update GeoJSON after editing
    map.on('pm:create', e => { polygonLayerGroup.addLayer(e.layer); updateTextarea(); zoomToBounds(e.layer.getBounds()); });
    map.on('pm:edit', updateTextarea);
    map.on('pm:remove', updateTextarea);

    // ✅ Preview & zoom when uploading GeoJSON
    document.getElementById('file-upload').addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            try {
                const geojson = JSON.parse(ev.target.result);
                polygonLayerGroup.clearLayers();
                const layer = L.geoJSON(geojson, { style: { color: getRandomColor(), fillOpacity: 0.5 } })
                    .on('click', function () { zoomToBounds(this.getBounds()); })
                    .addTo(polygonLayerGroup);
                zoomToBounds(layer.getBounds());
                updateTextarea();
            } catch { alert('Invalid GeoJSON'); }
        };
        reader.readAsText(file);
    });

    // Modal events
    window.addEventListener('open-potensi-modal', () => {
        const modal = new bootstrap.Modal(document.getElementById('potensiModal'));
        modal.show();
        setTimeout(() => map.invalidateSize(), 300);
    });

    window.addEventListener('close-potensi-modal', () => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('potensiModal'));
        if (modal) modal.hide();
    });
});
</script>
@endpush

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
