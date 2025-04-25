<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

$sql = "SELECT id_deta_ven_pro, id_venta, id_procesadores, cantidad FROM detalles_venta";

$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-top: 50px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            margin-top: 30px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover td {
            background-color: #d1e7fd;
        }

        .container {
            margin-top: 50px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Detalle de Ventas de Procesadores</h2>

        <table>
            <thead>
                <tr>
                    <th>ID Detalle</th>
                    <th>ID Venta</th>
                    <th>ID Procesador</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $fila['id_deta_ven_pro'] ?></td>
                        <td><?= $fila['id_venta'] ?></td>
                        <td><?= $fila['id_procesadores'] ?></td>
                        <td><?= $fila['cantidad'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="index.php" class="btn">Volver al Menú Principal</a>
        </div>
    </div>

</body>
</html>
