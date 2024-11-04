<?php 

	//Funciónm para crear la conexión con la base de datos
	function crearConexion() {
		// Conexión a la base de datos
		$host = "localhost";
		$user = "root";
		$pass = "arrows22";
		$baseDatos = "vye";

		//Establece la conexión con la base de datos
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);
		$conexion->set_charset("utf8");
		//Devuelve la conexión a la base de datos
		return $conexion;	
	}


	function cerrarConexion($conexion) {
		// Cierra la conexión con la base de datos.
		mysqli_close($conexion);
	}


?>
