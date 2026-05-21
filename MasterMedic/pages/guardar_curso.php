<?php
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
$imagen = mysqli_real_escape_string($conexion, $_POST['imagen']);
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
    $sql = "INSERT INTO cursos (titulo, imagen, modalidad_badge, modalidad_desc, creditos, practicas, precio, duracion, dirigido_a, url_enlace, descripcion, programa_texto) 
            VALUES ('$titulo', '$imagen', '$badge', '$desc', '$creditos', '$practicas', '$precio', '$duracion', '$dirigido_a', '$url_enlace', '$descripcion', '$programa_texto')";
}

if (mysqli_query($conexion, $sql)) {
    header("Location: nuevo.php");
    exit();
} else {
    echo "Error en la base de datos: " . mysqli_error($conexion);
}
?>