    <!-- HEADER -->
<header class="header">
    <div class="header-container position-relative">
        <div class="logo-area pt-4">
            <a href="index.php">
                <img src="../assets/images/Logoemp.png" alt="MasterMedic" class="logo-img">
            </a>
        </div>
        

        <button id="btn-menu" class="menu-hamburguesa" type="button" aria-label="Abrir menú">
    ☰
</button>
        
        <nav class="main-nav" id="menu-principal">
            <div class="nav-item dropdown">
                <a href="cursos.php" class="nav-link" id="btn-oferta">Oferta académica <i class="bi bi-chevron-down d-lg-none ms-1"></i></a>
                
                <ul class="dropdown-box" id="caja-oferta">
                    <li class="has-submenu">
                        <a href="cursos.php" class="dropdown-item" id="btn-medicina">
                            Medicina <i class="bi bi-chevron-down d-lg-none ms-auto"></i><i class="bi bi-chevron-right d-none d-lg-inline"></i>
                        </a>
                        <ul class="submenu-side" id="caja-medicina">
                            <?php
                            // 1. Conexión a la base de datos (ajusta 'academia' al nombre de tu BD)
                            $conexion = mysqli_connect("localhost", "root", "", "academia");

                            // 2. Comprobar si la conexión funciona
                            if ($conexion) {
                                // 3. Consultar los másteres guardados
                                $query_menu = mysqli_query($conexion, "SELECT titulo, url_enlace FROM cursos ORDER BY id DESC");

                                if (mysqli_num_rows($query_menu) > 0) {
                                    // 4. Dibujar un <li> por cada máster en la base de datos
                                    while ($item = mysqli_fetch_assoc($query_menu)) {
                                        echo '<li><a href="' . $item['url_enlace'] . '">' . $item['titulo'] . '</a></li>';
                                    }
                                } else {
                                    // Mensaje si la tabla está vacía
                                    echo '<li><a href="#">Próximamente</a></li>';
                                }
                                // 5. Cerrar conexión
                                mysqli_close($conexion);
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