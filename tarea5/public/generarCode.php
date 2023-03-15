<?php

    session_start();
    require('../vendor/autoload.php');

    use Clases\Jugadores;
    use Faker\Factory;

    $faker = Factory::create('es_ES');
    $jugador = new Jugadores();

    // Genera un código y comprueba que no existe
    while (true) {
        $code = $faker->ean13;
        if(!$jugador->existeBarcode($code)) {
            $jugador = null;
            break;
        }
    }

    $_SESSION['codigo'] = $code;
    header('Location: fcrear.php');
