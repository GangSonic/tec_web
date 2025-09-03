<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>

    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

     <h2>Ejercicio 2</h2>
     <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
     <p>a. Ahora muestra el contenido de cada variable </p> 
     <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo "<ul>";
        echo "<li>a = $a</li>";
        echo "<li>b = $b</li>";
        echo "<li>c = $c</li>";
        echo "</ul>";

    ?>

    <p> b. Agrega al código actual las siguientes asignaciones: </p> 
     <p> $a = “PHP server”; <br> 
$b = &$a;
</P> 
 <p> c. Vuelve a mostrar el contenido de cada uno </p>
  
   <?php
        $a = "PHP Server";
        $b = &$a;
        echo "<ul>";
        echo "<li>a = $a</li>";
        echo "<li>b = $b</li>";
        echo "<li>c = $c</li>";
        echo "</ul>";
    ?>
<p> d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
asignaciones </p> 
<p> Lo que paso es que pasamo los valores de la variable "a" a las variables "b y c" esto mediante la referecnia <b> "&$ " </b></p>


</body>
</html>