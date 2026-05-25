<?php
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$carpeta_destino = "uploads/"; 

if (!file_exists($carpeta_destino)) {
    mkdir($carpeta_destino, 0777, true);
}

$titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
$badge = mysqli_real_escape_string($conexion, $_POST['modalidad_badge']);
$desc = mysqli_real_escape_string($conexion, $_POST['modalidad_desc']);
$creditos = mysqli_real_escape_string($conexion, $_POST['creditos']);
$practicas = mysqli_real_escape_string($conexion, $_POST['practicas']);
$precio = mysqli_real_escape_string($conexion, $_POST['precio']);
$duracion = mysqli_real_escape_string($conexion, $_POST['duracion']);
$dirigido_a = mysqli_real_escape_string($conexion, $_POST['dirigido_a']);
$url_enlace = mysqli_real_escape_string($conexion, $_POST['url_enlace']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$programa_texto = mysqli_real_escape_string($conexion, $_POST['programa_texto']);

if (isset($_GET['id_update'])) {
    $id_modificar = mysqli_real_escape_string($conexion, $_GET['id_update']);
    
    $check_repetido = mysqli_query($conexion, "SELECT id FROM cursos WHERE titulo = '$titulo' AND id != '$id_modificar'");
    if (mysqli_num_rows($check_repetido) > 0) {
        header("Location: nuevo.php?id_edit=" . $id_modificar . "&error=repetido");
        exit();
    }

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $ruta_final = $carpeta_destino . $nombre_imagen;
        
        move_uploaded_file($ruta_temporal, $ruta_final);
        $imagen = mysqli_real_escape_string($conexion, $nombre_imagen);
    } else {
        $consulta_actual = mysqli_query($conexion, "SELECT imagen FROM cursos WHERE id = '$id_modificar'");
        $curso_actual = mysqli_fetch_assoc($consulta_actual);
        $imagen = mysqli_real_escape_string($conexion, $curso_actual['imagen']);
    }

    $sql = "UPDATE cursos SET 
                titulo = '$titulo', 
                imagen = '$imagen', 
                modalidad_badge = '$badge', 
                modalidad_desc = '$desc', 
                creditos = '$creditos', 
                practicas = '$practicas', 
                precio = '$precio', 
                duracion = '$duracion', 
                dirigido_a = '$dirigido_a', 
                url_enlace = '$url_enlace', 
                descripcion = '$descripcion', 
                programa_texto = '$programa_texto' 
            WHERE id = '$id_modificar'";
} else {
    $check_repetido = mysqli_query($conexion, "SELECT id FROM cursos WHERE titulo = '$titulo'");
    
    if (mysqli_num_rows($check_repetido) > 0) {
        header("Location: nuevo.php?error=repetido");
        exit();
    }

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $ruta_final = $carpeta_destino . $nombre_imagen;
        
        move_uploaded_file($ruta_temporal, $ruta_final);
        $imagen = mysqli_real_escape_string($conexion, $nombre_imagen);
    } else {
        $imagen = "default.png"; 
    }

    $sql = "INSERT INTO cursos (titulo, imagen, modalidad_badge, modalidad_desc, creditos, practicas, precio, duracion, dirigido_a, url_enlace, descripcion, programa_texto) 
            VALUES ('$titulo', '$imagen', '$badge', '$desc', '$creditos', '$practicas', '$precio', '$duracion', '$dirigido_a', '$url_enlace', '$descripcion', '$programa_texto')";
}

if (mysqli_query($conexion, $sql)) {
    header("Location: nuevo.php?success=1");
    exit();
} else {
    echo "Error en la base de datos: " . mysqli_error($conexion);
}
?>