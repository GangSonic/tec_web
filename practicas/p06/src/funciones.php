<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        function multiplos($num1)
        {
            $num1 = $_GET['numero']; 
            if($num1%5== 0 && $num1%7==0)
            {
                echo "<h3> R= Numero '.$num1.' multiplo de 5 y 7"; 
            }
            else 
            {
                echo '<h3> R= El numero '.$num1.' no es multiplo de 5 y 7 <h3>'; 
            }
            
        }


        function matriz_rep()
        {
            $matriz= []; 
            $contador=0; 

            do{
            $valor1 = random_int(0,1000);  
            $valor2 = random_int(0,1000); 
            $valor3 = random_int(0,1000); 


            $matriz[] = [$valor1, $valor2, $valor3];
            $contador++; 

                

            $stop= ($valor1%2 != 0) && ($valor2%2 ==0) && ($valor3%2 !=0 );
            }while(!$stop);

                foreach($matriz as $fila)
                {
                echo implode(", ", $fila) . "<br>";
                }
            
                $veces= $contador* 3; 
                echo "<br><strong> $veces número obtenidos en $contador iteraciones</strong>"; 
            
        
        }

        function num_multiplo($num1)
        {
            $num1 = $_GET['numero']; 
            $multiplo = 1; 
            while(($multiplo%$num1) !=0)
            {
                global $multiplo; 
                $multiplo = rand(1,1000); 

            }
            echo 'Numero aleatorio: ' .$multiplo. ' es multiplo de: ' .$num1; 
        
        }


        function num_multiplo_dado_variante($num1)
        {
            $num1 = $_GET['numero']; 
            $multiplo = 0; 
            do{
            global $multiplo; 

            $multiplo = rand (1, 1000); 
            }while(($multiplo%$num1)!=0); 

            echo 'El numero aleatorio: ' . $multiplo . ' es múltiplo del número que colocaste: ' . $num1; 
        }

        function conv_ascii()
        {
             for($i=97; $i<=122; $i++)
            {
                $letra[$i]=chr($i); 

            }

            echo '<table border="1" cellpadding="6" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Clave (ASCII)</th>';
            echo '<th>Valor</th>';
            echo '</tr>';



            foreach($letra as $key => $value)
            {
                
            echo '<tr>';
            echo '<td>' . $key . '</td>';
            echo '<td>' . $value . '</td>';
            echo '</tr>';
            }
            echo '</table>';
        }


        //ex. 6

