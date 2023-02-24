<?php 

    /*  
        crear.php. Será un formulario para rellenar todos los campos de productos (a excepción del id). 
        Para la familia nos aparecerá un "select" con los nombres de las familias de los productos para 
        elegir uno (lógicamente aunque mostremos los nombres por formulario enviaremos el código).
    */
    $insertado = false;

    // TODO: Comprobar en el lado servidor que los datos son correctos
    // && isset($_POST['nombre_corto']) && isset($_POST['precio']) && isset($_POST['familia']) && isset($_POST['descripcion'])
    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        require('conexion.php');

        $consultaSQL = 'INSERT INTO productos (nombre, nombre_corto, pvp, familia, descripcion) 
                            VALUES (:nombre, :nombre_corto, :precio, :familia, :descripcion)';
                            
        try {
            $stmt = $conexion->prepare($consultaSQL);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":nombre_corto", $nombre_corto);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":familia", $familia);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $insertado = true;
                // header('Location: crear.php');
            }
            
        } catch (PDOException $e) {
            // TODO: Mejorar mensajes de error
            // echo "\nPDO::errorCode(): ", $stmt->errorCode();
            echo "<br>Error al insertar el producto: " . $e->getMessage();
            
        } catch (Throwable $e) {
            echo "\nException: ", $stmt->errorCode();
        } finally {
            // $conexion = null;
        }
        
    }

    function mostrarSelectFamilias() {
        require('conexion.php');

        // TODO: Utilizar try catch
        // TODO: Comprobar si ya existe el producto por el NOMBRE_CORTO
        // TODO: Hacerlo con consultas preparadas ???

        $resultado = $conexion->query('SELECT * FROM familias ORDER BY nombre');

        if ($resultado) { ?>
            
            <select class="form-select" id="familia" name="familia">
                <?php while ($familia = $resultado->fetchObject()) : ?>
                    <option value="<?=$familia->cod?>"><?=$familia->nombre?></option>
                <?php endwhile ?>
            </select>

            <?php
            
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
    <title>Crear</title>

    <?php require('css/bootstrap_css.inc.php') ?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">

        <div class="row mt-2">

            <!-- TODO: Arreglar tamaño -->
            <h1 class="text-center">Crear Producto</h1>

            <div id="liveAlertPlaceholder" class="row mt-2"></div>

            <form method="POST" class="row mt-2">

                <div class="col-6">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nombre" 
                        id="nombre" 
                        placeholder="Nombre"
                        required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="nombre_corto">Nombre Corto</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nombre_corto" 
                        id="nombre_corto" 
                        placeholder="Nombre Corto"
                        pattern="[A-Z]+[\d]*" 
                        minlength="3"
                        title="Un código en mayúsculas que no empiece por un número" 
                        required>
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="precio">Precio (€)</label>
                    <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio (€)" required>
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="familia">Familia</label>
                    <?php mostrarSelectFamilias() ?>
                </div>

                <div class="col-9 mt-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea 
                        class="form-control" 
                        name="descripcion" 
                        id="descripcion" 
                        required></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" name="crear" class="btn btn-primary btn-lg">Crear</button>
                    <button type="reset" class="btn btn-success btn-lg ms-3">Limpiar</button>
                    <a href="listado.php"><button type="button" class="btn btn-info text-white btn-lg ms-3">Volver</button></a>
                </div>

            </form>

        </div>

    </div>

    <?php require('js/bootstrap_js.inc.php') ?>

    <?php 
        if (isset($_POST['crear'])) {
        
            require('js/alerta.php');
            if($insertado) {
                configurarAlerta($insertado, 'Se ha añadido el producto correctamente.', 5000);
            } else {
                configurarAlerta($insertado, 'No se ha podido añadir el producto.', 10000);
            }

        }
    ?>

</body>
</html>