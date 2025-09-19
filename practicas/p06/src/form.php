<?php
header("Content-type: application/xhtml+xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Formulario </title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];

    if ($sexo == 'femenino' && $edad >= 18 && $edad <= 35) {
        echo '<p>Bienvenida, cumples con los requisitos para ingresar</p>';
    } else {
        echo '<p>No cumples con los requisitos, no puedes ingresar</p>';
    }
}
?>
</body>
</html>