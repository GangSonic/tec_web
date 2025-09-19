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
         require_once __DIR__ .'/src/funciones.php';
        if(isset($_GET['numero']))
        {
            multiplos($_GET['numero']);
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
     require_once __DIR__ .'/src/funciones.php';
        matriz_rep(); 

?> 



<h2> Ejercicio 3 </h2> 
<?php

    require_once __DIR__ .'/src/funciones.php';
    if(isset($_GET['numero'])){
        num_multiplo($_GET['numero']); 

        echo '<br>'; 
        echo '<p>La función de abajo es la misma función de arriba pero ahora con un do while!!</p>'; 
        num_multiplo_dado_variante($_GET['numero']); 
    }

?> 

<h2> Ejercicio 4 </h2> 
<?php
     require_once __DIR__ .'/src/funciones.php';
     conv_ascii(); 
?> 

<h2> Ejercicio 5 </h2> 

 <form action="http://localhost/tec_web/practicas/p06/src/form.php" method="post">
        <fieldset>
            <legend>Información para acceder: </legend>

            <label for="edad">Edad: </label><input type="number" name="edad" required>
            <label for="sexo">Sexo: </label>
            <select name="sexo" id="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option> 
            </select>
        </fieldset>
        <input type="submit" value="Enviar">
    </form>






</body>
</html>