<?php
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
    include 'modelo/funciones.php';
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
    <link rel="stylesheet" type="text/css" href="otros\css\style.css">    
</head>

<body>
    <!-- Contenido de la web -->
    <div class="div-general">
        <header id="header">
            <!-- Título de la página -->
            <h1>Viaja y Explora</h1>  
            <div class="div-nav-general">
                <nav class="div-nav">
                    <!-- Menú de navegación del usuario-->
                    <ul>
                        <li><a href="index.php"><span>Inicio</span></a></li>
                        <li><a href="vista/colecciones.php"><span>Colecciones</span></a></li>
                        <li><a href="vista/contacto.php"><span>Contacto</span></a></li>
                        <!-- Mostrar enlace a la página admin.php si el usuario es administrador -->
                        <?php if(operacionesAplicacion::esAdmin($rol)) { ?>
                            <li><a href="vista/admin.php"><span>Administrador</span></a></li>
                        <?php } ?>
                        <!-- Mostrar enlace a la página de usuario si el usuario es un usuario registrado -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <li><a href="vista/usuario.php"><span>Perfil</span></a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
            
            <!-- Mostrar el nombre de "usuario" si es un usuario registrado, "admin" si es el administrador y "usuario invitado" -->
            <div class="inicio_sesion">
                <?php 
                    echo operacionesUsuario::obtenerUsuario();
                ?>
            </div>  
            <div class="usuario">
                <!-- Icono de usuario y menú desplegable -->
                <img src="otros\iconos\usuario.png" alt="Usuario">
                <div class="menu-usuario">
                    <?php 
                        $nombre = operacionesUsuario::obtenerNombre();
                        $rol = operacionesUsuario::obtenerRol();
                        // Si el usuario es un invitado, mostrar enlaces para iniciar sesión y registrarse
                        if($nombre == 'Usuario Invitado') { ?>
                        <a href="vista/login.php"><span>Identificarse</span></a>
                        <a href="vista/registro.php"><span>Crear cuenta</span></a>
                        <?php } else { ?>
                        <!-- Si el usuario es un usuario registrado, mostrar enlace a la página de perfil -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                        <a href="vista/usuario.php">Perfil Usuario</a>
                        <?php } ?>
                        <!-- Si el usuario es el administrador, mostrar enlace a la página de administrador -->
                        <?php if(operacionesAplicacion::esAdmin($rol)) { ?>
                        <a href="vista/admin.php"><span>Administrador</span></a>
                        <?php } ?>
                        <!-- Si está conectado el administrador o un usuario registrado, mostrar enlace para cerrar sesión -->
                        <?php if(operacionesAplicacion::esUsuario($rol) || operacionesAplicacion::esAdmin($rol)) { ?>
                        <a href="controlador/controlador_cerrar_sesion.php">Desconectar</a>
                    <?php } ?>
                    <?php } ?>    
                </div>
            </div>
        </header>

        <!-- Contenido principal de la página, título con javascript e información de la web-->
        <div id="div-1">
            <div class="centro"> 
                <span class="titulo"><h2>Viaja y Explora</h2></span>
                <p>La mejor forma de no olvidar tus viajes por el mundo</p>
            </div>
        </div>

        <div id="div-2" class="colecciones">
                <h2>Descripción</h2><br>
                <p>¡Bienvenido a Viaja y Explora Administrador!
                Explora el mundo a través de nuestras emocionantes colecciones de viajes, donde cada destino es una puerta hacia aventuras inolvidables.
                Descubre colecciones creadas por otros usuarios. Crea detalladas descripciones y valoraciones para que otros usuarios encuentren la 
                inspiración perfecta para su próximo viaje. ¡Prepárate para vivir experiencias únicas!
        </div>
        
        <!-- Imagen de fondo -->
        <img src="otros\imagenes\barco.jpg" alt="imagen del mar" class="fondo-mar">

    </div>

    <!-- Pie de página -->
    <footer id="div-footer">
        <div class="contenedor-footer">
            <p class="copy">Viaja y Explora &copy; 2024</p>
            <div class="redes">
                <a class="icono-facebook" href="#"></a>
                <a class="icono-twitter" href="#"></a>
                <a class="icono-instagram" href="#"></a>
                <a class="icono-gmail" href="..\otros\iconos\email.png"><i></i></a>
            </div>
    </footer>
    
    <!-- Script de JavaScript para la animación del título -->
    <script src="otros\js\control_titulo.js"></script>

</body> 
</html>

