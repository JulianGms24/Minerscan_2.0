@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/workers.css') }}">
@endpush

@section('content')

<div class="workers-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Registrar trabajador</h2>
            <p class="text-muted mb-0">
                Registre la información del personal de Mina La Vidriosa.
            </p>
        </div>

        <a href="{{ route('workers.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Volver
        </a>
    </div>

    <div class="card card-custom border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold">
                <i class="fa-solid fa-user-plus me-2"></i>
                Información del trabajador
            </h5>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Por favor, revise los siguientes datos:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('workers.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label fw-semibold">
                            Nombre *
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label fw-semibold">
                            Apellido *
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            required
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label fw-semibold">
                            Rol del trabajador *
                        </label>

                        <select
                            class="form-select"
                            id="role"
                            name="role"
                            required
                        >
                            <option value="">Seleccione un rol</option>
                            <option value="Minero" {{ old('role') == 'Minero' ? 'selected' : '' }}>
                                Minero
                            </option>
                            <option value="Supervisor" {{ old('role') == 'Supervisor' ? 'selected' : '' }}>
                                Supervisor
                            </option>
                            <option value="Operador" {{ old('role') == 'Operador' ? 'selected' : '' }}>
                                Operador
                            </option>
                            <option value="Mantenimiento" {{ old('role') == 'Mantenimiento' ? 'selected' : '' }}>
                                Mantenimiento
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="shift" class="form-label fw-semibold">
                            Turno *
                        </label>

                        <select
                            class="form-select"
                            id="shift"
                            name="shift"
                            required
                        >
                            <option value="">Seleccione un turno</option>
                            <option value="6:00 AM - 1:00 PM" {{ old('shift') == '6:00 AM - 1:00 PM' ? 'selected' : '' }}>
                                6:00 AM - 1:00 PM
                            </option>
                            <option value="2:00 PM - 7:00 PM" {{ old('shift') == '2:00 PM - 7:00 PM' ? 'selected' : '' }}>
                                2:00 PM - 7:00 PM
                            </option>
                            <option value="7:00 PM - 2:00 AM" {{ old('shift') == '7:00 PM - 2:00 AM' ? 'selected' : '' }}>
                                7:00 PM - 2:00 AM
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="document_number" class="form-label fw-semibold">
                            Número de documento *
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="document_number"
                            name="document_number"
                            value="{{ old('document_number') }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-semibold">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="eps" class="form-label fw-semibold">
                            EPS
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="eps"
                            name="eps"
                            value="{{ old('eps') }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="arl" class="form-label fw-semibold">
                            ARL
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="arl"
                            name="arl"
                            value="{{ old('arl') }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact_name" class="form-label fw-semibold">
                            Nombre del contacto de emergencia
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="emergency_contact_name"
                            name="emergency_contact_name"
                            value="{{ old('emergency_contact_name') }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact_phone" class="form-label fw-semibold">
                            Teléfono de emergencia
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="emergency_contact_phone"
                            name="emergency_contact_phone"
                            value="{{ old('emergency_contact_phone') }}"
                        >
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('workers.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus me-2"></i>
                        Registrar trabajador
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection