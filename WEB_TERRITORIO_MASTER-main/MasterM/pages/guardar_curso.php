<?php
// 1. Conexión (Asegúrate de poner el nombre de tu base de datos donde dice 'academia')
$conexion = mysqli_connect("localhost", "root", "", "academia");

// 2. Recoger los datos del formulario
$titulo = $_POST['titulo'];
$badge = $_POST['modalidad_badge'];
$desc = $_POST['modalidad_desc'];
$creditos = $_POST['creditos'];
$precio = $_POST['precio'];
$practicas = $_POST['practicas'];

// 3. Insertar en la base de datos
$sql = "INSERT INTO cursos (titulo, modalidad_badge, modalidad_desc, creditos, precio, practicas) 
        VALUES ('$titulo', '$badge', '$desc', '$creditos', '$precio', '$practicas')";

if(mysqli_query($conexion, $sql)){
    // Si todo sale bien, vuelve a la página de cursos
    header("Location: cursos.php");
} else {
    echo "Error al guardar: " . mysqli_error($conexion);
}
?>