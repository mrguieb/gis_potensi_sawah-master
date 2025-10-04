<div>
    <div class="card">
        <div class="card-header"><h5>Report</h5></div>
        <div class="card-body">
            <div class="row">
                {{-- Tahun --}}
                <div class="col-md-4">
                    <label>Year</label>
                    <select class="form-control" wire:model="tahun">
                        <option value="">Select Year</option>
                        @for ($i = 2025; $i <= 2025; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Kecamatan --}}
                <div class="col-md-4">
                    <label>Municipality</label>
                    <select class="form-control" wire:model="kecamatan">
                        <option value="">Select Municipality</option>
                        @foreach ($town as $item)
                            <option value="{{ $item->id }}">{{ $item->town_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Desa --}}
                <div class="col-md-4">
                    <label>Barangay</label>
                    <select class="form-control" wire:model="desa">
                        <option value="">Select Barangay</option>
                        @foreach ($barangays as $item)
                            <option value="{{ $item->id }}">{{ $item->barangay_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            

            <button class="btn btn-primary mt-3" wire:click="cetakPdf">Preview PDF</button>

            @if($pdfUrl)
                <div class="mt-4">
                    <h5>PDF Preview:</h5>
                    <iframe id="pdfIframe" src="{{ $pdfUrl }}" width="100%" height="600px"></iframe>
                    <div class="mt-2">
                        <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-success">Open in New Tab</a>
                        <a href="{{ $pdfUrl }}" download class="btn btn-primary">Download PDF</a>
                        <button onclick="document.getElementById('pdfIframe').contentWindow.print()" class="btn btn-warning">Print</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
