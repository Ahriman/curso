<?php 

    session_start();
    require('../vendor/autoload.php');

    use Clases\Jugadores;

    function error($text) {
        $_SESSION['mensaje'] = $text;
        header('Location: fcrear.php');
        die();
    }

    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $posicion = $_POST['posicion'];
    $dorsal = (int) $_POST['dorsal'];
    $barcode = $_POST['barcode'];

    if(strlen($nombre) == 0 || strlen($apellidos) == 0){
        error('¡Nombre y apellidos deben contener algún caracter válido!');
    }

    $jugador = new Jugadores(); // TODO: La función no devuelve nada
    if($jugador->existeDorsal($dorsal)){
        $jugador = null; // Cierra la conexión a la base de datos
        error('Ese dorsal ya está en uso');
    }
    

    // Si llegamos aquí, todo ha ido bien para hacer ahora el insert
    $jugador->setNombre(ucwords($nombre));
    $jugador->setApellidos(ucwords($apellidos));
    $jugador->setPosicion($posicion);

    if($dorsal != 0) {
        $jugador->setDorsal($dorsal);
    }

    $jugador->setBarcode($barcode);
    $jugador->create();
    $jugador = null; // Cierra la conexión a la base de datos

    $_SESSION['mensaje'] = 'Jugador creado con éxito.';

    header('Location: jugadores.php');

