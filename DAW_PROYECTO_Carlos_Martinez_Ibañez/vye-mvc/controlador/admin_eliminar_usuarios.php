<?php
//controlador para eliminar un usuario

// Verifica si se ha enviado el formulario de eliminar usuario
if (!empty($_GET['id'])) {
    //Obtenemos el id del usuario a eliminar
    $id = $_GET['id'];
    $conexion = crearConexion();
    // Elimina las filas en la tabla 'recuperacion' que son clave foránea de la tabla 'usuarios'
    $conexion->query("DELETE FROM recuperacion WHERE email = (SELECT email FROM usuarios WHERE id = $id)");
    // Elimina las filas en la tabla 'avatar' que hacen referencia al usuario
    $conexion->query("DELETE FROM avatar WHERE id_usuario = $id");
    // Elimina el usuario
    $sql = $conexion->query("DELETE FROM usuarios WHERE id = $id");

    //Verificamos si se ha eliminado el usuario
    if ($sql==1) {
        echo '<div class="completo">Usuario eliminado correctamente</div>';
        
    } else {
        echo '<div class="alerta">Error al eliminar usuario</div>';
    }
} 
?>