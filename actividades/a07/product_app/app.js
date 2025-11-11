// JSON BASE (Mantenido para valores de reinicio)
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// Array de IDs de los campos requeridos para la validación (Actividad 5)
const REQUIRED_FIELDS = ['#name', '#precio', '#unidades', '#modelo', '#marca'];

// Variable global para rastrear el estado de la validación del nombre (Actividad 7)
let name_exists = false;

// Función para mostrar mensajes en la barra de estado (Actividad 6)
function showStatusMessage(message, className) {
    // Usamos 'text-white' para el color del texto si el tema de Bootstrap es 'superhero'
    $('#container').html(`<li class="${className} text-white" style="list-style: none;">${message}</li>`);
    $('#product-result').show();
}

// Función para reiniciar los campos del formulario con los valores de baseJSON
function resetFormFields() {
    $('#name').val('');
    $('#productId').val('');
    $('#precio').val(baseJSON.precio);
    $('#unidades').val(baseJSON.unidades);
    $('#modelo').val(baseJSON.modelo);
    $('#marca').val(baseJSON.marca);
    $('#detalles').val(baseJSON.detalles);
    $('#imagen').val(baseJSON.imagen);
    $('button.btn-primary').text("Agregar Producto"); 
    $('#product-result').hide(); // Ocultar barra de estado al reiniciar
    name_exists = false; // Resetear estado de existencia del nombre
    $('#product-form input').removeClass('is-invalid is-valid'); // Limpiar clases de validación
}

// Función para validar un campo específico (Actividad 5.1 y 6)
function validateField(fieldId) {
    const value = $(fieldId).val().trim();
    let isValid = true;
    let message = '';

    // Validación de campos requeridos
    if (REQUIRED_FIELDS.includes(fieldId) && value === '') {
        isValid = false;
        message = `El campo ${$(fieldId).attr('placeholder') || fieldId} es requerido.`;
    } 
    // Validación específica de 'precio'
    else if (fieldId === '#precio' && (isNaN(parseFloat(value)) || parseFloat(value) <= 0)) {
        isValid = false;
        message = 'El precio debe ser un número positivo (mayor a 0).';
    } 
    // Validación específica de 'unidades'
    else if (fieldId === '#unidades' && (isNaN(parseInt(value)) || parseInt(value) <= 0)) {
        isValid = false;
        message = 'Las unidades deben ser un número entero positivo (mayor a 0).';
    }

    // Mostrar estado de la validación
    if (!isValid) {
        $(fieldId).addClass('is-invalid').removeClass('is-valid');
        showStatusMessage(`❌ Error en ${$(fieldId).attr('placeholder') || fieldId}: ${message}`, 'bg-danger');
    } else {
        $(fieldId).removeClass('is-invalid').addClass('is-valid');
        // Mostrar mensaje de éxito solo si no es el campo name con error de existencia
        if (fieldId !== '#name' || !name_exists) {
             showStatusMessage(`✅ OK: ${$(fieldId).attr('placeholder') || fieldId} validado.`, 'bg-success');
        }
    }
    
    return isValid;
}

