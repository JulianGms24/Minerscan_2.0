<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MINERSCAN - Sistema de Control y Geolocalización</title>

    <!-- Librerías Externas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- CSS Base Estructural -->
    <link rel="stylesheet" href="{{ asset('css/base/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modules/chatbot.css') }}">

    @stack('styles')
</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- =======================================================
             SIDEBAR / MENÚ LATERAL
        ======================================================== -->

        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">

            <!-- Logo -->
            <div class="d-flex align-items-center mb-4 text-white text-decoration-none">

                <i class="fa-solid fa-hard-hat fa-2x text-warning me-2"></i>

                <span class="fs-4 fw-bold">
                    MINERSCAN
                </span>

            </div>

            <hr class="text-secondary">


            <!-- MENÚ PRINCIPAL -->
            <ul class="nav nav-pills flex-column mb-auto">

                <!-- ================= DASHBOARD ================= -->

                <li class="nav-item">

                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                        <i class="fa-solid fa-chart-line me-2"></i>

                        Dashboard

                    </a>

                </li>


                <!-- ============== MINEROS / TRABAJADORES ============== -->

                <li class="nav-item">

                    <a href="{{ route('workers.index') }}"
                       class="nav-link {{ request()->routeIs('workers.*') ? 'active' : '' }}">

                        <i class="fa-solid fa-users me-2"></i>

                        Mineros / Trabajadores

                    </a>

                </li>


                <!-- ================= ASISTENCIA ================= -->

                <li class="nav-item">

                    <a href="/attendance"
                       class="nav-link {{ request()->is('attendance*') ? 'active' : '' }}">

                        <i class="fa-solid fa-fingerprint me-2"></i>

                        Asistencia Biométrica

                    </a>

                </li>


                <!-- ================ GEOLOCALIZACIÓN ================ -->

                <li class="nav-item">

                    <a href="/geolocation"
                       class="nav-link {{ request()->is('geolocation*') ? 'active' : '' }}">

                        <i class="fa-solid fa-location-dot me-2"></i>

                        Geolocalización

                    </a>

                </li>


                <!-- =================== REPORTES =================== -->

                <li class="nav-item">

                    <a href="/reports"
                       class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">

                        <i class="fa-solid fa-file-invoice me-2"></i>

                        Reportes

                    </a>

                </li>

            </ul>

        </nav>


        <!-- =======================================================
             CONTENIDO PRINCIPAL
        ======================================================== -->

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">


            <!-- ================= BARRA SUPERIOR ================= -->

            <header class="navbar navbar-custom rounded mb-4 p-3 shadow-sm d-flex justify-content-between">

                <span class="fw-bold text-secondary">

                    La Vidriosa - Mina de Carbón

                </span>


                <!-- PERFIL ADMINISTRADOR -->

                <div class="dropdown">

                    <a href="#"
                       class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown">

                        <i class="fa-solid fa-user-shield me-2 text-primary"></i>

                        <strong>
                            {{ Auth::user()->name ?? 'Administrador' }}
                        </strong>

                    </a>


                    <ul class="dropdown-menu dropdown-menu-end text-small shadow">

                        <li>

                            <a class="dropdown-item" href="#">

                                Perfil

                            </a>

                        </li>


                        <li>

                            <hr class="dropdown-divider">

                        </li>


                        <li>

                            <!-- Botón cerrar sesión -->

                            <button type="button"
                                    class="dropdown-item text-danger fw-bold"
                                    data-bs-toggle="modal"
                                    data-bs-target="#logoutModal">

                                <i class="fa-solid fa-right-from-bracket me-2"></i>

                                Cerrar Sesión

                            </button>

                        </li>

                    </ul>

                </div>

            </header>


            <!-- ================= CONTENIDO ================= -->

            @yield('content')


        </main>

    </div>

</div>



<!-- ==========================================================
     MODAL DE CONFIRMACIÓN PARA CERRAR SESIÓN
=========================================================== -->

<div class="modal fade"
     id="logoutModal"
     tabindex="-1"
     aria-labelledby="logoutModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <!-- CABECERA -->

            <div class="modal-header bg-dark text-white">

                <h5 class="modal-header-title mb-0 fs-5"
                    id="logoutModalLabel">

                    <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>

                    Confirmar Cierre de Sesión

                </h5>


                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                </button>

            </div>


            <!-- CUERPO -->

            <div class="modal-body p-4 text-center">

                <p class="fs-5 text-secondary mb-0">

                    ¿Está seguro de que desea salir del sistema MINERSCAN?

                </p>

            </div>


            <!-- BOTONES -->

            <div class="modal-footer justify-content-center border-0 pb-4">

                <button type="button"
                        class="btn btn-secondary px-4 py-2"
                        data-bs-dismiss="modal">

                    Cancelar

                </button>


                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit"
                            class="btn btn-danger px-4 py-2 fw-bold">

                        Sí, Cerrar Sesión

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>



<!-- ==========================================================
     BLOQUEO DE NAVEGACIÓN HACIA ATRÁS
=========================================================== -->

<script>

    (function () {

        // Creamos una entrada adicional en el historial
        window.history.pushState(
            null,
            '',
            window.location.href
        );


        // Bloqueamos el botón Atrás
        window.addEventListener('popstate', function () {

            window.history.pushState(
                null,
                '',
                window.location.href
            );

        });


        // Evitamos recuperar páginas autenticadas
        // desde la caché del navegador.
        window.addEventListener('pageshow', function (event) {

            if (event.persisted) {

                window.location.reload();

            }

        });

    })();

</script>



<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


@yield('scripts')
@auth
    @include('chatbot.assistant')
@endauth

</body>
</html>