// Agregar un listener para 'mouseover' que es cuando el mouse se mueve sobre el elemento, muestra el span cuando se posiciona encima
document.getElementById('icono-usuario').addEventListener('mouseover', function() {
    document.getElementById('span-icono').style.display = 'inline';
});

// Agregar un listener para  'mouseout' que es cuando el mouse sale del elemento y cuando sale del icono se deja de ver
document.getElementById('icono-usuario').addEventListener('mouseout', function() {
    document.getElementById('span-icono').style.display = 'none';
});