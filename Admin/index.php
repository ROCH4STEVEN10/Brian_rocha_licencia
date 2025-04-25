<?php

require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();


// $email = $_SESSION['email'];

// $sql = $con->prepare("SELECT clientes.nombre, empresas.nombre_empresa, empresas.id_empresa FROM clientes INNER JOIN rol ON clientes.id_rol = rol.id_rol INNER JOIN empresas ON clientes.id_empresa = empresas.id_empresa WHERE clientes.email = ? AND clientes.id_rol = 1
// ");
// $sql->execute([$email]);
// $fila = $sql->fetch(PDO::FETCH_ASSOC);


// if (!$fila) {
//     echo '<script>alert("No se encontró información del administrador.");</script>';
//     echo '<script>window.location = "../login.php";</script>';
//     exit();
// }


// $nombre = $fila['nombre'];
// $empresa = $fila['nombre_empresa'];
// $nit = $fila['id_empresa'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient( right,rgba(255, 8, 8, 0.33), #f5faff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color:rgb(0, 0, 0);
            margin-bottom: 10px;
        }

        h3 {
            font-size: 18px;
            color: #34495e;
            margin-bottom: 25px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 12px;
        }

        a {
            display: block;
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        a:hover {
            background-color: #217dbb;
        }

        .secondary-link {
            margin-top: 25px;
            display: inline-block;
            font-size: 14px;
            color: #555;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .secondary-link:hover {
            color: #000;
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px;
            }

            h1 {
                font-size: 22px;
            }

            a {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenido al Sistema</h1>
        <h3>Módulos principales</h3>
        <ul>
            <li><a href="procesa.php">Procesadores</a></li>
            <li><a href="crear_usua.php">Crear Usuarios</a></li>
            <button onclick="location.href='../include/salir.php'" class="btn btn-primary">
            Cerrar sesión
        </ul>
        
    </div>
</body>
</html>
