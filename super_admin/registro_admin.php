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
    $id_empresa = $_POST['id_empresa']; // Este es un ID manual, no autoincremental
    $nombre_empresa = $_POST['nombre_empresa'];
    try {
        $con->beginTransaction();

        // Verificar si la empresa con ese id ya existe
        $checkEmpresa = $con->prepare("SELECT id_empresa FROM empresas WHERE id_empresa = :id_empresa");
        $checkEmpresa->bindParam(':id_empresa', $id_empresa);
        
        $checkEmpresa->execute();
        $empresa = $checkEmpresa->fetch(PDO::FETCH_ASSOC);

        if (!$empresa) {
            // Si no existe, insertamos la empresa con el id proporcionado
            $insertEmpresa = $con->prepare("INSERT INTO empresas (id_empresa,nombre_empresa) VALUES (:id_empresa, :nombre_empresa)");
            $insertEmpresa->bindParam(':id_empresa', $id_empresa);
            $insertEmpresa->bindParam(':nombre_empresa', $nombre_empresa);  // o cambia esto si tienes otro campo para nombre de empresa
            $insertEmpresa->execute();
        }

        // Verificar si el documento ya existe
        $checkDoc = $con->prepare("SELECT * FROM clientes WHERE documento = :documento");
        $checkDoc->bindParam(':documento', $documento);
        $checkDoc->execute();

        if ($checkDoc->rowCount() > 0) {
            echo '<script>alert("El documento ya existe y no se puede repetir")</script>';
            echo '<script>window.location = "compra.php"</script>';
        } else {
            // Insertar cliente
            $insertCliente = $con->prepare("INSERT INTO clientes (documento, id_rol, nombre, email, telefono, contra, direccion, id_empresa)
                                            VALUES (:documento, :id_rol, :nombre, :email, :telefono, :contra, :direccion, :id_empresa)");

            $insertCliente->bindParam(':documento', $documento);
            $insertCliente->bindParam(':id_rol', $id_rol);
            $insertCliente->bindParam(':nombre', $nombre);
            $insertCliente->bindParam(':email', $email);
            $insertCliente->bindParam(':telefono', $telefono);
            $insertCliente->bindParam(':contra', $contra);
            $insertCliente->bindParam(':direccion', $direccion);
            $insertCliente->bindParam(':id_empresa', $id_empresa);

            $insertCliente->execute();
            $con->commit();

            echo '<script>alert("Registro insertado correctamente")</script>';
            echo '<script>window.location = "index.php"</script>';
        }
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro</title>
</head>
<!-- <body class="bg-light">
     -->
    <body onload="form.documento.focus()"></body>
     <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Registro</h2>
                        <form name="form" method="POST" autocomplete="off">

                            <div class="mb-3">
                                <label for="documento" class="form-label">Documento</label>
                                <input type="number" class="form-control" id="documento" name="documento">
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono Celular</label>
                                <input type="number" class="form-control" name="telefono" id="telefono">
                            </div>
                            <div class="mb-3">
                                <label for="contra" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contra" name="contra">
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            
                            <div class="mb-3">
                            <label for="id_empresa" class="form-label">ID de la Empresa</label>
                            <input type="text" class="form-control" id="id_empresa" name="id_empresa" required>
                            </div>
                            
                            <div class="mb-3">
                            <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required> 
                            </div>

                            <button type="submit" id="submit" name="submit" class="btn btn-primary w-100">Registrarse</button>
            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
