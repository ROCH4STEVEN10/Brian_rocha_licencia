<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Venta</title>
</head>
<body>
    <h2>Formulario de Registro de Venta</h2>

    <?php if (isset($_GET['mensaje'])): ?>
        <p style="color:green;"><?php echo $_GET['mensaje']; ?></p>
    <?php endif; ?>

    <form action="guardar_venta.php" method="POST">
        <label>Documento del Cliente:</label><br>
        <input type="number" name="documento" required><br><br>

        <label>Fecha:</label><br>
        <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required><br><br>

        <label>Total:</label><br>
        <input type="number" step="0.01" name="total" required><br><br>

        <button type="submit">Guardar Venta</button>
    </form>
</body>
</html>
