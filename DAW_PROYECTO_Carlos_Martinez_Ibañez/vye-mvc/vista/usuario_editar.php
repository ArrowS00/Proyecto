<?php
    // Inclusión de archivo con las funciones, inicio de seción y obtenemos los datos del usuario
    include '../modelo/funciones.php';    
    require '../modelo/conexion.php';    
    session_start();    
    
    $nombre = operacionesUsuario::obtenerNombre();
    $apellidos = operacionesUsuario::obtenerApellidos();
    $rol = operacionesUsuario::obtenerRol();
    $usuario = operacionesUsuario::obtenerUsuario();
    $id = operacionesUsuario::obtenerIdDeSesion();
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
            <!-- Información del usuario -->
            <div class="inicio_sesion">
                <?php 
                    // Mostramos el nombre de usuario
                    echo operacionesUsuario::obtenerUsuario();;     
                ?>
            </div>  
            <div class="usuario">
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
                            // Mostramos el nombre y apellidos del usuario
                            echo $nombre . " " . $apellidos;
                        ?>
                        <!-- Botón para volver atrás -->
                        <?php if(operacionesAplicacion::esUsuario($rol)) { ?>
                            <a href="usuario.php" class="icono-ajustes" id="icono-usuario">
                                <img src="..\otros\iconos\atras.png" alt="volver">
                                <span id="span-icono">Volver atrás</span>
                            </a>
                        <?php } ?>
                    </h2>
                </span>
            </div> 

            
            
            <!--Formulario Modificar Usuarios-->
            <div class="perfil-usuario">
                <div class="cargar-avatar">
                    <h2>Avatar</h2>
                    <!-- Cambio de avatar del usuario, controlador y formulario -->
                    <form action="../controlador/controlador_avatar.php" method="post" enctype="multipart/form-data">
                        <div class="avatar">   
                            <div class="perfil-1">
                                <img src="<?php echo isset($_SESSION['ruta_avatar']) ? $_SESSION['ruta_avatar'] : '../otros/imagenes/espana.png'; ?>" alt="Avatar">
                            </div>
                            <input type="file" id="avatar" class="boton-avatar-seleccion" name="avatar" onchange="validarTamaño(this)"><br>
                            <p id="mensajeError" style="color: red;"></p>
                            <button type="submit" class="boton-avatar">Cargar Avatar</button>
                        </div>    
                    </form>
                </div>
                <!-- Formulario para edición de usuario -->
                <form method="POST" class="formulario-editar" action="usuario_editar.php">
                    <input type="hidden" name="id" value="<?= operacionesUsuario::obtenerIdDeSesion() ?>">
                    <?php
                        // Mostramos el formulario de edición de usuarios
                        operacionesAplicacion::mostrarFormularioEdicion($id);
                     ?>
                </form>
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

    <!-- Scripts -->
    <script src="..\otros\js\control_usuario.js"></script>
    <script src="..\otros\js\control_validar_tamaño.js"></script>

</body> 
</html>

