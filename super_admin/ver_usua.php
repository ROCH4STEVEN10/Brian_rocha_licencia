<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

// Consulta con JOIN para mostrar el nombre de la empresa
$sql = "SELECT c.documento, c.nombre, c.email, c.telefono, c.direccion, c.id_empresa, e.nombre_empresa AS empresas
        FROM clientes c
        JOIN empresas e ON c.id_empresa = e.id_empresa";

$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
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
        <h2>Clientes Registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Empresa</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $fila['documento'] ?></td>
                        <td><?= $fila['nombre'] ?></td>
                        <td><?= $fila['email'] ?></td>
                        <td><?= $fila['telefono'] ?></td>
                        <td><?= $fila['direccion'] ?></td>
                        <td><?= $fila['empresas'] ?></td>
                        <td><a href="editar_cliente.php?documento=<?= $fila['documento'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="eliminar_cliente.php?documento=<?= $fila['documento'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a></td>
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
