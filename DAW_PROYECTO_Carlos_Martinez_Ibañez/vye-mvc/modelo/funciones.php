<?php 

class operacionesUsuario {

    // Método estático para obtener el nombre de usuario de la sesión
    public static function obtenerUsuario() {
        return isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario Invitado';
    }

    // Método estático para obtener el nombre de usuario de la sesión
    public static function obtenerNombre() {
        return isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario Invitado';
    }

     // Método estático para obtener los apellidos de usuario de la sesión
    public static function obtenerApellidos() {
        return isset($_SESSION['apellidos']) ? $_SESSION['apellidos'] : 'Usuario Invitado';
    }

    // Método estático para obtener el rol del usuario de la sesión
    public static function obtenerRol() {
        return isset($_SESSION['rol']) ? $_SESSION['rol'] : null;
    }

    // Método estático para obtener el id del usuario de la sesión
    public static function obtenerIdSesion() {
        return $_SESSION['id'];
    }

    // Método estático para verificar si el usuario está iniciado en la sesión
    public static function estaIniciado() {
        if(!isset($_SESSION['nombre'])) {
            return obtenerUsuario();
        }
    }

    // Método estático para obtener el ID de sesión
    public static function obtenerIdDeSesion() {
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;
    }

    // Método estático para obtener el ID de usuario de la sesión
    public static function obtenerIdUsuario() {
        return isset($_GET['id']) ? $_GET['id'] : null;
    }

    // Método estático para mostrar el nombre de usuario
    public static function mostrarNombreUsuario() {
        if(isset($_SESSION['nombre'])) {
            return obtenerUsuario();
        } else {
            return "Usuario Invitado";
        }
    }

    // Método estático para obtener los detalles del usuario de la base de datos
    public static function obtenerUsuarioDeBaseDeDatos($idUsuario) {
        // Conecta a la base de datos
        include 'conexion.php';

        // Prepara una consulta SQL para obtener los detalles del usuario
        $consulta = $conexion->prepare('SELECT * FROM usuarios WHERE id = ?');
        $consulta->bind_param('i', $idUsuario);

        // Ejecuta la consulta y obtiene los resultados
        $consulta->execute();
        $resultado = $consulta->get_result();

        // Devuelve los detalles del usuario
        return $resultado->fetch_assoc();
    }
}

class operacionesAdmin {

    // Método estático para mostrar la lista de usuarios
    public static function mostrarUsuarios() {
        // Consulta SQL para obtener todos los usuarios
        $sql=crearConexion()->query("SELECT * FROM usuarios");
        $html = '';
        while($datos=$sql->fetch_object()){
            // Construir la tabla con los datos
            $html .= '
            <tr>
                <td>'.$datos->id.'</td>
                <td>'.$datos->nombre.'</td>
                <td>'.$datos->apellidos.'</td>
                <td>'.$datos->usuario.'</td>
                <td>'.$datos->email.'</td>
                <td>'.substr($datos->pass, 0, 10).'</td>
                <td>
                    <a href="..\vista\modificar_usuarios.php?id='.$datos->id.'" class="icono-editar"><img src="..\otros\iconos\editar.png" alt="Editar"></a>
                    <a href="..\vista\admin.php?id='.$datos->id.'" class="icono-borrar"><img src="..\otros\iconos\borrar.png" alt="Eliminar"></a>
                </td>
            </tr>';
        }
        return $html;
    }

    // Método estático para mostrar el formulario de edición de usuarios
    public static function mostrarFormularioEdicion($resultado) {
        include '..\controlador\admin_modificar_usuarios.php';
        //Id de la sesión
        $id= operacionesUsuario::obtenerIdUsuario();
        //conexion a la bbdd
        $conexion = crearConexion();
        //consuilta a la bbdd
        $resultado = $conexion->query("SELECT * FROM usuarios where id = " . intval($id));
        $html = '';
        while ($datos=$resultado->fetch_object()) {
            //Formulario de edición
            $html .= '
            <div class="padre">
                <div class="nombre">
                    <span for="nombre">Editar nombre</span>
                    <input type="text" placeholder="Nombre" class="input" name="nombre" value="'.$datos->nombre.'"><br><br>
                </div>
                <div class="apellidos">
                    <span for="apellidos">Editar Apellidos</span>
                    <input type="text" placeholder="Apellidos" class="input"  name="apellidos" value="'.$datos->apellidos.'"><br><br>
                </div>
                <div class="usuario-reg">
                    <span for="usuario">Editar usuario</span>
                    <input type="text" placeholder="Usuario" class="input" name="usuario" value="'.$datos->usuario.'"><br><br>
                </div>
                <div class="email">
                    <span for="email">Editar email</span>
                    <input type="email" placeholder="Email" class="input" name="email" value="'.$datos->email.'"><br><br>
                </div><br>
                <div class="div-boton">
                    <button type="submit" name="boton_modificar" class="boton" value="ok">Modificar</button>
                </div>
            </div>';
        }
        return $html;
    }

