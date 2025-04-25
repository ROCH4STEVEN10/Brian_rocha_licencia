<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_empresa = $_POST['id_empresa'];
    $nombre_empresa = $_POST['nombre_empresa'];

    try {
        $sql = "INSERT INTO empresas (id_empresa, nombre_empresa) VALUES (:id_empresa, :nombre_empresa)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_empresa', $id_empresa);
        $stmt->bindParam(':nombre_empresa', $nombre_empresa);
        $stmt->execute();

        header("Location: index.php?mensaje=Empresa registrada correctamente");
        exit;
    } catch (PDOException $e) {
        echo "❌ Error al registrar la empresa: " . $e->getMessage();
    }
}
?>
