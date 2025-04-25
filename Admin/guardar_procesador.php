<?php
require_once('../config/conex.php'); // Asegúrate de que este archivo contenga la clase Database

$db = new Database();
$conexion = $db->conectar(); // Conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $codigo_barras = $_POST['codigo_barras'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $nucleos = $_POST['nucleos'];
    $hilos = $_POST['hilos'];
    $frecuencia_base = $_POST['frecuencia_base'];
    $precio_uni = $_POST['precio_uni'];

    try {
        // Ajusta los nombres de columna si alguno está diferente en tu tabla real
        $sql = "INSERT INTO procesadores (codigo_barras, marca, modelo, nucleos, hilos, frecuencia_base, precio_uni)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la consulta y ejecutar la inserción
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            $codigo_barras,
            $marca,
            $modelo,
            $nucleos,
            $hilos,
            $frecuencia_base,
            $precio_uni
        ]);

        // Redireccionar con un mensaje de éxito
        header("Location: registrar_procesador.php?mensaje=Procesador guardado correctamente");
        exit();
    } catch (PDOException $e) {
        echo "Error al guardar el procesador: " . $e->getMessage();
    }
}
?>
