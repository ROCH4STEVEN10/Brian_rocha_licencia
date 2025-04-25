<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

$documento = $_GET['documento'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE clientes SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion WHERE documento = :documento";
    $stmt = $con->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':telefono' => $telefono,
        ':direccion' => $direccion,
        ':documento' => $documento
    ]);

    header("Location: ver_usua.php");
    exit;
}

$sql = "SELECT * FROM clientes WHERE documento = :documento";
$stmt = $con->prepare($sql);
$stmt->execute([':documento' => $documento]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h2>Editar Cliente</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= $cliente['nombre'] ?>"><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $cliente['email'] ?>"><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" value="<?= $cliente['telefono'] ?>"><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion" value="<?= $cliente['direccion'] ?>"><br><br>

        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="ver_usua.php">Cancelar</a>
</body>
</html>
