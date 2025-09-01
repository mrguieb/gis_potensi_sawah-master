<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Land Area Information') }}</div>

                    <div class="card-body">
                        {{-- Add Data Button --}}
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button class="btn btn-primary" wire:click='tambah'>Add Data</button>
                            </div>
                        </div>

                        {{-- Pagination & Search --}}
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <select wire:model="perPage" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="30">35</option>
                                    <option value="30">40</option>
                                    <option value="30">45</option>
                                    <option value="30">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" wire:model="search" class="form-control" placeholder="Search">
                            </div>
                        </div>

                        {{-- Success Message --}}
                        @if(session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        {{-- Data Table --}}
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Barangay</th>
                                            <th>Farmer/Land Owner</th>
                                            <th>Land</th>
                                            <th>Land Boundaries</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($potensi as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->nama_desa }}</td>
                                                <td>{{ $item->nama_pemiliklahan }}</td>
                                                <td>{{ $item->luas_lahan }}</td>
                                                <td>{{ $item->batas_lahan }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm mb-1" wire:click="potensiId({{ $item->id }})">Edit</button>
                                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $item->id }})">Delete</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data not found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Add/Update Form --}}
                        @if($isTambah || $isUpdate)
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <form wire:submit.prevent='{{ $isUpdate ? "update" : "store" }}' enctype="multipart/form-data">
                                    @csrf
                                    
                                    {{-- Barangay --}}
                                    <div class="form-group mt-2">
                                        <label>Barangay</label>
                                        <select wire:model="desa_id" class="form-control">
                                            <option value="">Pick Barangay</option>
                                            @foreach($desa as $d)
                                                <option value="{{ $d->id }}">{{ $d->nama_desa }}</option>
                                            @endforeach
                                        </select>
                                        @error('desa_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Farmer/Land Owner --}}
                                    <div class="form-group mt-2">
                                        <label>Farmer/Land Owner</label>
                                        <select wire:model="pemiliklahan_id" class="form-control">
                                            <option value="">Pick Farmer/Land Owner</option>
                                            @foreach($pemiliklahan as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_pemiliklahan }}</option>
                                            @endforeach
                                        </select>
                                        @error('pemiliklahan_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Soil Type --}}
                                    <div class="form-group mt-2">
                                        <label>Soil Type</label>
                                        <select wire:model="infotanah_id" class="form-control">
                                            <option value="">Pick Soil Type</option>
                                            @foreach($infotanah as $i)
                                                <option value="{{ $i->id }}">{{ $i->jenis_tanah }}</option>
                                            @endforeach
                                        </select>
                                        @error('infotanah_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Land Area --}}
                                    <div class="form-group mt-2">
                                        <label>Land (m²)</label>
                                        <input type="number" wire:model="luas_lahan" class="form-control">
                                        @error('luas_lahan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- File Upload --}}
                                    <div class="form-group mt-2">
                                        <label>Upload GeoJSON/JSON</label>
                                        <input type="file" id="file-upload" class="form-control" accept=".geojson,.json">
                                    </div>

                                    {{-- Map --}}
                                    <div class="form-group mt-2">
                                        <div id="map" style="width: 100%; height: 400px;" wire:ignore></div>
                                    </div>

                                    {{-- Land Boundaries --}}
                                    <div class="form-group mt-2">
                                        <label>Land Boundaries (GeoJSON)</label>
                                        <textarea class="form-control" id="get-data" rows="5" wire:model="batas_lahan"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@2.14.0/dist/leaflet-geoman.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@2.14.0/dist/leaflet-geoman.css"/>

<script>
document.addEventListener('livewire:load', () => {
    const map = L.map('map').setView([16.8921, 120.4266], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">2022</a>',
        maxZoom: 23,
        id: 'mapbox/satellite-streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoib2tpbmluYW0iLCJhIjoiY21lYTZxazBqMGFzZjJpc2l5b2dyeHN0dCJ9.-nx4JkNuM_zjmW_Tq9RE3w'
    }).addTo(map);

    // LayerGroup for polygons
    let polygonLayerGroup = L.layerGroup().addTo(map);

    // Load existing polygons from database
    let lahan = {!! json_encode($lahan->toArray()) !!};
    lahan.forEach(item => {
        if(item.batas_lahan){
            try {
                const geojson = JSON.parse(item.batas_lahan);
                L.geoJSON(geojson, { style: { color: getRandomColor(), fillOpacity: 0.5 } })
                    .addTo(polygonLayerGroup);
            } catch(err){
                console.error('Invalid GeoJSON:', err);
            }
        }
    });

    // Geoman controls
    map.pm.addControls({
        position: 'topleft',
        drawCircle: false,
        drawMarker: false,
        drawPolyline: false,
        drawRectangle: false,
        drawCircleMarker: false,
        drawPolygon: true,
        editMode: true,
        removalMode: true,
    });

    function getRandomColor() {
        let letters = '0123456789ABCDEF';
        let color = '#';
        for(let i=0; i<6; i++){ color += letters[Math.floor(Math.random()*16)]; }
        return color;
    }

    function updateTextarea(){
        const geojson = polygonLayerGroup.toGeoJSON();
        const geojsonStr = JSON.stringify(geojson);
        @this.set('batas_lahan', geojsonStr);
        document.getElementById('get-data').value = geojsonStr;
    }

    // Sync textarea on create/edit/remove
    map.on('pm:create', e => {
        polygonLayerGroup.addLayer(e.layer);
        updateTextarea();
    });
    map.on('pm:edit', updateTextarea);
    map.on('pm:remove', updateTextarea);

    // File upload handler
    document.getElementById('file-upload').addEventListener('change', function(e){
        const file = e.target.files[0];
        if(!file) return;

        const ext = file.name.split('.').pop().toLowerCase();
        if(ext !== 'geojson' && ext !== 'json'){
            alert('Only GeoJSON or JSON files are supported.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event){
            try {
                const geojson = JSON.parse(event.target.result);
                polygonLayerGroup.clearLayers();
                L.geoJSON(geojson, { style: { color: getRandomColor(), fillOpacity: 0.5 } })
                    .addTo(polygonLayerGroup);

                // Fit map to polygon bounds safely
                const layers = polygonLayerGroup.getLayers();
                if(layers.length > 0){
                    const bounds = L.featureGroup(layers).getBounds();
                    map.fitBounds(bounds);
                }

                updateTextarea();
            } catch(err){
                alert('Error parsing file: ' + err.message);
            }
        };
        reader.readAsText(file);
    });
});
</script>
@endpush

</div>
