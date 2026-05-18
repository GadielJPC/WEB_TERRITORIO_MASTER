<?php
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_GET['tipo'])) {
    $tipo = mysqli_real_escape_string($conexion, $_GET['tipo']);

    $query = mysqli_query($conexion, "SELECT * FROM cursos WHERE url_enlace = '$tipo'");

    if (mysqli_num_rows($query) > 0) {
        $curso = mysqli_fetch_assoc($query);
    } else {
        die("<h1>El máster solicitado no existe en la base de datos.</h1>");
    }
} else {
    die("<h1>No se ha especificado ningún máster en la URL (?tipo=...).</h1>");
}
?>

<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $curso['titulo']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/cursos.css">
</head>

<body>

    <main class="py-5" style="background-color: #f8fafc;">
        <div class="container">

            <section class="asig-hero">
                <img src="../assets/images/<?php echo $curso['imagen']; ?>" class="asig-hero-img" alt="<?php echo $curso['titulo']; ?>">
                <div class="asig-hero-overlay">
                    <h1 class="asig-hero-title"><?php echo $curso['titulo']; ?></h1>
                    <p class="asig-hero-subtitle">Formación avanzada con prácticas clínicas garantizadas</p>
                </div>
            </section>

            <div class="text-center mb-5 mx-auto" style="max-width: 800px;">
                <p class="lead text-muted fs-5 text-center">
                    Especialízate en uno de los sectores con mayor crecimiento, combinando formación teórica de élite con práctica clínica real.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="asig-info-card">
                        <i class="bi bi-clock asig-info-icon"></i>
                        <h6 class="fw-bold">Duración</h6>
                        <p class="text-muted small mb-0 text-center"><?php echo $curso['duracion']; ?></p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="asig-info-card">
                        <i class="bi bi-mortarboard asig-info-icon"></i>
                        <h6 class="fw-bold">Créditos</h6>
                        <p class="text-muted small mb-0 text-center"><?php echo $curso['creditos']; ?></p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="asig-info-card">
                        <i class="bi bi-hospital asig-info-icon"></i>
                        <h6 class="fw-bold">Prácticas</h6>
                        <p class="text-muted small mb-0 text-center"><?php echo $curso['practicas']; ?></p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="asig-info-card">
                        <i class="bi bi-person-check asig-info-icon"></i>
                        <h6 class="fw-bold">Dirigido a</h6>
                        <p class="text-muted small mb-0 text-center"><?php echo $curso['dirigido_a']; ?></p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <div class="asig-price-box">
                    <div class="text-start text-center-mobile">
                        <span class="text-muted text-uppercase fw-bold" style="letter-spacing: 1px;">Inversión desde</span>
                        <div class="asig-price-amount"><?php echo $curso['precio']; ?></div>
                    </div>
                    <div>
                        <a href="contacto.php#formulario" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">SOLICITAR INFORMACIÓN</a>
                    </div>
                </div>
            </div>

            <section class="mt-5 pt-5 border-top text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-10 asig-description">
                        <h2 class="fw-bold mb-4 text-dark">Descripción del máster</h2>
                        <div class="text-start text-muted">
                            <?php echo nl2br($curso['descripcion']); ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="asig-syllabus">
                <h2 class="fw-bold mb-4 text-dark text-center">Programa académico</h2>
                <div class="med-line mx-auto mb-5" style="width: 50px; height: 4px; background: #00a9b5; border-radius: 2px;"></div>

                <div class="text-start text-muted bg-white p-4 rounded shadow-sm" style="white-space: pre-line;">
                    <?php echo $curso['programa_texto']; ?>
                </div>
            </section>

            <div class="row mt-5 text-center g-4">
                <div class="col-md-4">
                    <div class="asig-info-card">
                        <i class="bi bi-briefcase text-primary fs-1 mb-3"></i>
                        <h5 class="fw-bold">Alta empleabilidad</h5>
                        <p class="text-muted small mb-0 text-start">Formación orientada al mercado laboral con alta demanda en el sector sanitario.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="asig-info-card">
                        <i class="bi bi-people text-primary fs-1 mb-3"></i>
                        <h5 class="fw-bold">Profesores expertos</h5>
                        <p class="text-muted small mb-0 text-start">Docentes en activo con amplia experiencia en entornos clínicos reales.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="asig-info-card">
                        <i class="bi bi-award text-primary fs-1 mb-3"></i>
                        <h5 class="fw-bold">Titulación reconocida</h5>
                        <p class="text-muted small mb-0 text-start">Certificación académica de calidad con reconocimiento profesional.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="pt-5 pb-3 mt-auto" style="background-color: #1a252f; color: #e2e8f0;">
        <div class="container">
            <div class="row g-5 mb-5">

                <div class="col-lg-4 col-md-6">
                    <img src="../assets/images/Logoemp.png" alt="MasterMedic Logo"
                        style="max-height: 70px; width: auto; filter: brightness(0) invert(1);">
                    <p class="text-white-50 pe-lg-4 " style="font-size: 0.95rem; line-height: 1.2;">
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
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">OFERTA ACADÉMICA
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="estetica.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Medicina
                                Estética</a></li>
                        <li class="mb-3"><a href="fisioterapia.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Fisioterapia
                                Invasiva</a></li>
                        <li class="mb-3"><a href="practicas.php"
                                class="text-decoration-none text-white-50 footer-link transition-all">Prácticas
                                Clínicas</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6" id="contacto">
                    <h5 class="text-white fw-bold mb-4 fs-6 tracking-wide" style="letter-spacing: 1px;">CONTACTO</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-envelope me-3 " style="color: #00adb5;"></i>
                            <span class="text-white-50">info@tudominio.com</span>
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

            <div
                class="border-top border-secondary pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="mb-0 text-white-50 small text-center text-md-start">
                    © 2026 MasterMedic. Todos los derechos reservados.
                </p>
                <div class="mt-3 mt-md-0 d-flex gap-4">
                    <a href="aviso-legal.php"
                        class="text-decoration-none text-white-50 small footer-link transition-all">Aviso Legal</a>
                    <a href="#" class="text-decoration-none text-white-50 small footer-link transition-all">Política de
                        Privacidad</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>