    // Método estático para mostrar las colecciones del administrador
    public static function mostrarColeccionesAdministrador() {
        include '../modelo/conexion.php';
        //copnexion a la bbdd
        $conexion = crearConexion();
        //consulta a la bbdd de las colecciones
        $sql = $conexion->query("SELECT * FROM colecciones");
        $html = '';
        while($datos=$sql->fetch_object()){
            //Construcción de la tabla con los datos de las colecciones
            $html .= '
            <tr>
                <td>'.$datos->id_coleccion.'</td>
                <td>'.$datos->id_usuario.'</td>
                <td>'.$datos->pais.'</td>
                <td>'.$datos->ciudad.'</td>
                <td class="cometario">'.implode(' ', array_slice(str_word_count($datos->comentario, 1), 0, 10)) . '...'.'</td>
                <td>'.$datos->rating.'</td>
                <td>
                    <a href="..\vista\colecciones_admin_editar.php?id='.$datos->id_coleccion.'" class="icono-editar"><img src="..\otros\iconos\editar.png" alt="Editar"></a>
                    <a href="..\controlador\admin_borrar_coleccion.php?id='.$datos->id_coleccion.'" class="icono-borrar"><img src="..\otros\iconos\borrar.png" alt="Eliminar"></a>
                </td>
            </tr>';
        }
        cerrarConexion($conexion);//cerrramos la conexión
        return $html;
    }

}

class operacionesAplicacion {

    //Verificar el rol de admin
    public static function esAdmin($rol) {
        return $rol == 1;
    }

    //Verificar el rol de usuario
    public static function esUsuario($rol) {
        return $rol == 2;
    }

    //Método estático para mostrar el mensaje de error de la clase "incorrecto"
    public static function mostrarMensajeError() {
        //controlador pra acceder
        include '../controlador/controlador_login.php';
        //verificar si un mensage de error
        if(isset($_SESSION['error_message'])) {
            echo "<div class='incorrecto'>";
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']);
            echo "</div>";
        }
    }

