

<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

$sql = "SELECT * FROM licencias";
$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Licencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            background-color: white;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-volver {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Licencias Registradas</h2>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Licencia</th>
                <th>Fecha Emisión</th>
                <th>Fecha Expiración</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $fila['id_licencia'] ?></td>
                    <td><?= $fila['id_empresa'] ?></td>
                    <td><?= $fila['id_tip_lice'] ?></td>
                    <td><?= $fila['fecha_ini'] ?></td>
                    <td><?= $fila['fecha_expira'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="text-center btn-volver">
        <a href="index.php" class="btn btn-primary">Volver al Menú</a>
    </div>
</div>

</body>
</html>
