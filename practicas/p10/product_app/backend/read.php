<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['searchTerm']) ) {
        $searchTerm = $_POST['searchTerm'];
        $likeTerm = "{$searchTerm}%";
        
         $stmt = $conexion->prepare("
        SELECT * 
        FROM productos 
        WHERE nombre LIKE ? OR marca LIKE ? OR detalles LIKE ?
        ");

        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $stmt) {
            // SE OBTIENEN LOS RESULTADOS
            $stmt->bind_param("sss", $likeTerm, $likeTerm, $likeTerm);
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
          $stmt->close();
           } else {
            die('error en la consulta: '.$conexion->error);
           }

		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>