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
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Original CSS compatibility -->
    <link rel="stylesheet" href="../css/styles.css">
    
    <style>
        /* Scoped styles for the course detail page */
        .course-detail-page {
            background-color: #f8fafc;
            color: #2d3748;
            font-family: 'Montserrat', sans-serif;
        }

        /* Top spacing reduction */
        .course-detail-page main {
            padding-top: 1rem !important;
        }

        .course-hero {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            margin-top: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            height: 480px;
        }

        .course-hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .course-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.15) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
            align-items: flex-start;
        }

        .course-badge-pill {
            background-color: #00adb5;
            color: white;
            padding: 0.5rem 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            border-radius: 50px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(0, 173, 181, 0.3);
            display: inline-block;
        }

        .course-hero-title {
            color: #ffffff;
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            line-height: 1.1;
            text-shadow: 0 2px 15px rgba(0,0,0,0.4);
        }

        .course-hero-subtitle {
            color: #e2e8f0;
            font-size: 1.25rem;
            font-weight: 500;
            max-width: 700px;
            margin-bottom: 0;
            text-shadow: 0 1px 5px rgba(0,0,0,0.3);
        }

        /* Fixed alignment for info cards */
        .course-info-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem 1rem;
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .course-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 173, 181, 0.12);
        }

        .course-info-icon {
            font-size: 1.75rem;
            color: #00adb5;
            margin-bottom: 0.75rem;
            display: inline-block;
        }

        .course-price-cta-box {
            background: #ffffff;
            border-radius: 24px;
            padding: 1.5rem 3rem;
            display: inline-flex;
            align-items: center;
            gap: 4rem;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            margin: 1.5rem 0 3rem 0;
            flex-wrap: wrap;
            justify-content: center;
            border: 1px solid rgba(0, 173, 181, 0.15);
        }

        .course-price-amount {
            font-size: 2.75rem;
            font-weight: 900;
            color: #1f2d3d;
            line-height: 1;
        }

        .course-btn-premium {
            background-color: #00adb5;
            color: white;
            padding: 1rem 3rem;
            font-weight: 700;
            border-radius: 14px;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .course-btn-premium:hover {
            background-color: #008f96;
            color: white;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 173, 181, 0.35);
        }

        .course-description-section {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4a5568;
        }

        .course-program-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            margin-top: 2rem;
        }

        .course-module-item {
            background: #f8fafc;
            border-left: 5px solid #00adb5;
            padding: 1.25rem 2rem;
            border-radius: 0 12px 12px 0;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.2s ease;
        }

        .course-module-item:hover {
            background: #ffffff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.06);
            transform: translateX(5px);
        }

        .course-module-num {
            font-size: 1.25rem;
            font-weight: 800;
            color: #00adb5;
            opacity: 0.6;
        }

        @media (max-width: 991px) {
            .course-hero-title { font-size: 2.75rem; }
            .course-price-cta-box { gap: 2rem; padding: 2rem; }
        }

        @media (max-width: 768px) {
            .course-hero { height: 400px; }
            .course-hero-overlay { padding: 2rem; }
            .course-hero-title { font-size: 2.25rem; }
            .course-hero-subtitle { font-size: 1.1rem; }
            .course-price-amount { font-size: 2.25rem; }
            .course-price-cta-box { flex-direction: column; width: 100%; }
            .course-program-card { padding: 1.5rem; }
        }
    </style>
</head>

<body class="course-detail-page">

    <main class="py-4">
        <div class="container">

            <!-- Hero Section -->
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

            <!-- Info Grid -->
            <div class="row g-4 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-clock course-info-icon"></i>
                        <h6 class="fw-bold text-muted small text-uppercase mb-1" style="font-size: 0.7rem;">Duración</h6>
                        <p class="fw-bold mb-0" style="font-size: 0.95rem;"><?php echo htmlspecialchars($curso['duracion']); ?></p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-mortarboard course-info-icon"></i>
                        <h6 class="fw-bold text-muted small text-uppercase mb-1" style="font-size: 0.7rem;">Créditos</h6>
                        <p class="fw-bold mb-0" style="font-size: 0.95rem;"><?php echo htmlspecialchars($curso['creditos']); ?></p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="course-info-card">
                        <i class="bi bi-hospital course-info-icon"></i>
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

            <!-- Price and CTA -->
            <div class="text-center">
                <div class="course-price-cta-box">
                    <div class="text-center text-md-start">
                        <span class="text-muted text-uppercase fw-bold small" style="letter-spacing: 1.5px; font-size: 0.65rem;">Inversión desde</span>
                        <div class="course-price-amount"><?php echo htmlspecialchars($curso['precio']); ?></div>
                    </div>
                    <div>
                        <a href="contacto.php" class="course-btn-premium shadow-sm">SOLICITAR INFORMACIÓN</a>
                    </div>
                </div>
            </div>

            <!-- Description -->
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

            <!-- Academic Program -->
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

    <!-- FOOTER -->
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