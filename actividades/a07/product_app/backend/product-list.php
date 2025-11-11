<?php
    
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__.'/myapi/Products.php';

    $prodObj = new Products('root', 'pantera44', 'marketzone');
    echo $prodObj->list();  // list() ya devuelve JSON, no necesitas getData()


    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
   /*
    if ( $result = $conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
        // SE OBTIENEN LOS RESULTADOS
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if(!is_null($rows)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            foreach($rows as $num => $row) {
                foreach($row as $key => $value) {
                   // $data[$num][$key] = utf8_encode($value);

                     $data[$num][$key] = $value;
                }
            }
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($conexion));
    }
    $conexion->close();
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
    */ 
?>