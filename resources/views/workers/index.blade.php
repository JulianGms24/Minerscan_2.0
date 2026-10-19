@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/workers.css') }}">
@endpush

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show workers-success-alert"
         role="alert">

        <i class="fa-solid fa-circle-check me-2"></i>

        <strong>{{ session('success') }}</strong>

    </div>
@endif
<div class="workers-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Personal de la Mina</h2>
            <p class="text-muted mb-0">
                Gestión y control del personal registrado en Mina La Vidriosa.
            </p>
        </div>

        <a href="{{ route('workers.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus me-2"></i>
            Registrar trabajador
        </a>
    </div>

    <div class="card card-custom border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold">
                <i class="fa-solid fa-users me-2"></i>
                Trabajadores registrados
            </h5>
        </div>

        <div class="card-body">

            @if($workers->count() > 0)

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($workers as $worker)

                                <tr>
                                    <td>
                                        <strong>
                                            {{ $worker->first_name }}
                                            {{ $worker->last_name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $worker->document_number }}
                                    </td>

                                    <td>
                                        {{ $worker->phone ?? 'No registrado' }}
                                    </td>

                                    <td>
                                        @if($worker->is_active)
                                            <span class="badge bg-success">
                                                Activo
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="fa-solid fa-users-slash fa-3x text-muted mb-3"></i>

                    <h5 class="fw-bold">
                        No hay trabajadores registrados
                    </h5>

                    <p class="text-muted mb-0">
                        Cuando se registre personal, aparecerá en esta sección.
                    </p>

                </div>

            @endif

        </div>
    </div>

</div>

@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const alert = document.querySelector('.workers-success-alert');

        if (alert) {
            setTimeout(function () {

                alert.classList.remove('show');

                setTimeout(function () {
                    alert.remove();
                }, 300);

            }, 3000);
        }

    });
</script>
@endsection