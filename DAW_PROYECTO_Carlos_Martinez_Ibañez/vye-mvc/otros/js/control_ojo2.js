// Función para alternar la visibilidad de la contraseña
function verPass2() {
    // Obtener los elementos mediante el id 
    var iconOjo = document.getElementById('icono-ojo');
    var casillaPass = document.getElementById('contrasena');
    
    // Verificar si la casilla de contraseña está actualmente oculta y alternar la visibilidad de la contraseña
    if (casillaPass.type === 'password') {
        casillaPass.type = 'text';
        iconOjo.textContent = 'visibility_off';
    } else {
        casillaPass.type = 'password';
        iconOjo.textContent = 'visibility';
    }

}
