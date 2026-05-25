<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasterMedic | Formación Sanitaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/cursos.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
</head>

<body>

    <section class="py-5" style="background-color: #ffffff;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6" style="color: #1f2d3d;">Oferta Académica</h2>
            <p class="text-muted fs-5">Programas de posgrado diseñados para la excelencia clínica.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            $conexion = mysqli_connect("localhost", "root", "", "academia");
            
            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }
            
            $query = mysqli_query($conexion, "SELECT * FROM cursos ORDER BY id DESC");

            while ($curso = mysqli_fetch_assoc($query)) { 
            ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden info-card">
                        <div class="position-relative">
                            <img src="../assets/images/<?php echo $curso['imagen']; ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                            <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 shadow-sm rounded-pill"
                                  style="background-color: #2c3e50; font-size: 0.85rem;">
                                <?php echo htmlspecialchars($curso['modalidad_badge']); ?>
                            </span>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <h4 class="fw-bold mb-4" style="color: #1f2d3d;"><?php echo htmlspecialchars($curso['titulo']); ?></h4>

                            <ul class="list-unstyled mb-4 flex-grow-1">
                                <li class="d-flex align-items-center mb-3 text-muted">
                                    <i class="bi bi-building fs-5 me-3" style="color: #00adb5;"></i>
                                    <span><strong>Asistencia:</strong> <?php echo htmlspecialchars($curso['modalidad_badge']); ?></span>
                                </li>

                                <li class="d-flex align-items-center mb-3 text-muted">
                                    <i class="bi bi-calendar-event fs-5 me-3" style="color: #00adb5;"></i>
                                    <span><strong>Modalidad:</strong> <?php echo htmlspecialchars($curso['modalidad_desc']); ?></span>
                                </li>

                                <li class="d-flex align-items-center mb-3 text-muted">  
                                    <i class="bi bi-mortarboard fs-5 me-3" style="color: #00adb5;"></i>
                                    <span><strong>Créditos:</strong> <?php echo htmlspecialchars($curso['creditos']); ?> ECTS</span>
                                </li>

                                <li class="d-flex align-items-center mb-3 text-muted">
                                    <i class="bi bi-clock fs-5 me-3" style="color: #00adb5;"></i>
                                    <span><strong>Duración:</strong> <?php echo htmlspecialchars($curso['duracion']); ?> meses</span>
                                </li>

                                <li class="d-flex align-items-center mb-3 text-muted">
                                    <i class="bi bi-geo-alt fs-5 me-3" style="color: #00adb5;"></i>
                                    <span><strong>Prácticas:</strong> <?php echo !empty($curso['practicas']) ? htmlspecialchars($curso['practicas']) : 'Centros especializados'; ?></span>
                                </li>
                            </ul>

                            <div class="mt-auto border-top pt-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small text-uppercase fw-bold">Inversión desde</span>
                                    <span class="fs-4 fw-black" style="color: #00adb5;">
                                        <?php echo number_format($curso['precio'], 0, '', '.'); ?> €
                                    </span>
                                </div>
                                
                                <a href="master.php?tipo=<?php echo $curso['url_enlace']; ?>" class="btn w-100 py-2 fw-bold rounded-3"
                                   style="background-color: #00adb5; color: white;">Más información</a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php 
            } 
            ?>
        </div>
    </div>
</section>


    <footer class="pt-5 pb-3 mt-auto" style="background-color: #1a252f; color: #e2e8f0;">
        <div class="container">

            <div class="row g-5 mb-5">

                <div class="col-lg-4 col-md-6">
                    <img src="../assets/images/Logoemp.png" alt="MasterMedic Logo"
                        style="max-height: 70px; width: auto; filter: brightness(0) invert(1);">
                    <p class="text-white-50 pe-lg-4 mt-3" style="font-size: 0.95rem; line-height: 1.5;">
                        Formación especializada en ciencias de la salud con enfoque académico y profesional. Preparamos
                        a especialistas para los retos reales del sector.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">INFORMACIÓN</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="quienes-somos.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Quiénes somos</a>
                        </li>
                        <li class="mb-3"><a href="Valoraciones.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Valoraciones</a>
                        </li>
                        <li class="mb-3"><a href="aula.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Aula virtual</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">OFERTA ACADÉMICA</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="estetica.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Medicina Estética</a></li>
                        <li class="mb-3"><a href="fisioterapia.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Fisioterapia Invasiva</a></li>
                        <li class="mb-3"><a href="practicas.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Prácticas Clínicas</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6" id="contacto">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">CONTACTO</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-envelope me-3 " style="color: #00adb5;"></i>
                            <span class="text-white-50">info@mastermedic.es</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-telephone me-3 " style="color: #00adb5;"></i>
                            <span class="text-white-50">+34 900 000 000</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-geo-alt me-3 " style="color: #00adb5;"></i>
                            <span class="text-white-50">Madrid, España</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-top border-secondary pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="mb-0 text-white-50 small text-center text-md-start">
                    © 2026 MasterMedic. Todos los derechos reservados.
                </p>

                <div class="mt-3 mt-md-0 d-flex align-items-center gap-4">
                    <a href="aviso-legal.php"
                        class="text-decoration-none text-white-50 small footer-link transition-all">
                        Aviso Legal
                    </a>
                    <a href="#"
                        class="text-decoration-none text-white-50 small footer-link transition-all">
                        Política de Privacidad
                    </a>
                    <a href="login.php"
                        class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm text-decoration-none btn-sm">
                        Gestión
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>