$(document).ready(function(){
    let edit = false;

    // INICIALIZACIÓN: Reemplazamos las líneas de carga de valores por la función de reinicio
    // Las líneas 'let JsonString...' y '...val(JsonString)' ya no son necesarias.
    resetFormFields();

    $('#product-result').hide();
    listarProductos();

    // -------------------------------------------------------------------------
// Búsqueda de productos
// -------------------------------------------------------------------------
$('#search').keyup(function() {
    const search = $(this).val();
    
    if(search.length > 0) {
        $.ajax({
            url: './backend/product-search.php',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                const productos = JSON.parse(response);
                
                if(productos.length > 0) {
                    let template = '';
                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles.substring(0, 50)+'...</li>';
                        
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products').html(template);
                } else {
                    $('#products').html('<tr><td colspan="4" class="text-center">No se encontraron productos</td></tr>');
                }
            }
        });
    } else {
        // Si el campo está vacío, mostrar todos los productos
        listarProductos();
    }
});


    // -------------------------------------------------------------------------
    // Actividad 5.1 y 6: Validar cada campo cuando pierde el foco (blur event)
    // -------------------------------------------------------------------------
    $('#product-form input[type!="hidden"]').blur(function() {
        // Ignoramos la validación en blur para el nombre si estamos editando
        if ($(this).attr('id') === 'name' && edit) {
            $(this).removeClass('is-invalid is-valid');
            $('#product-result').hide();
            return; 
        }
        validateField('#' + $(this).attr('id'));
    });
    
    // ----------------------------------------------------
    // Actividad 7: Validación de nombre al teclear (keyup)
    // ----------------------------------------------------
    $('#name').keyup(function() {
        const name = $('#name').val().trim();
        // Solo verificamos la existencia si no estamos en modo edición y si hay texto
        if (name.length > 0 && edit === false) {
            
            // Si pasa la validación de campo vacío (debería), verificamos asíncronamente
            if (!validateField('#name')) return; 

            $.ajax({
                url: './backend/product-check-name.php', // URL ASUMIDA para esta validación
                type: 'POST',
                data: { nombre: name },
                success: function(response) {
                    const result = JSON.parse(response);
                    // Asume que el backend devuelve { exists: true/false }
                    name_exists = result.exists; 

                    if (name_exists) {
                        $('#name').addClass('is-invalid').removeClass('is-valid');
                        showStatusMessage('🔴 Error: El nombre del producto ya existe.', 'bg-danger');
                    } else {
                        $('#name').removeClass('is-invalid').addClass('is-valid');
                        showStatusMessage('🟢 OK: Nombre disponible.', 'bg-success');
                    }
                },
                error: function() {
                    name_exists = false;
                    showStatusMessage('⚠️ Error al verificar el nombre en el servidor.', 'bg-warning');
                }
            });
        } else if (name.length === 0 && edit === false) {
            // Limpiar si el campo queda vacío
            $('#name').removeClass('is-invalid is-valid');
            name_exists = false;
            $('#product-result').hide();
        }
    });


    // -------------------------------------------------------------------------
    // Envío del Formulario
    // -------------------------------------------------------------------------
    $('#product-form').submit(e => {
        e.preventDefault();

        // -------------------------------------------------------------------------
        // Actividad 5.2: Validar todos los campos requeridos antes de enviar
        // -------------------------------------------------------------------------
        let formValid = true;
        
        // 1. Validar campos individuales
        REQUIRED_FIELDS.forEach(field => {
            // Importante: Si un campo falla, mantenemos formValid como false
            if (!validateField(field)) {
                formValid = false;
            }
        });

        // 2. Validar existencia del nombre (solo si no es edición)
        if (edit === false && name_exists) {
            showStatusMessage('🛑 Error: El nombre del producto ya existe y no se puede agregar.', 'bg-danger');
            formValid = false;
        }

        if (!formValid) {
            showStatusMessage('🛑 Error: Por favor, corrija los errores marcados en el formulario.', 'bg-danger');
            // Aseguramos que la barra de estado se muestre
            $('#product-result').show(); 
            return; // Detener el envío si hay errores
        }
        // -------------------------------------------------------------------------

        // Si la validación pasa, se procede con el envío de datos
        let postData = {
            "precio": parseFloat( $('#precio').val() ), 
            "unidades": parseInt( $('#unidades').val() ), 
            "modelo": $('#modelo').val(),
            "marca": $('#marca').val(),
            "detalles": $('#detalles').val() || baseJSON.detalles,
            "imagen": $('#imagen').val() || baseJSON.imagen
        };
        postData['nombre'] = $('#name').val();
        postData['id'] = $('#productId').val();

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, postData, (response) => {
            let respuesta = JSON.parse(response);
            
            // Creación de la plantilla de la barra de estado
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;

            // SE REINICIA EL FORMULARIO (incluye el cambio de texto del botón)
            resetFormFields();

            // Se listan todos los productos
            listarProductos();
            edit = false;

            // Se muestra la respuesta del servidor
            $('#container').html(template_bar);
            $('#product-result').show();
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            // Cambiado para usar closest('tr') para mejor robustez
            const element = $(e.target).closest('tr');
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        // Cambiado para usar closest('tr') para mejor robustez
        const element = $(e.target).closest('tr');
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            let product = JSON.parse(response);
            
            // Carga de datos para edición
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            
            // Limpiar barra de estado y clases de validación al entrar en modo edición
            $('#product-result').hide();
            $('#product-form input').removeClass('is-invalid is-valid'); 
            
            edit = true;
            name_exists = false; // Permite guardar el nombre existente en modo edición
            $('button.btn-primary').text("Modificar Producto"); // Actividad 2
        });
        e.preventDefault();
    });  

    // -------------------------------------------------------------------------
    // Función listarProductos (código original ajustado para mejor práctica)
    // -------------------------------------------------------------------------
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
                if(Object.keys(productos).length > 0) {
                    let template = '';
                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles.substring(0, 50)+'...</li>';
                        
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products').html(template);
                }
            }
        });
    }

});