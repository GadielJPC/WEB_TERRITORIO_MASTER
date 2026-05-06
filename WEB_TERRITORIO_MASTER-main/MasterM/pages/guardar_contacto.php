<?php

$host = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "mastermedic";

/* conexión */
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

/* verificar conexión */
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

/* recoger datos */
$nombre = $_POST['nombre_completo'] ?? '';
$email = $_POST['correo_electronico'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$programa = $_POST['programa_interes'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';
$privacidad = isset($_POST['acepta_privacidad']) ? 1 : 0;

/* validar */
if (empty($nombre)) {
    die("El nombre completo es obligatorio.");
}

/* insertar */
$sql = "INSERT INTO contactos 
(nombre_completo, correo_electronico, telefono, programa_interes, mensaje, acepta_privacidad)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en prepare(): " . $conn->error);
}

$stmt->bind_param(
    "sssssi",
    $nombre,
    $email,
    $telefono,
    $programa,
    $mensaje,
    $privacidad
);

if ($stmt->execute()) {
    header("Location: contacto.php?enviado=ok");
    exit();
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
