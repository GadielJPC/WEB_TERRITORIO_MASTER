<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso Legal | MasterM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <style>
        .legal-content {
            padding: 80px 0;
            background-color: #ffffff;
        }

        .legal-text h2 {
            color: #1f2d3d;
            font-weight: 700;
            font-size: 1.5rem;
            margin-top: 30px;
        }

        .legal-text p,
        .legal-text li {
            color: #6c757d;
            line-height: 1.8;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="header">
        <div class="header-container">
            <div class="logo-area pt-4">
                <a href="index.php">
                    <img src="../assets/images/Logoemp.png" alt="MasterMedic" class="logo-img">
                </a>
            </div>

            <nav class="main-nav">
                <div class="nav-item dropdown">
                    <a href="cursos.php" class="nav-link">Oferta académica <span class="chevron"></span></a>

                    <ul class="dropdown-box">
                        <li class="has-submenu">
                            <a href="cursos.php" class="dropdown-item">
                                Medicina <i class="bi bi-chevron-right"></i>
                            </a>
                            <ul class="submenu-side">
                                <?php
                                // 1. Conexión a la base de datos
                                $conexion = mysqli_connect("localhost", "root", "", "academia");

                                // 2. Consulta para obtener los títulos y enlaces
                                $query_menu = mysqli_query($conexion, "SELECT titulo, url_enlace FROM cursos ORDER BY titulo ASC");

                                // 3. Bucle para generar los elementos de la lista
                                if ($query_menu && mysqli_num_rows($query_menu) > 0) {
                                    while ($item = mysqli_fetch_assoc($query_menu)) {
                                        echo '<li><a href="' . $item['url_enlace'] . '">' . $item['titulo'] . '</a></li>';
                                    }
                                } else {
                                    // Opción por si no hay cursos todavía
                                    echo '<li><a href="#">Próximamente</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="practicas.php" class="dropdown-item">Prácticas Clínicas</a></li>
                    </ul>
                </div>

                <a href="practicas.php" class="nav-link">Prácticas</a>
                <a href="aula.php" class="nav-link">Aula</a>

                <a href="contacto.php" class="btn-premium">CONTACTO</a>
            </nav>
        </div>
    </header>

    <main class="legal-content flex-grow-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 legal-text">
                    <h1 class="fw-black mb-4" style="color: #1f2d3d;">Aviso <span style="color: #00adb5;">Legal</span>
                    </h1>
                    <hr class="mb-5">

                    <p>En cumplimiento del artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de
                        la Información y Comercio Electrónico (LSSICE), se exponen los datos identificativos del titular
                        de este sitio web:</p>

                    <h2>1. Datos Identificativos</h2>
                    <p>
                        <strong>Titular:</strong> MasterMedic Formación Sanitaria<br>
                        <strong>NIF:</strong> [Tu número aquí]<br>
                        <strong>Dirección:</strong> Madrid, España<br>
                        <strong>Email:</strong> info@tudominio.com<br>
                        <strong>Teléfono:</strong> +34 900 000 000
                    </p>

                    <h2>2. Propiedad Intelectual</h2>
                    <p>Todo el contenido de este sitio web, incluyendo textos, imágenes, logos y código fuente, es
                        propiedad de MasterMedic o de sus respectivos licenciantes. Queda prohibida cualquier
                        reproducción total o parcial sin autorización expresa.</p>

                    <h2>3. Uso de la Web</h2>
                    <p>El usuario se compromete a hacer un uso adecuado de los contenidos y servicios que MasterMedic
                        ofrece a través de su portal. El acceso al sitio web es gratuito salvo en lo relativo al coste
                        de la conexión a través de la red suministrada por el proveedor de acceso.</p>

                    <h2>4. Exención de Responsabilidad</h2>
                    <p>MasterMedic no se hace responsable de los daños que pudieran derivarse de interferencias,
                        omisiones, interrupciones o virus informáticos motivados por causas ajenas al titular de la web.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <footer class="pt-5 pb-3 mt-auto" style="background-color: #1a252f; color: #e2e8f0;">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4 col-md-6">
                    <img src="../assets/images/Logoemp.png" alt="MasterMedic Logo"
                        style="max-height: 70px; width: auto;">
                    <p class="text-white-50 pe-lg-4" style="font-size: 0.95rem; line-height: 1.2;">
                        Formación especializada en ciencias de la salud con enfoque académico y profesional. Preparamos
                        a especialistas para los retos reales del sector.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">INFORMACIÓN</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="quienes-somos.php" class="text-decoration-none text-white-50">Quiénes
                                somos</a></li>
                        <li class="mb-3"><a href="Valoraciones.php"
                                class="text-decoration-none text-white-50">Valoraciones</a></li>
                        <li class="mb-3"><a href="aula.php" class="text-decoration-none text-white-50">Aula virtual</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">OFERTA ACADÉMICA
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="estetica.php" class="text-decoration-none text-white-50">Medicina
                                Estética</a></li>
                        <li class="mb-3"><a href="fisioterapia.php"
                                class="text-decoration-none text-white-50">Fisioterapia Invasiva</a></li>
                        <li class="mb-3"><a href="practicas.php" class="text-decoration-none text-white-50">Prácticas
                                Clínicas</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6" id="contacto">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">CONTACTO</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-envelope me-3" style="color: #00adb5;"></i>
                            <span class="text-white-50">info@tudominio.com</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-telephone me-3" style="color: #00adb5;"></i>
                            <span class="text-white-50">+34 900 000 000</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-secondary pt-4 text-left">
                <p class="mb-0 text-white-50 small">
                    © 2026 MasterMedic. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>