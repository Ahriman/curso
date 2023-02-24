<?php
    
    // TODO: Asignar permisos al archivo ?
    $host = "localhost";
    $db = "proyecto";
    $user = "gestor";
    $pass = "secreto";
    $charset = "utf8mb4"; // Soporta emojis 😲 https://codigofacilito.com/articulos/emojis_mysql
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $conexion = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        print 'No se ha podido conectar a la base de datos.';
        die();
    }
    
?>