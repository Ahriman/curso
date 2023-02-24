<?php

    /* 
        update.php. Nos aparecerá un formulario con los campos rellenos con los valores del producto seleccionado 
        desde "listado.php" incluido el select donde seleccionamos la familia
    */

    if(!isset($_GET['id']) ){
        header('Location: listado.php');
    }

    if (isset($_POST['modificar'])) {

        $id = $_POST['id'];

        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        require('conexion.php');

        $consultaSQL = 'UPDATE productos 
                        SET nombre = :nombre, nombre_corto = :nombre_corto, pvp = :precio, familia = :familia, descripcion = :descripcion 
                        WHERE id = :id';
        
        $modificado = false;
        try {
            $stmt = $conexion->prepare($consultaSQL);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":nombre_corto", $nombre_corto);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":familia", $familia);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $modificado = true;
            }
        } catch (PDOException $e) {
            // TODO: Mejorar mensajes de error
            // echo "\nPDO::errorCode(): ", $stmt->errorCode();
            echo "<br>Error al actualizar el producto: " . $e->getMessage();
            
        } catch (Throwable $e) {
            // echo "<br>Error al actualizar el producto: " . $e->getMessage();
            // echo "\nException: ", $stmt->errorCode();
            var_dump($stmt);
        } finally {
            // $conexion = null;
        }

        

        // if ($resultado) { 
            
        //     $conexion = null;
        // }
    }


    // Inicio obtener producto
    require('conexion.php');

    $id = $_GET['id'];

    $consultaSQL = 'SELECT * FROM productos WHERE id = :id';

    try {
        // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $stmt = $conexion->prepare($consultaSQL);
        $stmt->bindParam(":id", $id);
        $resultado = $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        // TODO: Mejorar mensajes de error
        // echo "\nPDO::errorCode(): ", $stmt->errorCode();
        echo "<br>Error al actualizar el producto: " . $e->getMessage();
        // $insertado = false;
    } catch (Throwable $e) {
        echo 'Que pasa';
        echo "\nException: ", $stmt->errorCode();
    } finally {
        // $conexion = null; // TODO: Si cierro la conexion, no puedo usarla más abajo
    }
    // Fin obtener producto
    
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 3</title>

    <?php require('css/bootstrap_css.inc.php') ?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">

        <div class="row mt-2">

            <!-- TODO: Arreglar tamaño -->
            <h1 class="text-center">Modificar Producto</h1>

            <div id="liveAlertPlaceholder" class="row mt-2"></div>

            <form method="POST" class="row mt-2">

                <input type="hidden" class="form-control" name="id" id="id" value="<?=$producto->id?>">

                <div class="col-6">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nombre" 
                        id="nombre" 
                        value="<?=$producto->nombre?>" 
                        placeholder="<?=$producto->nombre?>" 
                        required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="nombre_corto">Nombre Corto</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nombre_corto" 
                        id="nombre_corto" 
                        value="<?=$producto->nombre_corto?>" 
                        placeholder="<?=$producto->nombre_corto?>" 
                        pattern="[A-Z]+[\d]*" 
                        minlength="3"
                        title="Un código en mayúsculas que no empiece por un número" 
                        required>
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="precio">Precio (€)</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="precio" 
                        id="precio" 
                        value="<?=$producto->pvp?>" 
                        pattern="([0-9]*[.])?[0-9]+" 
                        title="Un número con los decimales separados por un punto" 
                        required>
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="familia">Familia</label>
                    <?php 
                    
                        $consultaFamilias = $conexion->query("SELECT * FROM familias ORDER BY nombre");

                        if ($consultaFamilias) { ?>
                            
                            <select class="form-select" id="familia" name="familia">
                                <?php while ($familia = $consultaFamilias->fetchObject()) : ?>
                                    <option value="<?=$familia->cod?>" <?php if($familia->cod == $producto->familia) echo 'selected'?>><?=$familia->nombre?></option>
                                <?php endwhile ?>
                            </select>
                
                            <?php
                            
                            $conexion = null;
                        }
                    ?>
                </div>

                <div class="col-9 mt-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea 
                        class="form-control" 
                        name="descripcion" 
                        id="descripcion"
                        placeholder="<?=$producto->descripcion?>" 
                        required><?=$producto->descripcion?></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" name="modificar" class="btn btn-primary btn-lg">Modificar</button>
                    <a href="listado.php"><button type="button" class="btn btn-info text-white btn-lg ms-3">Volver</button></a>
                </div>

            </form>

        </div>

    </div>
    
    <?php require('js/bootstrap_js.inc.php') ?>

    <?php 
        if (isset($_POST['modificar'])) {
        
            require('componentes/alerta.php');
            if($modificado) {
                configurarAlerta($modificado, 'Se ha modificado el producto correctamente.', 10000);
            } else {
                configurarAlerta($modificado, 'No se ha podido modificar el producto.', 10000);
            }

        }
    ?>
</body>
</html>