@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/dashboard.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold">Panel de Control General</h2>
            <p class="text-muted">Monitoreo en tiempo real para la mina La Vidriosa.</p>
        </div>
    </div>

    <!-- Métrica de Módulos -->
    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom p-3 bg-white mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Personal en Mina</h6>
                        <h3 class="fw-bold text-success mb-0">0</h3>
                    </div>
                    <i class="fa-solid fa-user-check fa-2x text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-3 bg-white mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Registrados</h6>
                        <h3 class="fw-bold text-primary mb-0">0</h3>
                    </div>
                    <i class="fa-solid fa-id-card fa-2x text-primary"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-3 bg-white mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Puntos de Control</h6>
                        <h3 class="fw-bold text-warning mb-0">0</h3>
                    </div>
                    <i class="fa-solid fa-map-location-dot fa-2x text-warning"></i>
                </div>
            </div>
        </div>
    </div>
@endsection