<?php
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
    include_once '../modelo/funciones.php';
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
    <link rel="stylesheet" type="text/css" href="..\otros\css\style_login.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />   
</head>


<body>
    <!-- Contenido de la web -->
    <div class="div-general">
        <header id="header">
            <!-- Título de la página -->
            <h1>Viaja y Explora</h1> 
            <div class="div-nav-general">
                <nav class="div-nav">
                    <ul>
                        <!-- Menú de navegación del usuario-->
                        <li><a href="../index.php"><span>Inicio</span></a></li>
                        <li><a href="../vista/colecciones.php"><span>Colecciones</span></a></li>
                        <li><a href="../vista/contacto.php"><span>Contacto</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="inicio_sesion">
                <?php 
                    // Mostramos el nombre de usuario
                    echo operacionesUsuario::obtenerUsuario();
                ?>
            </div>  
            <!-- Información del usuario -->
            <div class="usuario">
                <!-- Icono de usuario y menú desplegable -->
                <img src="..\otros\iconos\usuario.png" alt="Usuario">
                <div class="menu-usuario">
                    <?php 
                        $nombre = operacionesUsuario::obtenerNombre();
                        $rol = operacionesUsuario::obtenerRol();
                        // Si el usuario es un invitado, mostrar enlaces para iniciar sesión y registrarse
                        if($nombre == 'Usuario Invitado') { ?>
                        <a href="login.php"><span>Identificarse</span></a>
                        <a href="registro.php"><span>Crear cuenta</span></a>
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
            <div class="div-login" id="div-login">
                <!--Formulario de login -->
                <div class="contenedor-login">
                    <form action="login.php" method="post">
                    <h2>Identificarse</h2>
                    <!-- Mensaje de error generado por la aplicación, lo mostramos-->
                        <?php 
                        operacionesAplicacion::mostrarMensajeError();
                         ?>
                        <div class="padre"><br>
                            <div>
                                <!-- Campo de entrada para el email -->
                                <label for="email"></label>
                                <input type="email" placeholder="Email" class="input" id="email" name="email" autocomplete="on"><br><br>
                            </div>
                            <div class="contenedor-pass">
                                <!-- Campo de entrada para la contraseña -->
                                <label for="pass"></label>
                                <input type="password" placeholder="Contraseña" class="input" id="pass" name="password">
                                    <!-- Icono para mostrar y ocultar la contraseña -->
                                    <span class="ojo">
                                        <span class="material-symbols-outlined" id="icono-ojo" onclick="verPass()">visibility</span>
                                    </span> 
                            </div><br>
                            <div>
                                <!-- Botón para el envio del formulario -->
                                <input name="btnlogin" class="boton" type="submit" value="Identificarse">
                            </div><br>
                            <div class="olvidar_crear">
                                <a class="recuperacion" href="Recuperacion_contrasena.php">Recuperar contraseña</a><br><br>
                                <a class="registro" href="registro.php">Registrarse</a>
                            </div>                           
                        </div> 
                    </form>
                </div>
            </div>  
        </div>
        <!-- Imagen de fondo -->
        <img src="../otros\imagenes\barco.jpg" alt="imagen del mar" class="fondo-mar">
    </div>              
</body> 
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
    <!-- Scripts de javascript de control del título y la visión de la contraseña -->
    <script src="..\otros\js\control_titulo.js"></script>
    <script src="..\otros\js\control_ojo.js"></script>
 


    
    
