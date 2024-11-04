<?php
    //inicio de sesión
    session_start();
    //destruye la sesión
    session_destroy();
    //redirige a la página de inicio
    header('Location: ../index.php');

?>