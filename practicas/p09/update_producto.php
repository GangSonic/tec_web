<?php
header("Content-Type: application/xhtml+xml; charset=UTF-8");


@$link = new mysqli('localhost', 'root', 'pantera44', 'marketzone');
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura de datos enviados desde el formulario
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $nombre = $link->real_escape_string($_POST['name']);
    $marca = $link->real_escape_string($_POST['brand']);
    $modelo = $link->real_escape_string($_POST['model']);
    $precio = (float) $_POST['price'];
    $detalles = $link->real_escape_string($_POST['desc']);
    $unidades = (int) $_POST['unit'];

    // Consulta para actualizar los datos
    $query = "UPDATE productos SET 
                nombre = '$nombre', 
                marca = '$marca', 
                modelo = '$modelo', 
                precio = $precio, 
                detalles = '$detalles', 
                unidades = $unidades 
              WHERE id = $id";

    if ($link->query($query) === TRUE) {
        echo "<p style='color: green;'>Producto actualizado exitosamente.</p>";
    } else {
        echo "<p style='color: red;'>Error actualizando el producto: " . $link->error . "</p>";
    }

    $link->close();
} else {
    echo "<p style='color: red;'>Acceso no permitido.</p>";
}
?>