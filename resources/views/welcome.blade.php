<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MINERSCAN - Seguridad y Control Biométrico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modules/landing.css') }}">
</head>
<body class="bg-light">

    <!-- Navegación Pública -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background-color: #0f172a;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="{{ url('/') }}">
                <i class="fa-solid fa-hard-hat text-warning me-2"></i> MINERSCAN
            </a>
            <!-- Botón que redirige a la pantalla de Login -->
            <a href="{{ url('/login') }}" class="btn btn-login fw-bold">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Iniciar Sesión
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center text-lg-start mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-bold">Mina La Vidriosa</span>
                    <h1 class="hero-title mb-3">Gestión inteligente de personal y geolocalización subterránea</h1>
                    <p class="lead mb-4" style="color: #cbd5e1;">
                        Plataforma de alta precisión para el registro biométrico de asistencia y el rastreo de ubicación en tiempo real dentro y fuera del socavón.
                    </p>
                    <a href="{{ url('/login') }}" class="btn btn-warning btn-lg fw-bold text-dark px-4 py-3">
                        Acceder a la Plataforma <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/hero-mining.svg') }}" alt="MinerScan System" class="img-fluid rounded-3 shadow-lg" style="max-height: 380px;">
                </div>
            </div>
        </div>
    </header>

    <!-- Sección ¿Qué hace MINERSCAN? -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">¿Qué hace MINERSCAN?</h2>
            <p class="text-muted">Solución integral diseñada para optimizar la seguridad operativa e industrial.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-primary text-white">
                        <i class="fa-solid fa-fingerprint"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Biometría Rigurosa</h4>
                    <p class="text-muted mb-0">Control de acceso instantáneo mediante validación de huella digital para trabajadores e ingenieros de mina.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-warning text-dark">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Geolocalización GPS</h4>
                    <p class="text-muted mb-0">Rastreo con geocercas activas para la supervisión y delimitación de seguridad en zonas subterráneas y superficie.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-success text-white">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Analítica en Tiempo Real</h4>
                    <p class="text-muted mb-0">Dashboard interactivo con reportes de aforo, turnos de trabajo e historial de ausentismo para supervisores.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>