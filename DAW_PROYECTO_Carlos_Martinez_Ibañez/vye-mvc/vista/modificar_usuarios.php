<?php
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
    include '../modelo/funciones.php';
    include '../modelo/conexion.php';
    session_start();
     
    $nombre = operacionesUsuario::obtenerNombre();
    $apellidos = operacionesUsuario::obtenerApellidos();
    $rol = operacionesUsuario::obtenerRol();
    $usuario = operacionesUsuario::obtenerUsuario();
    $id= operacionesUsuario::obtenerIdUsuario();
    $conexion = crearConexion();
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
    <link rel="stylesheet" type="text/css" href="..\otros\css\style_admin_modificar_usuarios.css">
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
                    <!-- Menú de navegación del usuario-->
                    <ul>
                        <li><a href="../index.php"><span>Inicio</span></a></li>
                        <li><a href="../vista/colecciones.php"><span>Colecciones</span></a></li>
                        <li><a href="../vista/contacto.php"><span>Contacto</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Información del usuario -->
            <div class="inicio_sesion">
                <?php 
                    // Mostramos el nombre de usuario
                    echo operacionesUsuario::obtenerUsuario();
                ?>
            </div>  
            <div class="usuario">
                <!-- Icono de usuario y menú desplegable -->
                <img src="..\otros\iconos\usuario.png" alt="Usuario">
                <div class="menu-usuario">
                <?php
                    $nombre = operacionesUsuario::obtenerNombre();
                    $rol = operacionesUsuario::obtenerRol();
                    // Si el usuario es un invitado, mostrar enlaces para iniciar sesión y registrarse
                    if($nombre == 'Usuario Invitado') { ?>
                    <a href="vista/login.php"><span>Identificarse</span></a>
                    <?php } else { ?>
                    <!-- Si el usuario es un usuario registrado, mostrar enlace a la página de perfil -->
                    <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                    <a href="../vista/usuario.php">Perfil Usuario</a>
                    <?php } ?>
                    <!-- Si el usuario es el administrador, mostrar enlace a la página de administrador -->
                    <?php if(operacionesAplicacion::esAdmin($rol)) { ?>
                    <a href="../vista/admin.php"><span>Administrador</span></a>
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
            <div class="div-usuario">
                <!--Formulario Modificar Usuarios-->
                <div class="contenedor-registro">
                    <form method="POST" class="formulario" >
                        <h2>Modificar Usuario</h2>
                        <!-- LLamada oculta con el id del usuario -->
                        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                        <?php
                        // Llamada a la función para mostrar el formulario de edición mostarFormularioEdicion
                        echo operacionesAdmin::mostrarFormularioEdicion($id);
                        ?>                         
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
<!-- Script de JavaScript para el registro -->
<script src="..\otros\js\control_registro.js"></script>

