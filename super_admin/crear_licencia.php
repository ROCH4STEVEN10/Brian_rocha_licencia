<?php
require ('../config/conex.php');
// Si usas Picqer

$db = new Database();
$conexion = $db->conectar(); // <- Aquí obtienes el PDO

function generarIdLicencia($length = 10) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id = '';
    for ($i = 0; $i < $length; $i++) {
        $id .= $caracteres[random_int(0, strlen($caracteres) - 1)];
    }
    return $id;
}

// Obtener empresas y estados
$empresas = $conexion->query("SELECT id_empresa, nombre_empresa FROM empresas")->fetchAll();
$estados = $conexion->query("SELECT id_estado, estado FROM estado")->fetchAll();


$mensaje = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_licencia = generarIdLicencia();
    $id_empresa = $_POST['id_empresa'];
    $id_tip_lice = $_POST['tipo_licencia'];
    $fecha_ini = $_POST['fecha_ini'];
    $fecha_expira = $_POST['fecha_expira'];
    $id_estado = $_POST['id_estado'];
    // $codigo_barras = uniqid('LIC-');

    $stmt = $conexion->prepare("INSERT INTO licencias 
        (id_licencia, id_empresa, id_tip_lice, fecha_ini, fecha_expira, id_estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_licencia, $id_empresa, $id_tip_lice, $fecha_ini, $fecha_expira, $id_estado]);

    $mensaje = "Licencia creada con éxito. Código de barras generado:";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Licencia</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        form {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box input, .input-box select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input-box select {
            cursor: pointer;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .input-box label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-box option {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <form method="POST" action="" autocomplete="off">
        <h1>Crear Licencia</h1>

        <div class="input-box">
            <?php $id_generado = generarIdLicencia(); ?>
            <input type="text" name="id_licencia" id="id_licencia" placeholder="Código de Licencia" required value="<?php echo $id_generado; ?>" readonly>
        </div>

        <div class="input-box">
            <label for="id_estado">Estado</label>
            <select name="id_estado" required>
                <option value="">Seleccione el estado</option>
                <?php
                $sql = $conexion->prepare("SELECT * FROM estado");
                $sql->execute();
                while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fila['id_estado'] . "'>" . $fila['estado'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="input-box">
            <label for="tipo_licencia">Tipo de Licencia</label>
            <select name="tipo_licencia" id="tipo_licencia" required onchange="actualizarFechas()">
                <option value="">Seleccione el tipo de licencia</option>
                <?php
                $sql = $conexion->prepare("SELECT * FROM tipo_licencia");
                $sql->execute();
                while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fila['id_tip_lice'] . "' data-duracion='" . $fila['duracion'] . "'>" . 
                    $fila['tipo_licencia'] . " - precio: " . $fila['precio'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="input-box">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" required>
                <option value="">Seleccione la empresa</option>
                <?php
                $sql = $conexion->prepare("SELECT * FROM empresas");
                $sql->execute();
                while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fila['id_empresa'] . "'>" . $fila['nombre_empresa'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="input-box">
            <label for="fecha_ini">Fecha de inicio:</label>
            <input type="date" name="fecha_ini" id="fecha_ini" required>
        </div>

        <div class="input-box">
            <label for="fecha_expira">Fecha de fin:</label>
            <input type="date" name="fecha_expira" id="fecha_expira" required>
        </div>

        <button type="submit" name="submit" class="btn">Registrar Licencia</button>
    </form>
</div>

<script>
function actualizarFechas() {
    const select = document.getElementById("tipo_licencia");
    const selectedOption = select.options[select.selectedIndex];
    const duracionDias = parseInt(selectedOption.getAttribute("data-duracion"));

    if (isNaN(duracionDias)) {
        document.getElementById("fecha_ini").value = "";
        document.getElementById("fecha_expira").value = "";
        return;
    }

    const hoy = new Date();
    const fechaFin = new Date(hoy);
    fechaFin.setDate(fechaFin.getDate() + duracionDias);

    const formato = (fecha) => fecha.toISOString().split('T')[0];

    document.getElementById("fecha_ini").value = formato(hoy);
    document.getElementById("fecha_expira").value = formato(fechaFin);
}
</script>

</body>
</html>
