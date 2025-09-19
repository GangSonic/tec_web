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
            if($num1%5== 0)
            {
                echo "Numero multiplo de 5"; 
            }
            if($num1%7== 0)
            {
                echo "Numero multiplo de 7"; 
            }
            else 
            {
                echo "No es multiplo de 5 o 7"; 
            }
        }
    ?>

</body>
</html>