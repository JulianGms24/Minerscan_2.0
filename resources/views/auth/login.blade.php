<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MINERSCAN - Autenticación Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #0f172a; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #ffffff; border-radius: 16px; width: 100%; max-width: 480px; padding: 35px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.3); }
        .nav-pills .nav-link { color: #64748b; font-weight: 600; border-radius: 8px; }
        .nav-pills .nav-link.active { background-color: #0284c7; color: #ffffff; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-3">
            <i class="fa-solid fa-hard-hat fa-3x text-warning mb-2"></i>
            <h3 class="fw-bold text-dark mb-0">MINERSCAN</h3>
            <p class="text-muted small">Mina La Vidriosa - Control Administrativo</p>
        </div>

        <!-- Pestañas para Alternar entre Login y Registro -->
        <ul class="nav nav-pills nav-justified mb-4" id="authTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login-panel" type="button" role="tab">Iniciar Sesión</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-panel" type="button" role="tab">Registrar Admin</button>
            </li>
        </ul>

        <!-- Mostrar Errores de Validación General -->
        @if ($errors->any())
            <div class="alert alert-danger py-2 fs-6">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="tab-content" id="authTabContent">
            <!-- Formulario de Inicio de Sesión -->
            <div class="tab-pane fade show active" id="login-panel" role="tabpanel">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control py-2" value="{{ old('email') }}" placeholder="admin@lavidriosa.com" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Contraseña</label>
                        <input type="password" name="password" class="form-control py-2" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-3" style="border-radius: 8px; background-color: #0284c7;">
                        Ingresar al Sistema
                    </button>
                </form>
            </div>

            <!-- Formulario de Registro de Administrador -->
            <div class="tab-pane fade" id="register-panel" role="tabpanel">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Nombre Completo</label>
                        <input type="text" name="name" class="form-control py-2" placeholder="Ej: Carlos Mendoza" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control py-2" placeholder="admin@lavidriosa.com" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Contraseña</label>
                        <input type="password" name="password" class="form-control py-2" placeholder="Mínimo 6 caracteres" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control py-2" placeholder="Repite la contraseña" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold mb-3" style="border-radius: 8px;">
                        Crear Cuenta Administrador
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-2">
            <a href="{{ url('/') }}" class="text-decoration-none text-muted small">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver a la página principal
            </a>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para Prevenir Regresar con la Flecha del Navegador si la Sesión está Activa -->
    <script>
        window.onload = function () {
            if (window.history && window.history.pushState) {
                window.history.pushState('forward', null, './login');
                window.onpopstate = function () {
                    window.history.pushState('forward', null, './login');
                };
            }
        }
    </script>
</body>
</html>