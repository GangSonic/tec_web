<?php

$imagen   = 'img/imagen.png';

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'pantera44', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $marca = $_POST['brand'];
    $modelo = $_POST['model'];
    $precio = $_POST['price'];
    $detalles = $_POST['desc'];
    $unidades = $_POST['unit'];

    $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        echo "<p>Error: El producto ya existe en la base de datos.</p>";
    } else {
        //$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades) VALUES ('$nombre', '$marca', '$modelo', '$precio', '$detalles', '$unidades')";
        if ($link->query($sql) === TRUE) {
            echo 'Producto insertado con ID: '.$link->insert_id;
            echo "<ul>
                    <li>Nombre: $nombre</li>
                    <li>Marca: $marca</li>
                    <li>Modelo: $modelo</li>
                    <li>Precio: $precio</li>
                    <li>Detalles: $detalles</li>
                    <li>Unidades: $unidades</li>
                  </ul>";
        } else {
            echo "<p>Error al insertar el producto: " . $link->error . "</p>";
        }
    }
}
$link->close();
?>
