<?php

    // detalle.php. Mostrará todo los detalles del producto seleccionado. 

    if(!isset($_GET['id']) || !is_numeric($_GET['id']) 
        //  || !isset($_SERVER['HTTP_REFERER']) // Descomentar si queremos que redireccione en caso de introducir un ID a mano en la URL sin un referer
    ){
        header('Location: listado.php');
    }

    require_once('conexion.php');

    $id = $_GET['id'];

    $consultaSQL = 'SELECT * FROM productos WHERE id = :id ORDER BY nombre';

    try {
        $stmt = $conexion->prepare($consultaSQL);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $producto = $stmt->fetch(PDO::FETCH_OBJ);
        }
    } catch (PDOException $e) {
        // TODO: Mejorar mensajes de error y ser específico
    } catch (Throwable $e) {
        echo "\nException: ", $stmt->errorCode();
    } finally {
        if ($conexion != null) {
            $conexion = null;
        }
    }

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    
    <?php require('css/bootstrap_css.inc.php') ?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">

        <h1 class="mt-2 text-center">Detalle Producto</h1>

        <div id="liveAlertPlaceholder" class="row mt-3"></div>
        
        <?php if ($producto != null) : ?>
                
            <div class="card fondo mt-2 mb-3 mx-auto fs-5" style="max-width: 70rem;">
                <div class="card-header text-center"><?=$producto->nombre?></div>
                <div class="card-body">
                    <p class="card-text text-center"><span class="fs-5">Codigo: <?=$producto->id?></p>

                    <p class="card-text">Nombre: <?=$producto->nombre?></p>
                    <p class="card-text">Nombre Corto: <?=$producto->nombre_corto?></p>
                    <p class="card-text">Codigo Familia: <?=$producto->familia?></p>
                    <p class="card-text">PVP (€): <?=$producto->pvp?></p>
                    <p class="card-text">Descripción: <?=$producto->descripcion?></p>
                </div>
            </div>
                
        <?php else : 
            require('js/alerta.php');
            if($producto == null) {
                configurarAlerta($conexionOk, "No existe un producto con el ID $id.", null);
            }
        endif; ?>

        <div class="mt-4 text-center">
            <a href="listado.php"><button type="button" class="btn btn-info text-white btn-lg ms-3">Volver</button></a>
        </div>

    </div>
    
    <?php require('js/bootstrap_js.inc.php') ?>
</body>
</html>