<?php
//controlador para borrar una colección

include '../modelo/funciones.php';

//obtenemos el id de la colección a borrar
$id_coleccion = $_GET['id'];

//muestramos un mensaje de confirmación
echo "Borrando colección con id: $id_coleccion<br>";
$resultado = borrarColeccion($id_coleccion);
echo "Resultado de borrarColeccion: $resultado<br>";

//Si se ha borrado la colección redirigimos a la página de colecciones_admin.php sino error
if ($resultado) {
    header('Location: ..\vista\colecciones_admin.php');
} else {
    echo "Error al borrar la colección";
}
?>