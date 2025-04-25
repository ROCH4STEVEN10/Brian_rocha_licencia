<?php
session_start();
require_once('../config/conex.php');

$db = new Database();
$con = $db->conectar();

$documento = $_SESSION['documento'] ?? null;
if (!$documento) {
    echo "<p style='color: red;'>Debes iniciar sesión para ver tus compras.</p>";
    exit;
}

try {
    // Obtener las ventas del usuario
    $ventasStmt = $con->prepare("
        SELECT v.id_venta, v.fecha, v.total 
        FROM ventas v
        WHERE v.documento = ?
        ORDER BY v.fecha DESC
    ");
    $ventasStmt->execute([$documento]);
    $ventas = $ventasStmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($ventas) === 0) {
        echo "<p>No tienes compras registradas.</p>";
        exit;
    }

    // Obtener detalles de cada venta
    foreach ($ventas as &$venta) {
        $detalleStmt = $con->prepare("
            SELECT p.marca, p.modelo, dv.cantidad, p.precio_uni 
            FROM detalles_venta dv
            JOIN procesadores p ON dv.id_procesadores = p.id_procesadores
            WHERE dv.id_venta = ?
        ");
        $detalleStmt->execute([$venta['id_venta']]);
        $venta['detalles'] = $detalleStmt->fetchAll(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .detalle-table {
            width: 100%;
            border: 1px solid #ddd;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .detalle-table th, .detalle-table td {
            padding: 8px;
            text-align: left;
        }
        .detalle-table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mis Compras</h1>

    <?php foreach ($ventas as $venta): ?>
        <h3>Compra ID: <?= $venta['id_venta'] ?> | Fecha: <?= $venta['fecha'] ?> | Total: $<?= number_format($venta['total'], 2) ?></h3>

        <table class="detalle-table">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($venta['detalles'] as $detalle): ?>
                    <tr>
                        <td><?= htmlspecialchars($detalle['marca']) ?></td>
                        <td><?= htmlspecialchars($detalle['modelo']) ?></td>
                        <td><?= $detalle['cantidad'] ?></td>
                        <td>$<?= number_format($detalle['precio_uni'], 2) ?></td>
                        <td>$<?= number_format($detalle['cantidad'] * $detalle['precio_uni'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
    <li><a href="index.php">volver</a></li>

</div>

</body>
</html>
