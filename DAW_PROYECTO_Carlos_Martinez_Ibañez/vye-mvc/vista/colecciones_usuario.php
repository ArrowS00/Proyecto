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
    <link rel="stylesheet" type="text/css" href="../otros/css/style_usuario_coleccion.css">    
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


        <div id="div-1">
            <div class="div-usuario"> 
                <span class="titulo">
                    <h2>
                        <!-- Logo de la web -->
                        <img class="logo-web" src="..\otros\iconos\logoG.png" alt="Usuario">
                        <?php 
                            // Mostramos el nombre y apellidos del usuario que ha iniciado sesión
                            echo $nombre . " " . $apellidos;
                        ?>
                        <!-- Icono para volver atrás -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <a href="usuario.php" class="icono-ajustes" id="icono-usuario">
                                <img src="..\otros\iconos\atras.png" alt="Volver">
                                <span id="span-icono">Volver atrás</span>
                            </a>
                        <?php } ?>
                    </h2>
                </span>
            </div> 

            
            <div class="tabla-usuario"> 
                <!-- Boton para crear la colección -->
                <a href="colecciones_crear.php"><button type="button" class="boton-crear">Crear colección</button></a>
                <table class="tabla">
                    <thead>
                        <th scope="col">País</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Valoración</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        <?php
                        // Mostramos la coleccion del usuario
                        operacionesAplicacion::mostrarColeccionesUsuario(operacionesUsuario::obtenerIdSesion()); 
                        ?>
                    </tbody>
                </table>
            </div>   
        </div>
        <!-- Imagen de fondo -->
        <img src="..\otros\imagenes\barco.jpg" alt="imagen del mar" class="fondo-mar">
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
    <!-- Script de javascript -->
    <script src="..\otros\js\control_usuario.js"></script>

</body> 
</html>
