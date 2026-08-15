<?php
// Datos de Servicios (Carrusel 1)
$servicios = [
    [
        'titulo' => 'Servicio sencillo - Carro',
        'descripcion' => 'Ideal para quienes buscan una limpieza rápida, efectiva y económica para el día a día.',
        'imagen' => 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=600&q=80',
        'items' => [
            'Pre-lavado con agua a presión para eliminar lodo y polvo grueso.',
            'Lavado con champú automotriz de pH neutro (evita daños en la pintura).',
            'Limpieza básica de rines y llantas.',
            'Secado a mano con paños de microfibra.'
        ],
        'btn_texto' => 'Hacer reserva',
        'btn_link' => 'reservar.php?servicio=sencillo-carro'
    ],
    [
        'titulo' => 'Plan premium - Carro',
        'descripcion' => 'El servicio consentido para conservar el valor del vehículo, recuperar el brillo y desinfectar el interior.',
        'imagen' => 'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?auto=format&fit=crop&w=600&q=80',
        'items' => [
            'Todo lo del lavado sencillo, más:',
            'Lavado con espuma activa (Foam Cannon) que encapsula la suciedad sin rayar.',
            'Limpieza profunda y detallada de rines, guardabarros y remoción de alquitrán o insectos pegados.',
            'Aplicación de cera líquida de alta gama o sellador cerámico rápido para dar brillo espejo y protección hidrofóbica.'
        ],
        'btn_texto' => 'Hacer reserva',
        'btn_link' => 'reservar.php?servicio=premium-carro'
    ],
    [
        'titulo' => 'Plan sencillo - Moto',
        'descripcion' => 'Limpieza rápida para rodar limpio y retirar la suciedad de la ruta.',
        'imagen' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=600&q=80',
        'items' => [
            'Enjuague a presión controlado (cuidando componentes eléctricos).',
            'Lavado con champú especial para motocicletas.',
            'Limpieza de rines y llantas.',
            'Secado con microfibra y aire a presión para eliminar agua atrapada.'
        ],
        'btn_texto' => 'Hacer reserva',
        'btn_link' => 'reservar.php?servicio=sencillo-moto'
    ],
    [
        'titulo' => 'Plan premium - Moto',
        'descripcion' => 'Para los motociclistas más exigentes que buscan protección total y un acabado de exhibición.',
        'imagen' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?auto=format&fit=crop&w=600&q=80',
        'items' => [
            'Todo lo del lavado sencillo, más:',
            'Desengrasado profundo del motor, escape y zonas bajas con productos dieléctricos.',
            'Lavado con espuma activa para evitar micro-rayones en el carenado o tanque.',
            'Limpieza, desengrasado y lubricación de la cadena con insumos de alta viscosidad.',
            'Aplicación de cera protectora con tecnología UV en el tanque y partes pintadas.'
        ],
        'btn_texto' => 'Hacer reserva',
        'btn_link' => 'reservar.php?servicio=premium-moto'
    ]
];

