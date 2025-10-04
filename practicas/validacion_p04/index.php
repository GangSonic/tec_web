<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2> Ejercicio 1 </h2>

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
     <pre>
         $a = “PHP server”; 
        $b = &amp; $a;
    </pre> 
    
 <p> c. Vuelve a mostrar el contenido de cada uno </p>
  
   <?php
        $a = "PHP Server";
        $b = &$a;
        $c = ""; 
        echo "<ul>";
        echo "<li>a = $a</li>";
        echo "<li>b = $b</li>";
        echo "<li>c = $c</li>";
        echo "</ul>";

        unset($a);
        unset($b);
        unset($c);
            
    ?>

<p> d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
asignaciones </p> 
<p> Lo que paso es que pasamo los valores de la variable "a" a las variables "b y c" esto mediante la referecnia <b> "&amp;$ " </b></p>

<h2> Ejercicio 3 </h2>
<p> Muestra el contenido de cada variable inmediatamente después de cada asignación,
verificar la evolución del tipo de estas variables (imprime todos los componentes de los
arreglo): </p> 
 <?php
    $a = "PHP5";
    echo "<p>a = $a</p>";
    $z[] = &$a;
    echo "<p>z[0] = {$z[0]}</p>";
    $b = "5a version de PHP"; 
    echo "<p>b = $b</p>";
    $c = (int)$b*10;
    echo "<p>c = $c</p>";
    $a .= $b;
    echo "<p>a = $a</p>";
    $b= (int)$b * $c;
    echo "<p>b = $b</p>";
    $z[0] = "MySQL";
    echo "<p>z[0] = {$z[0]}</p>";


?> 

<h2>Ejercicio 4 </h2> 
<p> Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
la matriz <b> $GLOBALS </b>  o del modificador global de PHP. </p> 
<?php
    echo "<h4>Valores de las variables:</h4>";
    echo "<p>a = {$GLOBALS['a']}</p>";
    echo "<p>b = {$GLOBALS['b']}</p>";
    echo "<p>c = {$GLOBALS['c']}</p>";
    echo "<p>z[0] = {$GLOBALS['z'][0]}</p>";
?>

<h2> Ejercicio 5 </h2>
<p> Dar el valor de las variables $a, $b, $c al final del siguiente script: </p> 
 <?php
    $a = "7 personas";
    $b = (integer) $a;
    $a = "9E3";
    $c = (double) $a;

    echo "<p>a = $a</p>";
    echo "<p>b = $b</p>";
    echo "<p>c = $c</p>";

    unset($a);
    unset($b);
    unset($c);
?> 

<h2> Ejercicio 6</h2> 
 <p> Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
usando la función var_dump(datos). </p> 

<?php
    $a = "0";
    $b = "TRUE";
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);

var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);
var_dump($e);
var_dump($f);

?>

<h2> Ejercicio 7 </h2>
<p> Usando la variable predefinida $_SERVER, determina lo siguiente: </p> 
<ul>
    <li>La versión de Apache y PHP: <?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
    <li>El nombre del sistema operativo (servidor): <?php echo php_uname('s'); ?></li>
    <li>El idioma del navegador (cliente): <?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></li>
</ul>


  <p>
    <a href="https://validator.w3.org/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
  

</body>
</html>