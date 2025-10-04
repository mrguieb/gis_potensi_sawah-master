<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Crop Information') }}</div>

                    <div class="card-body">
                        {{-- Add button --}}
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Crop</a>
                            </div>
                        </div>

                        {{-- Per page & search --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select wire:model="perPage" class="form-control">
                                    @foreach([5,10,15,20,25,30,35,40,45,50,100] as $num)
                                        <option value="{{ $num }}">{{ $num }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" wire:model="search" class="form-control" placeholder="Search Crop">
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Crop Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($crops as $item)
                                    <tr>
                                        <td>{{ $item->crop_type }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="tanahId({{ $item->id }})">Edit</a>
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
                            {{ $crops->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Crop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="mb-3">
                            <label>Crop Type</label>
                            <input type="text" class="form-control @error('crop_type') is-invalid @enderror" wire:model="crop_type" placeholder="Enter crop type">
                            @error('crop_type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" @if($crop_type=='') disabled @endif>Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Crop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label>Crop Type</label>
                            <input type="text" class="form-control @error('crop_type') is-invalid @enderror" wire:model="crop_type" placeholder="Enter crop type">
                            @error('crop_type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" @if($crop_type=='') disabled @endif>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Crop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this crop?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Close modals with Livewire --}}
<script>
    window.addEventListener('close-modal', event => {
        var addModal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
        if(addModal) addModal.hide();

        var editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        if(editModal) editModal.hide();

        var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        if(deleteModal) deleteModal.hide();
    });
</script>
