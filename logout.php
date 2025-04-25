<?php
session_start();
session_destroy(); // Destruye la sesión
session_unset();   // Elimina todas las variables de sesión

// Redirige al usuario al login
header("Location: index.php");
exit();
?>
