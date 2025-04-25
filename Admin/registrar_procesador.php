<?php
// Aquí verificamos si existe un mensaje en la URL
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    echo "<div class='alert alert-success' role='alert'>$mensaje</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Procesador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Registrar Procesador</h2>
        <!-- Aquí iría el formulario de registro del procesador -->
        <!-- Resto del contenido -->
    </div>
</body>
</html>
