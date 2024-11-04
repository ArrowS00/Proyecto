<?php
//controlador para enviar un correo
if (isset($_POST["btnmensage"])) {
    //Datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"]; 
    $mensaje = $_POST["mensaje"];
    //Dirección de correo a la que se envia el mensaje
    $to = "viajayexploraweb@gmail.com";
    //Asunto del mensaje 
    $asunto = "Mensaje de $nombre";
    //Contenido del mensaje
    $contenido = "Nombre: $nombre \nEmail: $email \nMensaje: $mensaje";
    //Cabecera del mensaje
    $cabecera = "From: viajayexploraweb@viajayexploraweb.com"; 
    //Enviar el email
    $mail = mail($to, $asunto, $contenido, $cabecera);
    //Verificación del envio del correo
    if ($mail) {
        echo "<script>alert('El correo se envio correctamente :)')</script>";
    } else {
        echo "<script>alert('El correo no se pudo enviar, intente nuevamente :(')</script>";
    }
    //Redirigimos a la página de contacto
    header("Location: ../vista/contacto.php");
    exit;
}
?>
