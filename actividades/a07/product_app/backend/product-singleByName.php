<?php
     use TECWEB\MYAPI\Products as Products;
    require_once __DIR__.'/myapi/Products.php';

    if(isset($_POST['name'])) {
        $prodObj = new Products('root', 'pantera44', 'marketzone');
        echo $prodObj->singleByName( $_POST['name'] );
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Nombre no proporcionado'
        ], JSON_PRETTY_PRINT);
    }

?> 