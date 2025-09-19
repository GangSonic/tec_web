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



    
    ?>

</body>
</html>