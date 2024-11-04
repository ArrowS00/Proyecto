<?php
include '../modelo/conexion.php';
session_start();

// Verifica si se ha enviado un archivo
if (isset($_FILES['avatar'])) {
    $archivo_temporal = $_FILES['avatar']['tmp_name'];
    $nombre_archivo = $_FILES['avatar']['name'];
    $ruta_destino = '../otros/imagenes/' . $nombre_archivo;

    // Mueve el archivo cargado al directorio de avatares
    if (move_uploaded_file($archivo_temporal, $ruta_destino)) {
        // Guarda la ruta del avatar en la sesión
        $_SESSION['ruta_avatar'] = $ruta_destino;

        // Guarda la ruta del avatar en la base de datos
        $id_usuario = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        
        // Realiza la conexión a la base de datos (suponiendo que tienes una función para esto)
        $conexion = crearConexion();

         // Prepara la consulta para verificar si el usuario ya tiene un avatar
         $resultado = $conexion->prepare("SELECT * FROM avatar WHERE id_usuario = ?");
         $resultado->bind_param("s", $id_usuario);
 
         // Ejecuta la consulta
         $resultado->execute();
 
         // Obtiene los resultados
         $resultado = $resultado->get_result();

         if ($resultado->num_rows > 0) {
            // Si el usuario ya tiene un avatar, actualiza la ruta
            $resultado = $conexion->prepare("UPDATE avatar SET ruta_avatar = ? WHERE id_usuario = ?");
            $resultado->bind_param("ss", $ruta_destino, $id_usuario);
        } else {
            // Si el usuario no tiene un avatar, inserta un nuevo registro
            $resultado = $conexion->prepare("INSERT INTO avatar (ruta_avatar, id_usuario) VALUES (?, ?)");
            $resultado->bind_param("ss", $ruta_destino, $id_usuario);
        }


        // Ejecuta la consulta
        if ($resultado->execute()) {
            // Redirige a la página de perfil del usuario
            header('Location: ../vista/usuario.php');
            exit;
        } else {
            echo "Error al actualizar la ruta del avatar en la base de datos: " . $resultado->error;
        }
    } else {
        echo "Error al cargar el avatar.";
    }
}
?>

