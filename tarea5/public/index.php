<?php 

    require('../vendor/autoload.php');

    use Clases\Jugadores;

    $jugador = new Jugadores();
    // Si tiene datos, redirige a la página de jugadores, sino a la de instalación para darlos de alta
    if ($jugador->tieneDatos()) {
        $jugador = null;
        header('Location: jugadores.php');
    } else {
        $jugador = null;
        header('Location: instalacion.php');
    }

?>