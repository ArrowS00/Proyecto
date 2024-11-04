//Función para simular una máquinade escribbir
function maquinaEscribir(parrafo) {
    // cojemos el texto completo del párrafo
    var textoCompleto = parrafo.textContent;
    parrafo.textContent = ''; // Vaciar el párrafo

     // Crear un intervalo para escribir el texto letra por letra
    var i = 0;
    var interval = setInterval(function() {
        if (i < textoCompleto.length) {
            parrafo.textContent += textoCompleto.charAt(i);
            i++;
        } else {
            clearInterval(interval); // Detener el intervalo cuando se completa todo el texto
        }
    }, 100); // Intervalo de 100 milisegundos entre cada letra
}

// Función para usar la máquina de escribir 
function iniciarMaquinaEscribir() {
    // Seleccionar el párrafo dentro del elemento con id "div-1" y clase "centro"
    var elementoP = document.querySelector('#div-1 .centro p');
    maquinaEscribir(elementoP);
}

// Llamar a la función al cargar la página para iniciar la máquina de escribir
iniciarMaquinaEscribir();




