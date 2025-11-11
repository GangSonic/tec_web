<?php
   use TECWEB\MYAPI\Products as Products;
    require_once __DIR__.'/myapi/Products.php';

    if(isset($_POST['id'])) {
        $prodObj = new Products('root', 'pantera44', 'marketzone');
        echo $prodObj->single( $_POST['id'] );
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID no proporcionado'
        ], JSON_PRETTY_PRINT);
    }

    /*
    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    //$data[$key] = utf8_encode($value);
                    $data[$key] = $value;
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
*/ 
    ?>