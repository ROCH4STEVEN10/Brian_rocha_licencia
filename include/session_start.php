<?php
require_once('../config/conex.php');
$conex = new Database;
$con = $conex->conectar();
session_start();

if (isset($_POST['submit'])){

    $documento = $_POST['documento'];
    $passwordDesc = htmlentities(addslashes($_POST['contra']));
    $sql = $con->prepare("SELECT * FROM clientes where documento = '$documento'");
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    if ($fila) {

        if (password_verify($passwordDesc, $fila['contra'])) {
            $_SESSION['documento'] = $fila['contra'];
            $_SESSION['contra'] = $fila['contra'];
            $_SESSION['id_rol'] = $fila['id_rol'];
            echo $_SESSION['documento'], $_SESSION['contra'], $_SESSION['id_rol'];

            if ($_SESSION['id_rol'] == 1) {
                header("location: ../Admin/index.php");
                exit();
            } elseif ($_SESSION['id_rol'] == 2) {
                header("location: ../super_admin/index.php");
                exit();
            } elseif ($_SESSION['id_rol'] == 3) {
                header("location: ../usuario/index.php");
                exit();
            
            } else {
                echo '<script>alert("Usuario no registrado")</script>';
                echo '<script>window.location = "../registro.php"</script>';
                exit();
            }
        } else {
            die("Credenciales incorrectas");
        }
    }
}

?>