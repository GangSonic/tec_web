<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>

    
    <h2> Ejercicio 2 </h2>
<?php
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
 

?> 






</body>
</html>