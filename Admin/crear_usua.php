<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

if (isset($_POST['submit'])) {
    $documento = $_POST['documento'];
    $id_rol = 1;
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contra = password_hash($_POST['contra'], PASSWORD_BCRYPT);
    $direccion = $_POST['direccion'];

    try {
        // Verificar si el documento ya existe
        $checkDoc = $con->prepare("SELECT * FROM clientes WHERE documento = :documento");
        $checkDoc->bindParam(':documento', $documento);
        $checkDoc->execute();

        if ($checkDoc->rowCount() > 0) {
            echo '<script>alert("El documento ya existe. Intenta con otro.")</script>';
            echo '<script>window.location = "crear_usua.php"</script>';
        } else {
            // Insertar nuevo usuario
            $insertUser = $con->prepare("INSERT INTO clientes (documento, id_rol, nombre, email, telefono, contra, direccion)
                                         VALUES (:documento, :id_rol, :nombre, :email, :telefono, :contra, :direccion)");
            $insertUser->bindParam(':documento', $documento);
            $insertUser->bindParam(':id_rol', $id_rol);
            $insertUser->bindParam(':nombre', $nombre);
            $insertUser->bindParam(':email', $email);
            $insertUser->bindParam(':telefono', $telefono);
            $insertUser->bindParam(':contra', $contra);
            $insertUser->bindParam(':direccion', $direccion);
            $insertUser->execute();

            echo '<script>alert("Usuario registrado correctamente")</script>';
            echo '<script>window.location = "index.php"</script>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <style>
        /* General body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form container */
        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        /* Form heading */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Form group styling */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Button styles */
        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        /* Focus state for input fields */
        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <form method="POST" action="" class="form-register">
            <h2>Registrar Usuario</h2>

            <div class="form-group">
                <label for="documento">Documento</label>
                <input type="text" name="documento" id="documento" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" required>
            </div>

            <div class="form-group">
                <label for="contra">Contraseña</label>
                <input type="password" name="contra" id="contra" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" required>
            </div>

            <button type="submit" name="submit" class="btn-submit">Registrar</button>
        </form>
    </div>

</body>
</html>
