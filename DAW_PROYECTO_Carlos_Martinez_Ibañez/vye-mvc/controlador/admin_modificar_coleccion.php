<?php
//controlador para modificar una colección

// Activar almacenamiento en búfer de salida
ob_start(); 
//Verificamos si la sesión está iniciada
if (!isset($_SESSION['id'])) {
    // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: ../vista/colecciones_admin.php");
    exit;
}

//Verificamos si se ha enviado el formulario de modificar la colección
if (!empty($_POST["boton_modificar"])) {
    //verificamos si los campos no están vacíos
    if (!empty($_POST["nombre"]) && !empty($_POST["pais"]) && !empty($_POST["ciudad"]) && !empty($_POST["comentario"]) && !empty($_POST["rating"])) {
        //Recuperamos los datos del formulario
        $id_coleccion=$_POST['id_coleccion'];
        $nombre = $_POST['nombre'];
        $pais = $_POST['pais'];
        $ciudad = $_POST['ciudad'];
        $comentario = $_POST['comentario'];
        $rating = $_POST['rating'];
        $id_usuario = $_SESSION['id'];

        
        //Consulta para modificar la colección
        $consulta = $conexion->prepare("UPDATE colecciones SET id_usuario = ?, nombre = ?, pais = ?, ciudad = ?, comentario = ?, rating = ? WHERE id_coleccion = ?");
        $resultado = $consulta->bind_param("isssssi", $id_usuario, $nombre, $pais, $ciudad, $comentario, $rating, $id_coleccion);
        $consulta->execute();
            
        echo '<div class="completo">Colección modificado correctamente</div>';

        //Verificamos si se ha modificado la colección
        if ($resultado==1) {
            $_SESSION['cambios_realizados'] = true;
            header("Location: ../vista/colecciones_admin.php");
            exit; // Asegúrate de terminar el script después de una redirección
        } else {
            echo '<div class="alerta">Error al modificar colección</div>';
        }

    } else {
        //echo '<div class="alerta">Rellene todos los campos</div>';
        // Código de depuración
        echo '<div class="alerta">Nombre: ' . $_POST["nombre"] . '</div>';
        echo '<div class="alerta">Pais: ' . $_POST["pais"] . '</div>';
        echo '<div class="alerta">Ciudad: ' . $_POST["ciudad"] . '</div>';
        echo '<div class="alerta">Comentario: ' . $_POST["comentario"] . '</div>';
        echo '<div class="alerta">Rating: ' . $_POST["rating"] . '</div>';
    }
    
}
// Enviar contenido del búfer de salida y desactivarlo
ob_end_flush(); 
?>