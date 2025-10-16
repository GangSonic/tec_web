<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);

        // VALIDAR SI EL PRODUCTO YA EXISTE
        $query = "SELECT * FROM productos WHERE (nombre = ? AND marca = ?) OR (marca = ? AND modelo = ?) AND eliminado = 0";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssss", $jsonOBJ->nombre, $jsonOBJ->marca, $jsonOBJ->marca, $jsonOBJ->modelo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["mensaje" => "El producto ya existe"]);
        } else {
            // PREPARAR LA QUERY DE INSERCIÓN
            $query = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("sdissss", $jsonOBJ->nombre, $jsonOBJ->precio, $jsonOBJ->unidades, $jsonOBJ->modelo, $jsonOBJ->marca, $jsonOBJ->detalles, $jsonOBJ->imagen);

            // EJECUTAR LA QUERY Y VERIFICAR SI FUE EXITOSA
            if($stmt->execute()) {
                echo json_encode(["mensaje" => "Producto insertado exitosamente"]);
            } else {
                echo json_encode(["mensaje" => "Error al insertar el producto"]);
            }
        }

        $stmt->close();
        $conexion->close();
    }
?>