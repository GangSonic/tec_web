<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
        .error { color: red; font-size: 0.9em; }
    </style>
</head>

<?php
header("Content-Type: application/xhtml+xml; charset=UTF-8");

@$link = new mysqli('localhost', 'root', 'pantera44', 'marketzone');
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$producto = [];
if ($id > 0) {
    $result = $link->query("SELECT * FROM productos WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "<p style='color: red;'>No se encontró ningún producto con el ID proporcionado.</p>";
    }
    $result->free();
}
$link->close();
?>

<body>
<h2>Modificar Producto</h2>
<form id="formularioProductos" action="update_producto.php" method="post">
    <fieldset>
        <legend>Ingresa los campos que se te solicitan.</legend>
        <ul>
            <li>
                <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
            </li>
            <li>
                <label for="form-name">Nombre del producto:</label>
                <input type="text" name="name" id="form-name" value="<?= htmlspecialchars($producto['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required="required" maxlength="100" />
            </li>
            <li>
                <label for="form-brand">Marca del producto:</label>
                <select name="brand" id="form-brand" required="required">
                    <option value="">Seleccione una opción</option>
                    <option value="ELF" <?= isset($producto['marca']) && $producto['marca'] == 'ELF' ? 'selected="selected"' : '' ?>>ELF</option>
                    <option value="Rare_beauty" <?= isset($producto['marca']) && $producto['marca'] == 'Rare_beauty' ? 'selected="selected"' : '' ?>>Rare Beauty</option>
                    <option value="NYX" <?= isset($producto['marca']) && $producto['marca'] == 'NYX' ? 'selected="selected"' : '' ?>>NYX</option>
                    <option value="L'Oreal" <?= isset($producto['marca']) && $producto['marca'] == "L'Oreal" ? 'selected="selected"' : '' ?>>L'Oreal</option>
                    <option value="Maybelline" <?= isset($producto['marca']) && $producto['marca'] == 'Maybelline' ? 'selected="selected"' : '' ?>>Maybelline</option>
                </select>
            </li>
            <li>
                <label for="form-model">Modelo del producto:</label>
                <input type="text" name="model" id="form-model" value="<?= htmlspecialchars($producto['modelo'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required="required" maxlength="25" pattern="^[a-zA-Z0-9]+$" />
            </li>
            <li>
                <label for="form-price">Precio del producto:</label>
                <input type="number" name="price" id="form-price" value="<?= htmlspecialchars($producto['precio'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required="required" min="100" step="0.01" />
            </li>
            <li>
                <label for="form-desc">Descripción del producto:</label>
                <textarea name="desc" rows="4" cols="60" id="form-desc" maxlength="250"><?= htmlspecialchars($producto['detalles'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </li>
            <li>
                <label for="form-unit">Unidades del producto:</label>
                <input type="number" name="unit" id="form-unit" value="<?= htmlspecialchars($producto['unidades'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required="required" min="0" />
            </li>
            <li> 
                <label for="form-image">Imagen del producto:</label>
                <input type="url" name="img" id="form-image" value="<?= htmlspecialchars($producto['imagen'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required="required" />
            </li>
        </ul>
    </fieldset>
    <p>
        <input type="submit" value="Guardar cambios" />
        <input type="reset" value="Reiniciar" />
    </p>
</form>
</body>
</html>