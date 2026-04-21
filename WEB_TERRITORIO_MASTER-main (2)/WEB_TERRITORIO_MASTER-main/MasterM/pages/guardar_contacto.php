<?php

$conexion = new mysqli("localhost", "root", "", "masterm_contacto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $_POST['nombre_completo'];

$sql = "INSERT INTO contactos (nombre_completo)
VALUES ('$nombre')";

if ($conexion->query($sql) === TRUE) {
    echo "Solicitud enviada correctamente";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
