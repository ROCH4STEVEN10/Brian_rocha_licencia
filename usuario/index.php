<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Secundario</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #2f3e46;
            margin-bottom: 30px;
            font-size: 28px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin: 12px 0;
        }

        a {
            display: block;
            text-decoration: none;
            background: #0077cc;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        a:hover {
            background: #005fa3;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: #555;
            text-decoration: underline;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #000;
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px;
                border-radius: 12px;
            }

            h1 {
                font-size: 22px;
            }

            a {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Módulos Relacionados</h1>
        <ul>
            <li><a href="compra.php">compras</a></li>
            <li><a href="ver_compras.php">Ver_compras</a></li>
            <button onclick="location.href='../include/salir.php'" class="btn btn-primary">
            Cerrar sesión
            <!-- <li><a href="detalle_venta.php">Detalle de Venta</a></li>
            <li><a href="crear_licencia.php">Crear Nueva Licencia</a></li>
            <li><a href="licencias.php">ver licencias</a></li> -->
        </ul>
        <!-- <a class="back-link" href="index.php">← Volver al menú principal</a> -->
    </div>
</body>
</html>