// Datos de Planes (Carrusel 2)
$planes = [
    [
        'titulo' => 'Brillo Impecable - Carro',
        'descripcion' => 'Pagas 5 lavados por adelantado y te aseguras de que tu carro luzca como nuevo todo el mes, recibiendo un beneficio de alto valor totalmente gratis.',
        'imagen' => 'https://images.unsplash.com/photo-1507136566006-cfc505b114fc?auto=format&fit=crop&w=600&q=80',
        'items' => [
            '3 Lavados premium completos',
            '2 Lavados sencillos completos'
        ],
        'btn_texto' => 'Adquirir plan',
        'btn_link' => 'comprar.php?plan=brillo-impecable'
    ],
    [
        'titulo' => 'Biker Pass - Moto',
        'descripcion' => 'Para los motociclistas que cuidan su máquina como a nada en el mundo. Un paquete pensado en la estética y el rendimiento mecánico.',
        'imagen' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&w=600&q=80',
        'items' => [
            '3 Lavados premium completos',
            '2 Lavados sencillos completos'
        ],
        'btn_texto' => 'Adquirir plan',
        'btn_link' => 'comprar.php?plan=biker-pass'
    ]
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClean - Estética Vehicular</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .bg-custom-primary {
            background-color: #1a252f;
        }

        .hover-link:hover {
            text-decoration: underline !important;
        }

        .hover-opacity:hover {
            opacity: 1 !important;
        }

        /* Alineación uniforme de tarjetas en carrusel */
        .carousel-item .card {
            min-height: 520px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- 1. BARRA DE NAVEGACIÓN (NAVBAR) -->
    <nav class="navbar navbar-expand-lg bg-custom-primary navbar-dark shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-white fw-bold" href="index.php">SmartClean</a>

            <button class="navbar-toggler border-white text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-2">

                    <form class="d-flex" action="buscar.php" method="GET" role="search">
                        <input class="form-control me-2" type="search" name="q" placeholder="Buscar..."
                            aria-label="Search" />
                        <button class="btn btn-outline-light" type="submit">Buscar</button>
                    </form>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a></li>
                            <li><a class="dropdown-item" href="registro.php">Registrarse</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- 2. SECCIÓN HERO (DESCRIPCIÓN DE LA EMPRESA) -->
    <section class="bg-light py-5 text-center border-bottom">
        <div class="container my-3" style="max-width: 800px;">
            <h1 class="display-5 fw-bold mb-3">Estética Vehicular de Primer Nivel</h1>
            <p class="lead text-muted lh-base">
                Somos un centro de lavado y estética vehicular diseñado especialmente para los amantes de las dos y las
                cuatro ruedas. Combinamos tecnología de punta, productos de alta calidad y un equipo de profesionales
                apasionados para garantizar que tu carro o moto luzca como recién salido del concesionario.
            </p>
        </div>
    </section>

    <!-- 3. SECCIÓN DE PLANES Y SERVICIOS (CARRUSELES) -->
    <main class="container my-5" style="min-height: 70vh;">
        <div class="row g-4 justify-content-center align-items-start">

            <!-- Carrusel 1: Servicios -->
            <div class="col-12 col-md-6 d-flex flex-column align-items-center">
                <h3 class="text-center mb-4 fw-bold">Conoce nuestros servicios</h3>

                <div id="carouselServicios" class="carousel slide shadow"
                    style="width: 100%; max-width: 24rem; border-radius: 15px; overflow: hidden;">
                    <div class="carousel-inner">

                        <?php foreach ($servicios as $index => $servicio): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="card mx-auto border-0 w-100">
                                    <img src="<?php echo htmlspecialchars($servicio['imagen']); ?>" class="card-img-top"
                                        alt="<?php echo htmlspecialchars($servicio['titulo']); ?>"
                                        style="height: 180px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?php echo htmlspecialchars($servicio['titulo']); ?>
                                        </h5>
                                        <p class="card-text text-muted small">
                                            <?php echo htmlspecialchars($servicio['descripcion']); ?>
                                        </p>
                                    </div>
                                    <ul class="list-group list-group-flush small">
                                        <?php foreach ($servicio['items'] as $item): ?>
                                            <li class="list-group-item"><?php echo htmlspecialchars($item); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="card-body text-center mt-auto">
                                        <a href="<?php echo htmlspecialchars($servicio['btn_link']); ?>"
                                            class="btn btn-primary w-100 fw-bold"><?php echo htmlspecialchars($servicio['btn_texto']); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <button class="carousel-control-prev carousel-control-dark" type="button"
                        data-bs-target="#carouselServicios" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next carousel-control-dark" type="button"
                        data-bs-target="#carouselServicios" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>

            <!-- Carrusel 2: Planes -->
            <div class="col-12 col-md-6 d-flex flex-column align-items-center">
                <h3 class="text-center mb-4 fw-bold">Conoce nuestros planes</h3>

                <div id="carouselPlanes" class="carousel slide shadow"
                    style="width: 100%; max-width: 24rem; border-radius: 15px; overflow: hidden;">
                    <div class="carousel-inner">

                        <?php foreach ($planes as $index => $plan): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="card mx-auto border-0 w-100">
                                    <img src="<?php echo htmlspecialchars($plan['imagen']); ?>" class="card-img-top"
                                        alt="<?php echo htmlspecialchars($plan['titulo']); ?>"
                                        style="height: 180px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?php echo htmlspecialchars($plan['titulo']); ?></h5>
                                        <p class="card-text text-muted small">
                                            <?php echo htmlspecialchars($plan['descripcion']); ?>
                                        </p>
                                    </div>
                                    <ul class="list-group list-group-flush small">
                                        <?php foreach ($plan['items'] as $item): ?>
                                            <li class="list-group-item"><?php echo htmlspecialchars($item); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="card-body text-center mt-auto">
                                        <a href="<?php echo htmlspecialchars($plan['btn_link']); ?>"
                                            class="btn btn-primary w-100 fw-bold"><?php echo htmlspecialchars($plan['btn_texto']); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <button class="carousel-control-prev carousel-control-dark" type="button"
                        data-bs-target="#carouselPlanes" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next carousel-control-dark" type="button"
                        data-bs-target="#carouselPlanes" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>

        </div>
    </main>

    <!-- 4. PIE DE PÁGINA (FOOTER) -->
    <footer class="bg-custom-primary text-white py-5 mt-auto">
        <div class="container">
            <div class="row g-4">

                <!-- Columna 1: Sobre la Empresa -->
                <div class="col-12 col-md-4">
                    <h5 class="text-uppercase mb-3 fw-bold">SmartClean</h5>
                    <p class="small text-white-50">
                        Ofrecemos soluciones avanzadas en lavado y estética automotriz para proteger tu inversión.
                    </p>
                </div>

                <!-- Columna 2: Enlaces Rápidos -->
                <div class="col-6 col-md-4">
                    <h5 class="text-uppercase mb-3 fw-bold">Enlaces</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="index.php"
                                class="text-white text-decoration-none small hover-link fw-bold">Inicio</a>
                        </li>
                        <li class="mb-2">
                            <a href="servicios.php"
                                class="text-white text-decoration-none small hover-link">Servicios</a>
                        </li>
                        <li class="mb-2">
                            <a href="contacto.php" class="text-white text-decoration-none small hover-link">Contacto</a>
                        </li>
                    </ul>
                </div>

                <!-- Columna 3: Contacto y Redes -->
                <div class="col-6 col-md-4">
                    <h5 class="text-uppercase mb-3 fw-bold">Contacto</h5>
                    <p class="small mb-1">📍 Calle 1 #1 - 1, Bogotá</p>
                    <p class="small mb-3">✉️ info@smartclean.com</p>

                    <div class="d-flex gap-3">
                        <a href="#" class="text-white opacity-75 hover-opacity"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white opacity-75 hover-opacity"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="text-white opacity-75 hover-opacity"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>

            <hr class="border-light my-4">

            <div class="row align-items-center text-center text-md-start">
                <div class="col-12 col-md-6 mb-2 mb-md-0">
                    <p class="small text-white-50 mb-0">&copy; <?php echo date('Y'); ?> SmartClean. Todos los derechos
                        reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>