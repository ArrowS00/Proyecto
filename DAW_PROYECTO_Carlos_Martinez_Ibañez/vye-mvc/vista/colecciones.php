<?php  
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
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
    <link rel="stylesheet" type="text/css" href="../otros/css/style_colecciones.css">    
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
                        <li><a href="../index.php"><span>Inicio</span></a></li>
                        <li><a href="contacto.php"><span>Contacto</span></a></li>
                        <!-- Si el usuario es el administrador, mostrar enlace a la página de administrador -->
                        <?php if(operacionesAplicacion::esAdmin($rol)) { ?>
                            <li><a href="../vista/admin.php"><span>Administrador</span></a></li>
                        <?php } ?>
                        <!-- Si está conectado el administrador o un usuario registrado, mostrar enlace para cerrar sesión -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <li><a href="usuario.php"><span>Perfil</span></a></li>
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
            <div class="usuario">
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

        <!-- Contenido principal de la página -->
        <div id="div-1">
            <div class="tabla-usuario"> 
                <h2>Colecciones</h2>
                <!-- Tabla donde se muestran las colecciones -->
                <table class="tabla">
                    <thead>
                        <tr>
                        <th scope="col">País</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Valoración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mostramos las colecciones con la función mostrarColecciones() -->
                        <?php
                        operacionesAplicacion::mostrarColecciones();
                        ?>
                    </tbody>
                </table>
            </div> 
        </div>
        <!-- Imagen de fondo -->
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
    <!-- Script de Javascreipt control del título -->
    <script src="../otros\js\control_titulo.js"></script>

</body> 
</html>