    //Método estático para la recuperación de contraseña
    public static function manejarContrasena() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            self::recuperarContrasena();
        }
    }

    //Método estático para obtener el id  de la colección
    public static function obtenerIdColeccion() {
        return isset($_SESSION['id_coleccion']) ? $_SESSION['id_coleccion'] : null;
    }

    //Método estático para obetner lo detalles mediante una consulta a la colección
    public static function idColeccion($id_coleccion) {
        $conexion = crearConexion();
        // Usa el id_coleccion para seleccionar solo la colección correspondiente de la base de datos
        $consulta = $conexion->prepare("SELECT * FROM colecciones WHERE id_coleccion = ?");
        // Enlaza la variable $id_coleccion al parámetro de la consulta
        $consulta->bind_param("i", $id_coleccion);
        // Ejecuta la consulta
        $consulta->execute();
        // Obtiene los resultados de la consulta
        $resultado = $consulta->get_result();
        // Devuelve los resultados de la consulta
        return $resultado->fetch_assoc();
    }

    //Método estático para recuperar la contraseña
    public static function recuperarContrasena(){
        //verificaión de si ahi envio de datos
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //verificar si se envio el email
            if(isset($_POST['email'])) {
                //Validación del correo electrónico
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mensaje_error = "El correo electrónico ingresado no es válido.";
                }else{
                    $conexion = crearConexion();
                    //Verificar si existe en la bbdd
                    $usuarioExiste = self::verificarCorreo($email); 
                }
               
                    if ($usuarioExiste){
                        // Si el correo existe, genera un token y envía un correo con el enlace para restablecer la contraseña
                        $token = self::generarToken();
                        $tokenExpira = date("Y-m-d H:i:s", strtotime("+1 day")); // El token expira en 1 día
    
                        $insertaToken = $conexion->prepare("INSERT INTO  recuperacion (email, token, expira) VALUES (?, ?, ?)");
                        $insertaToken->bind_param("sss", $email, $token, $tokenExpira);
                        if ($insertaToken->execute()) {
                            // Envía el correo con el enlace para restablecer la contraseña
                            self::enviarMail($email, $token);
                            $mensaje_exito = "Se ha enviado un correo electrónico a $email con instrucciones para restablecer tu contraseña.";
                            echo $mensaje_exito;
                        } else {
                            $mensaje_error = "Error al generar el token. Por favor, inténtalo de nuevo.";
                            echo $mensaje_error;
                            echo "Error de la base de datos: " . $conexion->error;
                        }
                    } else {
                        $mensaje_error = "El correo electrónico ingresado no está registrado en nuestra base de datos.";
                        echo $mensaje_error;
                    }
                    
            }
        }
    }

    //Método estático para verificar si el correo existe en la base de datos
    public static function verificarCorreo($email) {
        $conexion = crearConexion();
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
        $consulta->bind_param("s", $email);
        $consulta->execute();
        $result = $consulta->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    //Método estático para generar un token
    public static function generarToken() {
        return bin2hex(openssl_random_pseudo_bytes(16)); // Genera un token de 32 caracteres
    }


    //Método estático para enviar un email
    public static function enviarMail($email, $token) {
        $to = $email;
        $asunto = "Recuperación de contraseña";
        $contenido = "Haga clic en el siguiente enlace para restablecer su contraseña: http://localhost/vye-mvc/vista/restablecer_contrasena.php?token=$token";
        $cabecera = "From: viajayexploraweb@viajayexploraweb.com";
    
        $mail = mail($to, $asunto, $contenido, $cabecera);
    
        if (!$mail) {
            throw new Exception('El correo no se pudo enviar, intente nuevamente.');
        }
    }
    
    //Método estático para manejar el token de la contraseña
    public static function manejarToken() {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $conexion = crearConexion();
            self::restablecerContrasena($conexion, $token);
        }
    }

    //Método estático para cambiar la contraseña
    public static function restablecerContrasena($conexion, $token) {
        //Token válido y no ha explirado
        $consulta = $conexion->prepare("SELECT * FROM recuperacion WHERE token = ? AND expira > NOW()");
        $consulta->bind_param("s", $token);
        $consulta->execute();
        $resultado = $consulta->get_result();
        //Comprueba si tiene resultados
        if ($resultado->num_rows > 0) {
            //Recupera los detalles del usuario
            $usuario = $resultado->fetch_assoc();
            $email = $usuario['email'];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['contrasena'])) {
                    // Actualiza la contraseña del usuario
                    $nuevaContrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
                    $consulta = $conexion->prepare("UPDATE usuarios SET pass = ? WHERE email = ?");
                    $consulta->bind_param("ss", $nuevaContrasena, $email);
                    $consulta->execute();
                    echo "Tu contraseña ha sido actualizada.";//Mensaje de que ha sido exitoso
                }
            } else {
                // Muestra el formulario para ingresar una nueva contraseña
                echo '<form method="post" class="form">
                        <div class="form_correo">
                        <input type="password" id="contrasena" name="contrasena" placeholder="Nueva contraseña" class="correo">
                        </div>
                        <span class="ojo">
                            <span class="material-symbols-outlined" id="icono-ojo" onclick="verPass2()">visibility</span>
                        </span><br>
                        <div class="form_boton">
                        <button type="submit" class="enviar">Actualizar contraseña</button>
                        </div>
                      </form>';
            }
        } else {
            echo "El token no es válido o ha expirado.";//Mensaje d error
        }
    }

    //Método estático para mostrar el perfil del usuario
    public static function mostrarPerfilUsuario($id) {
        include '../modelo/conexion.php';
        include '../controlador/controlador_login.php';
        //Consulta a la bbdd para obtener los datos del usuario por su id
        $sql=crearConexion()->query("SELECT * FROM usuarios where id = $id");
        while($datos=$sql->fetch_object()){
            echo '
            <div class="cargar-avatar">
                <h2>Avatar</h2>
                <form action="../controlador/controlador_avatar.php" method="post" enctype="multipart/form-data">
                    <div class="avatar">   
                        <div class="perfil-1">
                            <img src="'.(isset($_SESSION['ruta_avatar']) ? $_SESSION['ruta_avatar'] : '../otros/imagenes/espana.png').'" alt="Avatar">
                        </div>
                        <input type="file" id="avatar" class="boton-avatar-no" name="avatar"><br>
                        <button type="submit" class="boton-avatar-no">Cargar Avatar</button>
                    </div><br>   
                </form>
            </div>
            <div class="caja-2">
                <div class="perfil-2">
                    <h3>ID:</h3>
                    <p>'.$datos->id.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Nombre:</h3>
                    <p>'.$datos->nombre.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Apellidos:</h3>
                    <p>'.$datos->apellidos.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Usuario:</h3>
                    <p>'.$datos->usuario.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Email:</h3>
                    <p>'.$datos->email.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Fecha de nacimiento:</h3>
                    <p>'.$datos->fechaNacimiento.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Sexo:</h3>
                    <p>'.$datos->sexo.'</p>
                </div>
                <div class="perfil-2">
                    <h3>País:</h3>
                    <p>'.$datos->pais.'</p>
                </div>
                <div class="perfil-2">
                    <h3>Última conexión:</h3>
                    <p>'.$datos->ultimaConexion.'</p>
                </div>
                <div class="perfil-boton">
                    <form action="..\vista\usuario_editar.php" method="get">
                    <input type="hidden" name="id" value="'.$id.'">
                    <input name="btnmensage" class="boton_enviar" type="submit" value="Editar"> 
                    </form>   
                </div>
            </div>';
        }
    }

    //Método estático para mostrar el formulario de edición del usuario
    public static function mostrarFormularioEdicion($id) {
        include '..\controlador\usuario_modificar.php';
        $conexion = crearConexion();
        //Consulta a la bbdd para obtener los datos del usuario por su id
        $resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
        while($datos=$resultado->fetch_object()){
            echo '
            <div class="caja-3">
                <div class="perfil-3">
                    <h3>Nombre:</h3>
                    <span for="nombre"></span>
                    <input type="text" placeholder="Nombre" class="input" name="nombre" value="'.$datos->nombre.'"><br><br>
                </div>
                <div class="perfil-3">
                    <h3>Apellidos:</h3>
                    <span for="apellidos"></span>
                    <input type="text" placeholder="Apellidos" class="input"  name="apellidos" value="'.$datos->apellidos.'"><br><br>
                </div>
                <div class="perfil-3">
                    <h3>Usuario:</h3>
                    <span for="usuario"></span>
                    <input type="text" placeholder="Usuario" class="input" name="usuario" value="'.$datos->usuario.'"><br><br>
                </div>
                <div class="perfil-3">
                    <h3>Email:</h3>
                    <span for="email"></span>
                    <input type="email" placeholder="Email" class="input" name="email" value="'.$datos->email.'"readonly><br><br>
                </div>
                <div class="perfil-3">
                    <h3>Nacimiento:</h3>
                    <span for="fecha"></span>
                    <input type="date" placeholder="Fecha" class="input" name="fechaNacimiento" value="'.$datos->fechaNacimiento.'"><br><br>
                </div>
                <div class="perfil-3">
                    <h3>Sexo:</h3>
                    <span for="sexo"></span>
                    <select name="sexo" placeholder="Sexo" class="input">
                        <option value="">Selecciona el sexo</option>
                        <option value="Masculino" '.($datos->sexo == 'Masculino' ? 'selected' : '').'>Masculino</option>
                        <option value="Femenino" '.($datos->sexo == 'Femenino' ? 'selected' : '').'>Femenino</option>
                        <option value="Otros" '.($datos->sexo == 'Otros' ? 'selected' : '').'>Otros</option>
                    </select><br><br>
                </div>
                <div class="perfil-3">
                    <h3>País:</h3>
                    <span for="pais"></span>
                    <input type="text" placeholder="País" class="input" name="pais" value="'.$datos->pais.'"><br><br>
                </div>
                <div class="editar-boton">
                    <button type="submit" name="boton_modificar" class="boton_editar" value="ok">Editar</button>
                </div>
            </div>';
        }
    }

    //Método estático para mostrar las colecciones del usuario
    public static function mostrarColeccionesUsuario($id) {
        include '../modelo/conexion.php';
        //consulta a la bbdd para obtener las colecciones del usuario por id
        $sql=crearConexion()->query("SELECT * FROM colecciones WHERE id_usuario = $id");
        while($datos=$sql->fetch_object()){
            echo '
            <tr>
                <td>'.$datos->pais.'</td>
                <td>'.$datos->ciudad.'</td>
                <td>'.$datos->comentario.'</td>
                <td>'.$datos->rating.'</td>
                <td>
                    <a href="..\controlador\controlador_borrar_coleccion.php?id='.$datos->id_coleccion.'" class="icono-borrar"><img src="..\otros\iconos\borrar.png" alt="Eliminar"></a>
                </td>
            </tr>';
        }
    }

    //Método estático para mostrar las colecciones
    public static function mostrarColecciones() {
        include '../modelo/conexion.php';
        //consulta a la bbdd para obtener todas las colecciones
        $sql = crearConexion()->query("SELECT * FROM colecciones");
    
        while($datos = $sql->fetch_object()) {
            echo "<tr>
                <td>{$datos->pais}</td>
                <td>{$datos->ciudad}</td>
                <td>{$datos->comentario}</td>
                <td>{$datos->rating}</td>
            </tr>";
        }
    }

}



