<?php
//controlador para crear una colección
include '..\modelo\funciones.php';
include '..\modelo\conexion.php';

$conexion = crearConexion();
//iniciar sesión si no está iniciada
session_start();
//Recuperamos los datos del formulario y la id del usuario de la sesión
$id_usuario = $_SESSION['id']; 
$nombre = $_POST['nombre'];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$comentario = $_POST['comentario'];
$rating = $_POST['rating'];

// Crea una nueva instancia de la clase Coleccion y llama al método crearColeccion() para insertar los datos de la colección en la base de datos
$coleccion = new Coleccion();
$id_coleccion = $coleccion->crearColeccion($id_usuario, $nombre, $pais, $ciudad, $comentario, $rating);
//Verificamos la creación de la colección
if ($id_coleccion) {
    echo "Nueva colección creada con éxito.";
    header("Location: ../vista/colecciones_usuario.php"); // Redirige a colecciones_usuario.php
    exit;
   
} else {
    echo "Error al crear la colección en la tabla colecciones.";
}
?>
