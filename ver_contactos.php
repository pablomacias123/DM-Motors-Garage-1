<?php
session_start();

// Prevenir caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin'])) {
    header("Location: login_form.html");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "dm_motors");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$resultado = $conexion->query("SELECT * FROM contactos ORDER BY fecha_envio DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros de Contacto - DM Motors Garage</title>
    <link rel="stylesheet" href="Style3.css">
    <link rel="icon" href="IMG/DMMOTORS.png">
</head>
<body>
    <div class="panel-container">
        <h1>Registros del Formulario de Contacto</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['telefono']) ?></td>
                    <td><?= $row['asunto'] ?></td>
                    <td><?= nl2br(htmlspecialchars($row['mensaje'])) ?></td>
                    <td><?= $row['fecha_envio'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="acciones">
            <a href="logout.php" class="btn-logout">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
