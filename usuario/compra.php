<?php
session_start();
require_once('../config/conex.php');

$db = new Database();
$con = $db->conectar();

$documento = $_SESSION['documento'] ?? null;
if (!$documento) {
    echo "<p style='color: red;'>Debes iniciar sesión para realizar una compra.</p>";
    exit;
}

// Verificar si el cliente existe en la tabla clientes
$checkCliente = $con->prepare("SELECT documento FROM clientes WHERE documento = ?");
$checkCliente->execute([$documento]);

// Si no existe, lo registramos automáticamente con un rol (suponiendo rol = 2)
if ($checkCliente->rowCount() === 0) {
    $id_rol_cliente = 2; // Ajusta este valor si tu ID de rol de cliente es diferente
    $insertCliente = $con->prepare("INSERT INTO clientes (documento, id_rol) VALUES (?, ?)");
    $insertCliente->execute([$documento, $id_rol_cliente]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_procesador = $_POST['id_procesadores'];
    $cantidad = (int) $_POST['cantidad'];
    $fecha = date('Y-m-d H:i:s');

    try {
        $stmt = $con->prepare("SELECT precio_uni FROM procesadores WHERE id_procesadores = ?");
        $stmt->execute([$id_procesador]);
        $procesador = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$procesador) {
            echo "<p style='color: red;'>Procesador no encontrado.</p>";
            exit;
        }

        $precio = $procesador['precio_uni'];
        $total = $precio * $cantidad;

        // Insertar en la tabla ventas
        $ventaStmt = $con->prepare("INSERT INTO ventas (documento, fecha, total) VALUES (?, ?, ?)");
        $ventaStmt->execute([$documento, $fecha, $total]);

        $id_venta = $con->lastInsertId();

        // Insertar en la tabla detalle_ventas
        // Ahora, no insertamos el 'subtotal', ya que no existe en la estructura
        $detalleStmt = $con->prepare("INSERT INTO detalles_venta (id_venta, id_procesadores, cantidad) VALUES (?, ?, ?)");
        $detalleStmt->execute([$id_venta, $id_procesador, $cantidad]);

        echo "<p style='color: green;'>✅ Compra registrada. Total: $" . number_format($total, 2) . "</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    }
}

$stmt = $con->prepare("SELECT * FROM procesadores");
$stmt->execute();
$procesadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprar Procesadores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .form-container {
            max-width: 500px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-container h1 {
            text-align: center;
            color: #007bff;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .procesador-option {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Comprar Procesador</h1>

    <form method="POST">
        <label for="id_procesadores">Procesador</label>
        <select name="id_procesadores" required>
            <option value="">Seleccione un procesador</option>
            <?php foreach ($procesadores as $proce): ?>
                <option value="<?= $proce['id_procesadores'] ?>" class="procesador-option">
                    <?= htmlspecialchars($proce['marca']) . " " . htmlspecialchars($proce['modelo']) ?> - $<?= number_format($proce['precio_uni'], 2) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" min="1" required>
        <li><a href="index.php">volver</a></li>

        <button type="submit">Registrar Compra</button>
    </form>
</div>

</body>
</html>
