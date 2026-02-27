<!DOCTYPE html>
<html>
<head>
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Producto</h1>

    <form method="POST">
        Nombre:<br>
        <input type="text" name="nombre" required><br><br>

        Precio:<br>
        <input type="number" step="1" name="precio" required><br><br>

        Eléctrica:<br>
        <select type="number" step="1" name="electrica" required>
            <option value=0>Muscular</option>
            <option value=1>Eléctrica</option>
        </select><br><br>
        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="index.php">Volver</a>
</body>
</html>
