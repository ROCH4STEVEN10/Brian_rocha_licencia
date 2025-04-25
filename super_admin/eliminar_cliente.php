<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    $sql = "DELETE FROM clientes WHERE documento = :documento";
    $stmt = $con->prepare($sql);
    $stmt->execute([':documento' => $documento]);
}

header("Location: ver_usua.php");
exit;
?>
