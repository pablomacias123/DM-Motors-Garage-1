<?php
// Conexión
$conexion = new mysqli("localhost", "root", "", "dm_motors");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

// Insertar datos
$sql = "INSERT INTO contactos (nombre, email, telefono, asunto, mensaje) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $nombre, $email, $telefono, $asunto, $mensaje);

if ($stmt->execute()) {
    echo "<script>alert('Mensaje enviado correctamente'); window.location='contacto.html';</script>";
} else {
    echo "Error al enviar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