$parque_vehicular = array(
    "AAA1111" => array(
        "auto" => array(
            "marca" => "Tesla",
            "modelo" => "Model 3",
            "año" => 2023,
            "tipo" => "sedan"
        ),
        "propietario" => array(
            "nombre" => "Diego Torres",
            "ciudad" => "Ciudad de México",
            "direccion" => "Avenida Insurgentes 250"
        )
    ),
    "BBB2222" => array(
        "auto" => array(
            "marca" => "Jeep",
            "modelo" => "Wrangler",
            "año" => 2021,
            "tipo" => "camioneta"
        ),
        "propietario" => array(
            "nombre" => "Fernanda Morales",
            "ciudad" => "Guadalajara",
            "direccion" => "Calle Hidalgo 789"
        )
    ),
    "CCC3333" => array(
        "auto" => array(
            "marca" => "Mercedes-Benz",
            "modelo" => "C200",
            "año" => 2020,
            "tipo" => "sedan"
        ),
        "propietario" => array(
            "nombre" => "Héctor Ramírez",
            "ciudad" => "Monterrey",
            "direccion" => "Boulevard Constitución 120"
        )
    ),
    "DDD4444" => array(
        "auto" => array(
            "marca" => "Toyota",
            "modelo" => "RAV4",
            "año" => 2022,
            "tipo" => "camioneta"
        ),
        "propietario" => array(
            "nombre" => "Laura Sánchez",
            "ciudad" => "Puebla",
            "direccion" => "Calle Zaragoza 555"
        )
    ),
    "EEE5555" => array(
        "auto" => array(
            "marca" => "Volkswagen",
            "modelo" => "Jetta",
            "año" => 2019,
            "tipo" => "sedan"
        ),
        "propietario" => array(
            "nombre" => "Roberto Díaz",
            "ciudad" => "Querétaro",
            "direccion" => "Avenida Universidad 310"
        )
    ),
    "FFF6666" => array(
        "auto" => array(
            "marca" => "Chevrolet",
            "modelo" => "Trailblazer",
            "año" => 2023,
            "tipo" => "camioneta"
        ),
        "propietario" => array(
            "nombre" => "Paola Herrera",
            "ciudad" => "Cancún",
            "direccion" => "Calle Palmar 45"
        )
    ),
    "GGG7777" => array(
        "auto" => array(
            "marca" => "Mazda",
            "modelo" => "CX-30",
            "año" => 2021,
            "tipo" => "camioneta"
        ),
        "propietario" => array(
            "nombre" => "Javier López",
            "ciudad" => "Toluca",
            "direccion" => "Privada Las Flores 87"
        )
    ),
    "HHH8888" => array(
        "auto" => array(
            "marca" => "Honda",
            "modelo" => "Accord",
            "año" => 2022,
            "tipo" => "sedan"
        ),
        "propietario" => array(
            "nombre" => "Silvia Gómez",
            "ciudad" => "León",
            "direccion" => "Calle Jardines 123"
        )
    ),
    "III9999" => array(
        "auto" => array(
            "marca" => "Ford",
            "modelo" => "Explorer",
            "año" => 2023,
            "tipo" => "camioneta"
        ),
        "propietario" => array(
            "nombre" => "Andrés Mendoza",
            "ciudad" => "Mérida",
            "direccion" => "Avenida Colón 876"
        )
    ),
    "JJJ0000" => array(
        "auto" => array(
            "marca" => "Hyundai",
            "modelo" => "Tucson",
            "año" => 2021,
            "tipo" => "camioneta"
        ),
        "propietario" => array(
            "nombre" => "Carmen Rivera",
            "ciudad" => "San Luis Potosí",
            "direccion" => "Calle Primavera 654"
        )
    )
);

function mostrar_auto($matricula) {
    global $parque_vehicular;

    if (isset($parque_vehicular[$matricula])) {
        $vehiculo = $parque_vehicular[$matricula];
        echo "<h2>Información del vehículo $matricula:</h2>";
        echo "<b>Marca: </b>" . $vehiculo["auto"]["marca"] . "<br>";
        echo "<b>Modelo: </b>" . $vehiculo["auto"]["modelo"] . "<br>";
        echo "<b>Año: </b>" . $vehiculo["auto"]["año"] . "<br>";
        echo "<b>Tipo: </b>" . $vehiculo["auto"]["tipo"] . "<br>";
        echo "<b>Propietario: </b>" . $vehiculo["propietario"]["nombre"] . "<br>";
        echo "<b>Ciudad: </b>" . $vehiculo["propietario"]["ciudad"] . "<br>";
        echo "<b>Dirección: </b>" . $vehiculo["propietario"]["direccion"] . "<br>";
    } else {
        echo "<p>No se encontró un vehículo con esa matrícula</p>";
    }
}

function mostrar_todos_los_vehiculos() {
    global $parque_vehicular;
    echo "<h2>Todos los vehículos registrados:</h2>";
    foreach ($parque_vehicular as $matricula => $vehiculo) {
        echo "<b>Matricula: </b> $matricula <br>";
        echo "<b>Marca: </b>" . $vehiculo["auto"]["marca"] . "<br>";
        echo "<b>Modelo: </b>" . $vehiculo["auto"]["modelo"] . "<br>";
        echo "<b>Año: </b>" . $vehiculo["auto"]["año"] . "<br>";
        echo "<b>Tipo: </b>" . $vehiculo["auto"]["tipo"] . "<br>";
        echo "<b>Propietario: </b>" . $vehiculo["propietario"]["nombre"] . "<br>";
        echo "<b>Ciudad: </b>" . $vehiculo["propietario"]["ciudad"] . "<br>";
        echo "<b>Dirección: </b>" . $vehiculo["propietario"]["direccion"] . "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["matricula"])) {
        $matricula = $_POST["matricula"];
        mostrar_auto($matricula);
    } elseif (isset($_POST["todos_los_vehiculos"])) {
        mostrar_todos_los_vehiculos();
    }
}   
    ?>

</body>
</html>