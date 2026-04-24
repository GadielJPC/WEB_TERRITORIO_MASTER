<?php
// guardar_contacto.php

$conexion = new mysqli("localhost", "root", "", "masterm_contacto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar que llega el dato
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["nombre_completo"]) && !empty(trim($_POST["nombre_completo"]))) {

        $nombre = trim($_POST["nombre_completo"]);

        // Consulta segura
        $stmt = $conexion->prepare("INSERT INTO contactos (nombre_completo) VALUES (?)");
        $stmt->bind_param("s", $nombre);

        if ($stmt->execute()) {
            echo "Contacto guardado correctamente.";
        } else {
            echo "Error al guardar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "El campo nombre está vacío.";
    }
} else {
    echo "Acceso no permitido.";
}

$conexion->close();
