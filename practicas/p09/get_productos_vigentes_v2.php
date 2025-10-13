<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
        img {
            width: auto;
            height: 100px;
        }
    </style>
</head>
<body>
    <h3>PRODUCTOS</h3>
    <p></p>
<?php
// Archivo: get_productos_vigentes_v2.php
// Copia de get_productos_vigentes.php con opción para modificar productos




@$link = new mysqli('localhost', 'root', 'cinepolis', 'marketzone');
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
    echo '<table class="table">
            <thead class="thead-dark">
                <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Detalles</th>
                <th>Imagen</th>
                <th>Modificar</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . $row['marca'] . '</td>
                <td>' . $row['modelo'] . '</td>
                <td>' . $row['precio'] . '</td>
                <td>' . $row['unidades'] . '</td>
                <td>' . $row['detalles'] . '</td>
                <td><img src="' . $row['imagen'] . '" width="100" /></td>

                <td><a href="formulario_productos_v2.php?id=' . $row['id'] . '" class="btn btn-warning">Editar</a></td>
            </tr>';
    }

    echo '</tbody></table>';
    $result->free();
} else {
    echo 'No hay productos vigentes disponibles.';
}
$link->close();
?>