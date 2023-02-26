<?php

    require_once('gestor_errores.php');
    
    $host = "localhost";
    $db = "proyecto";
    $user = "gestor";
    $pass = "secreto";
    $charset = "utf8mb4"; // Soporta emojis 😲 https://codigofacilito.com/articulos/emojis_mysql
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $conexion = new PDO($dsn, $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $mensaje = null;
        if ($e->getMessage() == 'could not find driver') {
            $mensaje = 'No se encuentra el driver de conexión.';
        }
        $mensajeAlerta = miGestorDeErrores(E_ERROR, $mensaje, $e->getCode());
    }
    
?>