// Controlador_registro.php
class usuarioRegistro {

    //Función para registrar un usuario
    public function registroUsuario($nombre, $apellidos, $usuario, $email, $pass, $rol) {
        $conexion = crearConexion();
        //consulta a la bbdd para insertar un usuario
        $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, usuario, email, pass, rol, fechaNacimiento, sexo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        //enlaza los parametros de la consulta
        $consulta->bind_param('sssssiss', $nombre, $apellidos, $usuario, $email, $pass, $rol, $fechaNacimiento, $sexo);
        //ejecuta la consulta
        $resultado = $consulta->execute();
        cerrarConexion($conexion);
        return $resultado;
    }
}

// Controlador_crear_coleccion.php
class Coleccion {

    // Método para crear una colección
    public function crearColeccion($id_usuario, $nombre, $pais, $ciudad, $comentario, $rating) {
        $conexion = crearConexion();
        //crear una consulta para insertar una colección
        $consulta = $conexion->prepare("INSERT INTO colecciones (id_usuario, nombre, pais, ciudad, comentario, rating) VALUES (?, ?, ?, ?, ?, ?)");
        //enlaza los parametros de la consulta
        $consulta->bind_param('issssi', $id_usuario, $nombre, $pais, $ciudad, $comentario, $rating);
        //ejecuta la consulta
        $resultado = $consulta->execute();
        cerrarConexion($conexion);
        return $resultado;
        return $this->conexion->insert_id;
    }

}


// Controlador admin_borrar_coleccion.php
//controlador_borrar_coleccion.php

//función para borrar una colección
function borrarColeccion($id_coleccion) {
    include 'conexion.php';
    $conexion = crearConexion();
    //consulta a la bbdd para borrar una colección
    $consulta = $conexion->prepare("DELETE FROM colecciones WHERE id_coleccion = ?");
    //enlaza los parametros de la consulta
    $consulta->bind_param("i", $id_coleccion);

    if ($consulta->execute()) {
        return true;
    } else {
        return false;
    }
}


// colecciones_admin_editar.php

//función para modificar un comentario
function formatear_comentario($comentario) {
    //comentario formateado
    $palabras = explode(' ', $comentario);
    //inicialización de la variable, para almacenar el comentario formateado
    $comentario_formateado = '';
    //pasa por cada palabra del comentario
    foreach ($palabras as $i => $palabra) {
        // Si no es la primera palabra y es múltiplo de 20, añade un salto de línea
        if ($i != 0 && $i % 20 == 0) {
            $comentario_formateado .= "\n";
        }
        //añade la palabra al comentario formateado
        $comentario_formateado .= $palabra . ' ';
    }
    //devuelve el comentario formateado
    return trim($comentario_formateado);
}

?>