<?php 

    // INFO: Para comprobar en el lado servidor que los datos son correctos, hay que quitar los required del HTML

    // Validación de los campos por si alguien modifica el HTML
    $nombreOk = false;
    $nombre_cortoOk = false;
    $precioOk = false;
    $familiaOk = false;
    $descripcionOk = false;
    
    // \w Caracteres. Equivale a [a-zA-Z0-9_]
    // Se permite también un espacio y un punto no consecutivos
    if(preg_match("/^\S?([\w-]+[.]?[\s]?)+$/", trim($_POST['nombre']))){
        $nombre = trim($_POST['nombre']);
        $nombreOk = true;

        // Letras mayúsculas seguidas de números
        if(preg_match("/^[A-Z]+[\d]*$/", trim($_POST['nombre_corto']))){
            $nombre_corto = trim($_POST['nombre_corto']);
            $nombre_cortoOk = true;

            // Se permiten números enteros, decimales separados por puntos y también ".numero"
            if(preg_match("/^([0-9]*[.])?[0-9]+$/", trim(str_replace(',', '.', $_POST['precio'])))){
                $precio = trim(str_replace(',', '.', $_POST['precio']));
                $precioOk = true;

                // TODO: Validar que las familias sean solo las de la base de datos
                // La BDD ya lo comprueba, si se trata de meter un código de familia que no existe, daría un error, pero se podría mejorar
                if(preg_match("/^\S/", trim($_POST['familia']))){
                    $familia = trim($_POST['familia']);
                    $familiaOk = true;

                    // Se permite cualquier número de caracteres salvo un solo espacio o vacío
                    if(preg_match("/^\S/", trim($_POST['descripcion']))){
                        $descripcion = trim($_POST['descripcion']);
                        $descripcionOk = true;
                    } else {
                        $mensajeAlerta = "Hay error en la descripción.";
                    }

                } else {
                    $mensajeAlerta = "Hay error en la familia.";
                }

            } else {
                $mensajeAlerta = "Hay error en el precio.";
            }

        } else {
            $mensajeAlerta = "Hay error en el nombre corto.";
        }

    } else {
        $mensajeAlerta = "Hay error en el nombre.";
    }

?>