<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<?php

    $data = array();

	if(isset($_GET['tope']))
		$tope = $_GET['tope'];
    
	if (!empty($tope))
	{
		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli('localhost', 'root', 'pantera44', 'marketzone');
        /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			//exit();
		}

		/** Crear una tabla que no devuelve un conjunto de resultados */
		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= '{$tope}'") ) 
		{
            /** Se extraen las tuplas obtenidas de la consulta */
			$row = $result->fetch_all(MYSQLI_ASSOC);

			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

          /** Se crea un arreglo con la estructura deseada */
            foreach($row as $num => $registro) {            // Se recorren tuplas
                foreach($registro as $key => $value) {      // Se recorren campos
                    $data[$num][$key] = $value;
                }
            }

		$link->close();

	}
	?>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<h3>PRODUCTO</h3>

		<br/>

       

		
		<?php if( isset($row) ) : ?>

			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
					</tr>
				</thead>
				<tbody>
					<tr>
                        <?php foreach($data as $producto): ?>
						<th scope="row"> <?php echo $producto['id']; ?></th>
						<td><?php echo $producto['nombre']; ?></td>
						<td><?php echo $producto['marca']; ?></td>
						<td><?php echo $producto['modelo']; ?></td>
						<td><?php echo $producto['precio']; ?></td>
						<td><?php echo $producto['unidades'] ?></td>
						<td><?php echo $producto['detalles']; ?></td>
						<td><img src="<?php echo $producto['imagen'] ?>" ></td>
					</tr>
                    <?php endforeach; ?>
				</tbody>
			</table>

		<?php else : ?>

			 <script>
                alert('El tope del producto no existe');
             </script>

		<?php endif; ?>
	</body>

</html> 