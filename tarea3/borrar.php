<?php

    /*  borrar.php. Será una página php con el código necesario para borrar el producto seleccionado desde "listado.php" un 
        mensaje de información y un botón volver para volver a "listado.php". 
    */

    require('conexion.php');

    // Se comprueba si viene el id por GET, si este es numérico y si hay conexión, sino se redirecciona a listado.php
    if(!isset($_POST['id']) || !isset($conexion)){
        header('Location: listado.php');
    }

    $id = $_POST['id'];

    $consultaSQL = 'DELETE FROM productos WHERE id = :id';
    
    $borrado = false;
    try {
        $stmt = $conexion->prepare($consultaSQL);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) $borrado = true;
    } catch (PDOException $e) {
        echo 'Error al ejecutar la consulta de borrado.';
        die();
    } finally {
        $stmt = null;
        $conexion = null;
    }

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('css/bootstrap_css.inc.php') ?>
</head>
<body>

    <div class="p-2">
        <?php if ($borrado) : ?>
            <strong>Producto de Código: <?=$id?> Borrado correctamente.</strong>
        <?php else : ?>
            <strong>No existe ningún producto con el ID <?=$id?>.</strong><!-- En caso de que se recargue la página (POST) -->
        <?php endif ?>
        <a href="listado.php"><button type="button" class="btn btn-outline-dark btn-sm">Volver</button></a>
    </div>
    
</body>
</html>