<!DOCTYPE html>
<html>
<head>
    <title>Listado de Productos</title>
</head>
<body>
    <h1>Productos</h1>

    <a href="index.php?accion=crear">Agregar Producto</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Eléctrica</th>

            <th>Acciones</th>
        </tr>

        <?php foreach ($productos as $p): ?>
        <tr>
            <td><?= $p->getId() ?></td>
            <td><?= $p->getNombre() ?></td>
            <td><?= $p->getPrecio() ?></td>
            <td><?= ($p->getElectrica() == 0) ? "Muscular" : "Eléctrica"; ?></td>
            <td>
                <a href="index.php?accion=editar&id=<?= $p->getId() ?>">Editar</a>
                |
                <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</body>
</html>
