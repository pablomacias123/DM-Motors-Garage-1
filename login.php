<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root","", "dm_motors");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT * FROM usuarios_admin WHERE usuario = ? AND password = SHA1(?)");
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $_SESSION['admin'] = $usuario;
        header("Location: ver_contactos.php");
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location='login_form.html';</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>
