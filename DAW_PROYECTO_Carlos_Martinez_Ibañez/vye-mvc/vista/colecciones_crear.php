<?php
    //Archivo con las funciones, inicio de sesión y obtenemos los datos del usuario de la sesión actual
    include '../modelo/funciones.php';
    session_start();
      
    $nombre = operacionesUsuario::obtenerNombre();
    $apellidos = operacionesUsuario::obtenerApellidos();
    $rol = operacionesUsuario::obtenerRol();
    $usuario = operacionesUsuario::obtenerUsuario();   
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
    <link rel="stylesheet" type="text/css" href="../otros/css/style_usuario_crear_coleccion.css">    
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
                        <li><a href="../index.php"><span>Inicio</span></a></li>
                        <li><a href="colecciones.php"><span>Colecciones</span></a></li>
                        <li><a href="contacto.php"><span>Contacto</span></a></li>
                        <!-- Si el usuario es el administrador, mostrar enlace a la página de administrador -->
                        <?php if(operacionesAplicacion::esAdmin($rol)) { ?>
                            <li><a href="../vista/usuario.php"><span>Administrador</span></a></li>
                        <?php } ?>
                        <!-- Si está conectado el administrador o un usuario registrado, mostrar enlace para cerrar sesión -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <li><a href="../vista/usuario.php"><span>Perfil</span></a></li>
                        <?php } ?>    
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
                <img src="..\otros\iconos\usuario.png" alt="Usuario"></a>
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
            <div class="div-usuario"> 
                <span class="titulo-usuario">
                    <h2>
                        <!-- Logo de la web -->
                        <img class="logo-web" src="..\otros\iconos\logoG.png" alt="Usuario">
                        <?php 
                            // Mostramos el nombre y apellidos del usuario que ha iniciado sesión
                            echo $nombre . " " . $apellidos;
                        ?>
                        <!-- Icono para volver atrás -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <a href="colecciones_usuario.php" class="icono-atras" id="icono-usuario">
                                <img src="..\otros\iconos\atras.png" alt="Volver">
                                <span id="span-icono">Volver atrás</span>
                            </a>
                        <?php } ?>  
                </span>   
            </div> 

            <div class="tabla-usuario"> 
                <h2>Colecciones</h2>
                <!-- Formulario para crear una colección por el usuario registrado y campos de entrada -->
                <form action="..\controlador\controlador_crear_coleccion.php" method="post" enctype="multipart/form-data">
                    <div class="fila">
                        <div class="entrada">
                            <input type="text" placeholder="Nombre de la colección" id="nombre" name="nombre">
                        </div>
                        <div class="entrada"> 
                            <input type="text" placeholder="País del viaje" id="descripcion" name="pais">
                        </div>
                        <div class="entrada">
                            <input type="text" placeholder="Ciudad del viaje" id="nombre" name="ciudad">
                        </div>   
                    </div><br>
                    <div class="entrada">
                        <label for="comentario">Comentario</label><br>
                        <textarea id="comentario" placeholder="Comenta tu viaje" name="comentario" maxlength="500"></textarea>
                    </div><br>
                    
                    <fieldset class="rating">
                        <legend>Valoración del viaje</legend>
                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Excelente">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Bueno">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Normal">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="No tan bueno">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Malo">1 star</label>
                    </fieldset><br>
                    <!-- Botón para crear la colección -->
                    <button type="submit" class="boton-crear-coleccion"><span>Guardar</span></button>      
                </form>
            </div>   
        </div>
        <!-- Imagen de fondo de la web -->
        <img src="../otros\imagenes\barco.jpg" alt="imagen del mar" class="fondo-mar">
    </div>
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
    <!-- Script de JavaScript -->
    <script src="..\otros\js\control_usuario.js"></script>

</body> 
</html>
