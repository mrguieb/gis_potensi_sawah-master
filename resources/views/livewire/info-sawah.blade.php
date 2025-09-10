<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Crop Information') }}</div>

                    <div class="card-body">
                        {{-- add button --}}
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Crop</a>
                            </div>
                        </div>
                        <br>

                        {{-- per page & search --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select wire:model="perPage" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" wire:model="search" class="form-control" placeholder="Search Crop">
                            </div>
                        </div>

                        {{-- table --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Crop Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($infotanahs as $item)
                                            <tr>
                                                <td>{{ $item->jenis_tanah }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="tanahId({{ $item->id }})">Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="tanahId({{ $item->id }})">Delete</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2" class="text-center">No crops available.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Crop Modal --}}
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Crop</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-left">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="jenis_tanah">{{ __('Crop Type') }}</label>
                            <select id="jenis_tanah" class="form-control @error('jenis_tanah') is-invalid @enderror" wire:model="jenis_tanah" required>
                                <option value="">-- Select Crop --</option>
                                <option value="Palay/Rice">Palay/Rice</option>
                                <option value="Calamansi">Calamansi</option>
                                <option value="Corn">Corn</option>
                            </select>
                            @error('jenis_tanah')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" @if($jenis_tanah=='') disabled @endif>Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Crop Modal --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Crop</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-left">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="jenis_tanah">{{ __('Crop Type') }}</label>
                            <select id="jenis_tanah" class="form-control @error('jenis_tanah') is-invalid @enderror" wire:model="jenis_tanah" required>
                                <option value="">-- Select Crop --</option>
                                <option value="Palay/Rice">Palay/Rice</option>
                                <option value="Calamansi">Calamansi</option>
                                <option value="Corn">Corn</option>
                            </select>
                            @error('jenis_tanah')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" @if($jenis_tanah=='') disabled @endif>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Crop Modal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Crop</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this crop?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
