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
    <title><?php echo htmlspecialchars($curso['titulo']); ?> | MasterMedic</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/master.css">
</head>

<body class="course-detail-page">

    <main class="py-4">
        <div class="container">

            <section class="course-hero">
                <?php 
                $imgPath = "../assets/images/" . $curso['imagen'];
                if (empty($curso['imagen']) || !file_exists($imgPath)) {
                    $imgPath = "../assets/images/practica.png"; 
                }
                ?>
                <img src="<?php echo $imgPath; ?>" class="course-hero-img" alt="<?php echo htmlspecialchars($curso['titulo']); ?>">
                <div class="course-hero-overlay">
                    <span class="course-badge-pill shadow-sm">
                        <?php echo htmlspecialchars($curso['modalidad_badge']); ?>
                    </span>
                    <h1 class="course-hero-title"><?php echo htmlspecialchars($curso['titulo']); ?></h1>
                    <p class="course-hero-subtitle">Formación avanzada con prácticas clínicas garantizadas</p>
                </div>
            </section>

            <div class="row g-4 mb-4 justify-content-center">
                
                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-clock course-info-icon"></i>
                        <h6 class="fw-bold text-muted small text-uppercase mb-1" style="font-size: 0.7rem;">Duración</h6>
                        <p class="fw-bold mb-0" style="font-size: 0.95rem;"><?php echo htmlspecialchars($curso['duracion']); ?> meses</p> 
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-mortarboard course-info-icon"></i>
                        <h6 class="fw-bold text-muted small text-uppercase mb-1" style="font-size: 0.7rem;">Créditos</h6>
                        <p class="fw-bold mb-0" style="font-size: 0.95rem;"><?php echo htmlspecialchars($curso['creditos']); ?> ECTS</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-building-gear course-info-icon"></i>
                        <h6 class="fw-bold text-muted small text-uppercase mb-1" style="font-size: 0.7rem;">Prácticas</h6>
                        <p class="fw-bold mb-0" style="font-size: 0.95rem;"><?php echo htmlspecialchars($curso['practicas']); ?></p> 
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-person-check course-info-icon"></i>
                        <h6 class="fw-bold text-muted small text-uppercase mb-1" style="font-size: 0.7rem;">Dirigido a</h6>
                        <p class="fw-bold mb-0" style="font-size: 0.95rem;"><?php echo htmlspecialchars($curso['dirigido_a']); ?></p>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <div class="course-price-cta-box">
                    <div class="text-center text-md-start">
                        <span class="text-muted text-uppercase fw-bold small" style="letter-spacing: 1.5px; font-size: 0.65rem;">Inversión desde</span>
                        <div class="course-price-amount">
                            <?php echo number_format($curso['precio'], 0, '', '.'); ?> €
                        </div>
                    </div>
                    <div>
                        <a href="contacto.php" class="course-btn-premium shadow-sm">SOLICITAR INFORMACIÓN</a>
                    </div>
                </div>
            </div>

            <section class="mt-2 pt-5 border-top">
                <div class="row justify-content-center">
                    <div class="col-lg-10 course-description-section">
                        <h2 class="fw-bold mb-4 text-center" style="color: #1f2d3d;">Descripción del máster</h2>
                        <div class="text-start">
                            <?php echo nl2br(htmlspecialchars($curso['descripcion'])); ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="course-program-card">
                <h2 class="fw-bold mb-4 text-center" style="color: #1f2d3d;">Programa académico</h2>
                <div class="mx-auto mb-5" style="width: 50px; height: 4px; background: #00adb5; border-radius: 2px;"></div>

                <div class="program-list">
                    <?php 
                    $modulos = explode("\n", $curso['programa_texto']);
                    $i = 1;
                    foreach ($modulos as $mod) {
                        $mod = trim($mod);
                        if (!empty($mod)) {
                            $cleanMod = preg_replace('/^Módulo\s+\d+:\s*/i', '', $mod);
                            ?>
                            <div class="course-module-item">
                                <span class="course-module-num"><?php echo sprintf("%02d", $i); ?></span>
                                <h6 class="fw-bold mb-0" style="color: #2d3748;"><?php echo htmlspecialchars($cleanMod); ?></h6>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </section>

        </div>
    </main>

    <footer class="pt-5 pb-3 mt-auto" style="background-color: #1a252f; color: #e2e8f0;">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4 col-md-6">
                    <img src="../assets/images/Logoemp.png" alt="MasterMedic Logo"
                        style="max-height: 70px; width: auto; filter: brightness(0) invert(1);">
                    <p class="text-white-50 mt-3 pe-lg-4" style="font-size: 0.95rem; line-height: 1.5;">
                        Formación especializada en ciencias de la salud con enfoque académico y profesional.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white fw-bold mb-4">Información</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="cursos.php" class="text-white-50 text-decoration-none">Oferta Académica</a></li>
                        <li class="mb-2"><a href="practicas.php" class="text-white-50 text-decoration-none">Prácticas</a></li>
                        <li class="mb-2"><a href="contacto.php" class="text-white-50 text-decoration-none">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white fw-bold mb-4">Contacto</h5>
                    <p class="text-white-50 mb-1"><i class="bi bi-envelope me-2"></i> info@mastermedic.es</p>
                    <p class="text-white-50"><i class="bi bi-geo-alt me-2"></i> Madrid, España</p>
                </div>
            </div>
            <p class="text-center text-white-50 small mb-0 pt-4 border-top border-secondary">
                © 2026 MasterMedic. Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>