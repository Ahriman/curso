<?php 

    /*  
        crear.php. Será un formulario para rellenar todos los campos de productos (a excepción del id). 
        Para la familia nos aparecerá un "select" con los nombres de las familias de los productos para 
        elegir uno (lógicamente aunque mostremos los nombres por formulario enviaremos el código).
    */
    
    $insertado = false;
    $mensajeAlerta = false;
    $error = false;
    
    if (isset($_POST['crear']) && isset($_POST['nombre']) && isset($_POST['nombre_corto']) && isset($_POST['precio']) 
        && isset($_POST['familia']) && isset($_POST['descripcion'])) {

        require('comprobacion_datos.inc.php');

        if($nombreOk && $nombre_cortoOk && $precioOk && $familiaOk && $descripcionOk) {

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
                    $mensajeAlerta = 'Se ha añadido el producto correctamente.';
                } else {
                    $mensajeAlerta = 'No se ha podido añadido el producto.';
                }
                
            } catch (PDOException $e) {
                $mensajeAlerta = miGestorDeErrores('ERROR SQL', null, $e->getCode());
                $error = true;
            } finally {
                // Cerrar conexiones
                $stmt = null;
                $conexion = null;
            }

        }
        
    }

    function mostrarSelectFamilias(&$mensajeAlerta, &$error) {

        require('conexion.php');

        try {

            $stmt = $conexion->prepare('SELECT * FROM familias ORDER BY nombre');
            $stmt->execute();

            ?>
            
                <select class="form-select" id="familia" name="familia">
                    <?php while ($familia = $stmt->fetchObject()) : ?>
                        <option value="<?=$familia->cod?>"><?=$familia->nombre?></option>
                    <?php endwhile ?>
                </select>
    
            <?php 

        } catch (PDOException $e) {
            echo '<br>Error al ejecutar la consulta de selección.';
            $mensajeAlerta = miGestorDeErrores('ERROR SQL', null, $e->getCode());
            $error = true;
        } finally {
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
                        pattern="\S?([\w-]+[.]?[\s]?)+"
                        title="El nombre no puede quedar vacío, puede contener letras mayúsculas o minúsculas y números o puntos no consecutivos." 
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
                    <input 
                        type="text" 
                        class="form-control" 
                        name="precio" 
                        id="precio" 
                        pattern="([0-9]*[.])?[0-9]+"
                        title="Un número con los decimales separados por un punto" 
                        placeholder="Precio (€)" 
                        required>
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="familia">Familia</label>
                    <?php mostrarSelectFamilias($mensajeAlerta, $error) ?>
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
        require('js/alerta.php');
        if($error) {
            configurarAlerta(false, $mensajeAlerta, null);
        } elseif (isset($_POST['crear'])) {
            configurarAlerta($insertado, $mensajeAlerta, 10000);
        }
    ?>

</body>
</html>