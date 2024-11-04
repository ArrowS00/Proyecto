<?php
//controlador para modificar un usuario

// Activar almacenamiento en búfer de salida
ob_start(); 
// Verificamos si se enviio el formulario de modificar el usuario
if (!empty($_POST["boton_modificar"])) {
    //verificamos si los campos no están vacíos
    if (!empty($_POST["nombre"]) && !empty($_POST["apellidos"]) && !empty($_POST["usuario"]) && !empty($_POST["email"])) {
        $id=$_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];

        //Ejecutamos la consulta para modificar el usuario
        $resultado = crearConexion()->query("UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', email = '$email' WHERE id = $id");
        echo '<div class="completo">Usuario modificado correctamente</div>';
        //Verificamos si se ha modificado el usuario
        if ($resultado==1) {
            $_SESSION['cambios_realizados'] = true;
            header("Location: ../vista/admin.php");
            exit; // Asegúrate de terminar el script después de una redirección
        } else {
            echo '<div class="alerta">Error al modificar usuario</div>';
        }

    } else {
        echo '<div class="alerta">Rellene todos los campos</div>';
    }
}
// Enviar contenido del búfer de salida y desactivarlo
ob_end_flush(); 
?>