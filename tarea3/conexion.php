<?php

    // Activamos los errores
    // http://php.net/manual/en/function.error-reporting.php
    // Report all PHP errors (see changelog)
    error_reporting(E_ALL);

    // Report all PHP errors
    error_reporting(-1);

    // Same as error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);




    
    $host = "localhost";
    $db = "proyecto";
    $user = "gestor";
    $pass = "secreto";
    $charset = "utf8mb4"; // Soporta emojis 😲 https://codigofacilito.com/articulos/emojis_mysql
    // $dsn = "mysql:host=$host;dbname=$db";
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // https://www.php.net/manual/es/pdo.setattribute.php
    // https://www.php.net/manual/en/pdo.setattribute.php
    $options = [
        
        // Fuerza a los nombres de columnas a una capitalización específica. 
        PDO::ATTR_CASE => PDO::CASE_LOWER,                  // Fuerza a los nombres de columnas a minúsculas. 
        PDO::ATTR_CASE => PDO::CASE_NATURAL,                // Deja los nombres de columnas como son devueltas por el driver de la base de datos.  
        PDO::ATTR_CASE => PDO::CASE_UPPER,                  // Fuerza a los nombres de columnas a mayúsculas. 
        
        // Reporte de errores. 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,           // Establece los códigos de error.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,          // Eleva E_WARNING.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Lanza exceptions.
        
        // (disponible para todos los drivers, no sólo Oracle): Conversión de NULL y cadenas vacías.
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,        // Sin conversión.
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,   // Las cadenas vacías son convertidas a null.
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_TO_STRING,      // NULL se convierte a cadenas vacías.

        
        PDO::ATTR_STRINGIFY_FETCHES, // Convierte los valores numéricos a cadenas cuando se buscan. Requiere bool. 
    ];

    try {
        error_reporting(0);
        $conexion = new PDO($dsn, $user, $pass);
        // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } catch (PDOException $e) {
        // echo '<script language="javascript">alert("Error al conectarse a la base de datos");</script>';
        // print "¡Error!: " . $e->getMessage() . "<br/>";
        // print "¡Error!: " . $e->getMessage() . "<br/>";
        // die();

        // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
        // echo "<br>Versión: $version";

        // $version = $conexion->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
        // echo "<br>Versión: $version";

        // header('Location: listado.php');

        ?>

        <?php
            // die();

    }

    
    
?>