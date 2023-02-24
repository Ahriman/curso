<?php

    require_once('gestor_errores.php');

    // set_error_handler("miGestorDeErrores");


    
    // TODO: Asignar permisos al archivo ?
    $host = "localhost";
    $db = "proyecto";
    $user = "gestor";
    $pass = "secreto";
    $charset = "utf8mb4"; // Soporta emojis 😲 https://codigofacilito.com/articulos/emojis_mysql
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $conexion = new PDO($dsn, $user, $pass);
        // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // TODO: ARREGLAR
    } catch (PDOException $e) {
        if ($e->getMessage() == 'could not find driver') {
            $mensajeAlerta = miGestorDeErrores(E_ERROR, 'No se encuentra el driver de conexión.', $e->getCode());
        } else {
            $mensaje = 'Error al conectarse a la base de datos.';
            $mensajeAlerta = miGestorDeErrores(E_ERROR, null, $e->getCode());
            // restore_error_handler();
        }
        
    }

    // restore_error_handler();
    
?>