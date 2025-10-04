@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <!-- Header Card -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-success text-white text-center py-4">
                    <img src="{{ asset('img/logo1.png') }}" 
                         alt="Logo" 
                         class="img-fluid mb-3" 
                         style="max-width: 200px; height: auto;">
                    
                    <h3 class="fw-bold mb-1">Geographical Information System</h3>
                    <h1 class="h4 fw-semibold">AGRI BANGAR OFFICE FOR AGRICULTURAL SERVICE</h1>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="row g-3">

                        <!-- Crop Type -->
                        <div class="col-md-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-primary text-white text-center">
                                    <i class="fas fa-seedling fa-2x mb-2"></i>
                                    <h5 class="mb-0">Crop Types</h5>
                                </div>
                                <div class="card-body bg-dark text-white d-flex align-items-center justify-content-center">
                                    <h1 class="display-5 fw-bold mb-0">{{ count($infotanah) }}</h1>
                                </div>
                            </div>
                        </div>

                        <!-- Land/Farm Owner -->
                        <div class="col-md-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-warning text-white text-center">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h5 class="mb-0">Land / Farm Owners</h5>
                                </div>
                                <div class="card-body bg-dark text-white d-flex align-items-center justify-content-center">
                                    <h1 class="display-5 fw-bold mb-0">{{ count($pemiliklahan) }}</h1>
                                </div>
                            </div>
                        </div>

                        <!-- Village / Barangay -->
                        <div class="col-md-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-success text-white text-center">
                                    <i class="fas fa-building fa-2x mb-2"></i>
                                    <h5 class="mb-0">Barangays</h5>
                                </div>
                                <div class="card-body bg-dark text-white d-flex align-items-center justify-content-center">
                                    <h1 class="display-5 fw-bold mb-0">{{ count($desa) }}</h1>
                                </div>
                            </div>
                        </div>

                        <!-- Farms / Lands -->
                        <div class="col-md-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-danger text-white text-center">
                                    <i class="fas fa-globe fa-2x mb-2"></i>
                                    <h5 class="mb-0">Farms / Lands</h5>
                                </div>
                                <div class="card-body bg-dark text-white d-flex align-items-center justify-content-center">
                                    <h1 class="display-5 fw-bold mb-0">{{ count($potensi) }}</h1>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End row -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
