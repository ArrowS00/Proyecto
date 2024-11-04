// Función para verificar las dimensiones de una imagen 
function validarTamaño(input) {
    var tamañoMaximo = 20 * 1024; // Tamaño máximo en bytes (20KB en este caso)
    var dimensionMaxima = 512; // Dimensiones máximas en píxeles
    var mensajeError = document.getElementById('mensajeError');//mensaje de error

    // Verificar si se seleccionó un archivo
    if (input.files && input.files[0]) {
        var archivo = input.files[0];
        var extension = archivo.name.substring(archivo.name.lastIndexOf('.')).toLowerCase();//Extension del archivo

        //verifica si la extension del archivo es diferente a .png
        if (extension !== '.png') {
            mensajeError.textContent = "Solo se permiten archivos PNG.";//mensaje de error
            input.value = ""; // Limpia el input
        } else if (archivo.size > tamañoMaximo) {
            mensajeError.textContent = "El archivo seleccionado es demasiado grande. El tamaño máximo permitido es de 50KB.";//mensaje de error
            input.value = ""; // Limpia el input
        } else {
            var img = new Image();//creamos un objeto imagen
            img.src = URL.createObjectURL(archivo);//establecemos la url
            //verificación de las dimensiones
            img.onload = function() {
                if (this.width > dimensionMaxima || this.height > dimensionMaxima) {
                    mensajeError.textContent = "Las dimensiones de la imagen son demasiado grandes. Las dimensiones máximas permitidas son 512x512 píxeles.";//error
                    input.value = ""; // Limpia el input
                } else {
                    mensajeError.textContent = ""; // Limpia el mensaje de error si no hay errores
                }
            }
        }
    }
}