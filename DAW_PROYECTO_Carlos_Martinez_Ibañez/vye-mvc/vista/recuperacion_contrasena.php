<?php
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
    include '../modelo/funciones.php';
    include '../modelo/conexion.php';
    
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
    <link rel="stylesheet" type="text/css" href="../otros\css\style.css">
    <link rel="stylesheet" type="text/css" href="../otros\css\style_recuperacion_contrasena.css">    
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
                <img src="..\otros\iconos\usuario.png" alt="Usuario">
                <div class="menu-usuario">
                    <a href="../vista/login.php"><span>Identificarse</span></a>
                    <!-- Verificamos si es usuario registrado o administrador -->
                    <?php if(operacionesAplicacion::esUsuario($rol) || operacionesAplicacion::esAdmin($rol)) { ?>
                    <a href="vista/usuario.php">Perfil Usuario</a>
                    <!-- Enlace para cerrar la sesión con el controlador -->
                    <a href="controlador\controlador_cerrar_sesion.php">Desconectar</a>
                    <?php } ?>
                </div>
            </div>  
        </header>
        
        <div id="div-2" class="colecciones">
            <!-- Formulario recuperación de contraseña -->
            <h3>Recuperación de contraseña</h3>
            <div class="contenedor">
                <h4>Ingresa tu email de registro</h4>
                <form method="post" class="form">
                    <div class="form_correo">
                        <input type="email" name="email" placeholder="Ingrese su email" class="correo">
                    </div>
                    <div class="form_boton">
                        <button type="submit" class="enviar">Enviar</button>
                    </div><br>
                </form>
            </div>
            <?php
                //Verificamos si la contraseña es correcta con la función manejarContrasena que esta dentro de la clase operacionesAplicacion
                operacionesAplicacion::manejarContrasena();
            ?>
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
    <!-- Scripts de javascript de control del título -->
    <script src="../otros\js\control_titulo.js"></script>

</body> 
</html>
