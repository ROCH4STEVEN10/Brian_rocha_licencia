<?php
session_start();
unset($_SESSION['documento']);
session_destroy();
session_write_close();

header("Location:../index.php");
?>
