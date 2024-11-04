<?php
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
    include '../modelo/funciones.php';
    session_start();
     
    $nombre = operacionesUsuario::obtenerNombre();
    $apellidos = operacionesUsuario::obtenerApellidos();
    $rol = operacionesUsuario::obtenerRol();
    $usuario = operacionesUsuario::obtenerUsuario();
    $id = operacionesUsuario::obtenerIdDeSesion();

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
    <link rel="stylesheet" type="text/css" href="../otros/css/style_usuario.css">    
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
                        <li><a href="../index.php"><span>Inicio</span></a></li>
                        <li><a href="colecciones.php"><span>Colecciones</span></a></li>
                        <li><a href="contacto.php"><span>Contacto</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Mostrar el nombre de "usuario" si es un usuario registrado, "admin" si es el administrador y "usuario invitado" -->
            <div class="inicio_sesion">
                <?php 
                    echo operacionesUsuario::obtenerUsuario(); ;     
                ?>
            </div>  
            <div class="usuario">
                <!-- Icono de usuario y menú desplegable -->
                <img src="..\otros\iconos\usuario.png" alt="Usuario">
                <div class="menu-usuario">
                    <?php if(operacionesUsuario::estaIniciado()) { ?>
                    <a href="vista/login.php"><span>Identificarse</span></a>
                    <?php } ?>
                    <!-- Enlace para cerrar la sesión con el controlador -->
                    <a href="..\controlador\controlador_cerrar_sesion.php">Desconectar</a>
                </div>
            </div>               
        </header>

        <div id="div-1">
            <div class="div-usuario"> 
                <span class="titulo">
                    <h2>
                        <img class="logo-web" src="..\otros\iconos\logoG.png" alt="Usuario">
                        <?php 
                            // Mostrarmos el nombre y apellidos del usuario
                            echo $nombre . " " . $apellidos;
                        ?>
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <!-- Si el usuario esta conectado, mostramos el enlace a sus colecciones -->
                            <a href="colecciones_usuario.php" class="boton_ir">Ir a colecciones</a>
                        <?php } ?>
                    </h2>
                </span>
            </div>  
            <div class="perfil-usuario">
                <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                    <?php
                        // Si el usuario esta conectado, mostramos su perfil
                        operacionesAplicacion::mostrarPerfilUsuario($id);
                    ?>
                <?php } ?>
            </div>
        </div>
        <!-- Imagen de fondo -->
        <img src="../otros\imagenes\barco.jpg" alt="imagen del mar" class="fondo-mar">

    </div>

    <footer id="div-footer">
        <div class="contenedor-footer">
            <!-- Información del pie de página lo que se va a ver-->
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

