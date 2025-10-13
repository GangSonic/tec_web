document.getElementById("formularioProductos").addEventListener("submit", function(event) {
    event.preventDefault();

    let isValid = true; 

    var nombre = document.getElementById("form-name").value;
    var marca = document.getElementById("form-brand").value;
    var modelo = document.getElementById("form-model").value;
    var precio = document.getElementById("form-price").value;
    var descripcion = document.getElementById("form-desc").value;
    var unidades = document.getElementById("form-unit").value;
    var imagen = document.getElementById("form-image").value;
    
    var error_nombre = document.getElementById("error_nombre");
    var error_marca = document.getElementById("error_marca");
    var error_modelo = document.getElementById("error_modelo");
    var error_precio = document.getElementById("error_precio");
    var error_descripcion = document.getElementById("error_descripcion");
    var error_unidades = document.getElementById("error_unidades");
    var error_imagen = document.getElementById("error_imagen");

     error_nombre.textContent = '';
     error_marca.textContent = '';
     error_modelo.textContent = '';
     error_precio.textContent = '';
     error_descripcion.textContent = '';
     error_unidades.textContent = '';
     error_imagen.textContent = '';

   if(nombre === '' || nombre.length > 100) {
        error_nombre.textContent = 'El nombre es obligatorio y debe tener menos de 100 caracteres.';
        isValid = false;
   }
   if(marca === '')
   {
        error_marca.textContent = 'La marca es obligatoria.';
        isValid = false;
   }
    const modeloRegex = /^[a-zA-Z0-9]+$/;
    if (modelo === '' || !modeloRegex.test(modelo) || modelo.length > 25) {
                error_modelo.textContent = 'El modelo es obligatorio, debe ser texto alfanumérico y tener 25 caracteres o menos.';
                isValid = false;
    }

    if (precio === '' || parseFloat(precio) <= 99.99) {
                error_precio.textContent = 'El precio es obligatorio y debe ser mayor a $99.99.';
                isValid = false;
            }

            if (descripcion.length > 250) {
                error_descripcion.textContent = 'La descripción no debe tener más de 250 caracteres.';
                isValid = false;
            }

            if (unidades === '' || parseInt(unidades) < 0) {
                error_unidades.textContent = 'La cantidad es obligatoria y debe ser mayor o igual a 0.';
                isValid = false;
            }

            if (imagen === '') {
                imagen = 'img/imagen.jpg';
            } else if (!/^(img\/)[a-zA-Z0-9_-]+(\.jpg)$/.test(imagen)) {
                error_imagen.textContent = 'La ruta de la imagen debe ser válida y tener el formato img/nombredelarchivo.jpg.';
                isValid = false;
            }

            if (isValid) {
                document.getElementById('formularioProductos').submit();
            }


});