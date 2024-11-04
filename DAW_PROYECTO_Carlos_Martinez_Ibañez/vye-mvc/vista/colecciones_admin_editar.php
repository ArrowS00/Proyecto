<?php
//Archivo con las funciones, inicio de sesión y obtenemos los datos del usuario de la sesión actual
    include '../modelo/funciones.php';
    include '../modelo/conexion.php';
    session_start();
      
    $nombre = operacionesUsuario::obtenerNombre();
    $apellidos = operacionesUsuario::obtenerApellidos();
    $rol = operacionesUsuario::obtenerRol();
    $usuario = operacionesUsuario::obtenerUsuario();
    $id= operacionesUsuario::obtenerIdUsuario();
    $conexion = crearConexion();
    // Consultar la base de datos para obtener la colección actual
    $resultado = $conexion->query("SELECT * FROM colecciones where id_coleccion = $id");  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadatos y links a estilos y a las fuentes de googlefonts-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Viaja y Explora Administrador">
    <title>Viaja y Explora Administrador</title>
    <meta name="author" content="Carlos Martinez" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../otros/css/style_admin_modificar_colecciones.css">    
</head>

<body>
    <!-- Contenedor principal y contenido de la web -->
    <div class="div-general">
        <header id="header">
            <!-- Título de la página -->
            <h1>Viaja y Explora</h1> 
            <!-- Menú de navegación del usuario-->  
            <div class="div-nav-general">
                <nav class="div-nav">
                    <ul>
                        <!-- Enlaces para navegar, a las páginas de la web -->
                        <li><a href="../index.php"><span>Inicio</span></a></li>
                        <li><a href="colecciones.php"><span>Colecciones</span></a></li>
                        <li><a href="contacto.php"><span>Contacto</span></a></li>
                        <li><a href="../vista/admin.php"><span>Administrador</span></a></li>
 
                    </ul>
                </nav>
            </div>

            <div class="inicio_sesion">
                <?php 
                    // Mostramos el nombre de usuario
                    echo operacionesUsuario::obtenerUsuario();     
                ?>
            </div>  
            <!-- Icono de usuario y menú de usuario --> 
            <div class="usuario">
                <a href="usuario.php" class="icono-ajustes"><img src="..\otros\iconos\usuario.png" alt="Usuario"></a>
                <div class="menu-usuario">
                    <!-- Se muestra el enlace para iniciar sesión si el usuario no está logeado -->
                    <?php if(operacionesUsuario::estaIniciado()) { ?>
                    <a href="vista/login.php"><span>Identificarse</span></a>
                    <?php } ?>
                    <a href="..\controlador\controlador_cerrar_sesion.php">Desconectar</a>
                </div>
            </div>           
               
        </header>

        <!-- Contenido de la web -->
        <div id="div-1">          
            <div class="div-coleccion" >
                <form method="POST" class="formulario" >
                <h2>Modificar Coleccion</h2><br>
                <!-- Formulario para modificar la colección -->
                <input type="hidden" name="id_coleccion" value="<?= $_GET["id"] ?>">
                        <?php
                        //conmtrolador para modificar la colección
                        include '..\controlador\admin_modificar_coleccion.php';
                        // Iteramos sobre los datos de la colección
                        while($datos=$resultado->fetch_object()) {?> 
                        <div class="padre">                   
                            <div class="nombre">
                                <span for="nombre">Editar nombre</span>
                                <input type="text" placeholder="Nombre" class="input" name="nombre" value="<?= $datos->nombre ?>"><br><br>        
                            </div>
                            <div class="pais">
                                <span for="pais">Editar país</span>
                                <input type="text" placeholder="País" class="input" name="pais" value="<?= $datos->pais ?>"><br><br>
                            </div><br>
                            <div class="ciudad">
                                <span for="ciudad">Editar ciudad</span>
                                <input type="text" placeholder="Ciudad" class="input" name="ciudad" value="<?= $datos->ciudad ?>"><br><br>
                            </div><br>
                            <div class="comentario">
                                <span for="comentario">Editar comentario</span>
                                <textarea placeholder="Comentario" class="input-comentario" name="comentario" rows="10"><?= formatear_comentario($datos->comentario) ?></textarea><br><br>
                            </div><br>
                            <div class="rating">
                                <span for="rating">Valoración</span>
                                <input type="text" placeholder="Rating" class="input" name="rating" value="<?= $datos->rating ?>"><br><br>
                            </div><br>
                            <div class="div-boton">
                                <!-- Botón para enviar el formulario y modificar la colección -->
                                <button type="submit" name="boton_modificar" class="boton" value="ok">Modificar</button>
                            </div>
                        </div> 
                    <?php } ?>                          
                </form>
        </div>             
    </div>
    <!-- Fondo de la web -->                     
    <img src="../otros\imagenes\barco.jpg" alt="imagen del mar" class="fondo-mar">
    <!-- Pie de página -->
    <footer id="div-footer">
        <div class="contenedor-footer">
            <p class="copy">Viaja y Explora &copy; 2024</p>
            <div class="redes">
                <a class="icono-facebook" href="#"></a>
                <a class="icono-twitter" href="#"></a>
                <a class="icono-instagram" href="#"></a>
                <a class="icono-gmail" href="#"></a>
            </div>
    </footer>

    <script src="..\otros\js\control_usuario.js"></script>

</body> 
</html>
