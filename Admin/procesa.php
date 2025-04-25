<?php
// Incluir la clase Database para conectar a la base de datos
require_once('../config/conex.php');
$db = new Database();
$conexion = $db->conectar(); // Conexión PDO
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Procesador</title>
    <style>
        body {
            background-color: #d9f2f2;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 40px;
        }
        .container {
            display: flex;
            gap: 30px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-section, .barcode-section {
            width: 100%;
        }
        .form-section input, .form-section button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-section label {
            font-weight: bold;
        }
        .form-section button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .barcode-section {
            text-align: center;
        }
        .barcode-section img {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 5px;
            background-color: #f9f9f9;
        }
        .barcode-buttons button {
            margin: 5px;
            padding: 8px 15px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .barcode-buttons button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <form action="guardar_procesador.php" method="POST">
            <label>Código de Barras:</label>
            <!-- El código de barras ahora se ingresa manualmente -->
            <input type="text" name="codigo_barras" value="" required>

            <label>Marca:</label>
            <input type="text" name="marca" required>

            <label>Modelo:</label>
            <input type="text" name="modelo" required>

            <label>Núcleos:</label>
            <input type="number" name="nucleos" min="1" required>

            <label>Hilos:</label>
            <input type="number" name="hilos" min="1" required>

            <label>Frecuencia Base (GHz):</label>
            <input type="number" step="0.1" name="frecuencia_base" required>

            <label>Precio Unitario:</label>
            <input type="number" step="0.01" name="precio_uni" required>

            <button type="submit">Guardar Procesador</button>
        </form>
    </div>

    <div class="barcode-section">
        <h3>Código Generado</h3>
        <div id="barcode-img">
            <?php 
            if(isset($_POST['codigo_barras']) && !empty($_POST['codigo_barras'])) {
                $codigo_barras = $_POST['codigo_barras'];
                echo '<img src="/tienda_proce/Admin/barcode.php?text=' . $codigo_barras . '" alt="Código de Barras">';
            }
            ?>
        </div>
        <div class="barcode-buttons">
            <button onclick="window.print()">Imprimir</button>
            <button onclick="downloadBarcode()">Descargar</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadBarcode() {
        html2canvas(document.querySelector('#barcode-img')).then(canvas => {
            const link = document.createElement('a');
            link.download = 'codigo_barras_<?php echo isset($codigo_barras) ? $codigo_barras : ''; ?>.png';
            link.href = canvas.toDataURL();
            link.click();
        });
    }
</script>

</body>
</html>
