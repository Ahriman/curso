<?php 

    session_start();
    require('../vendor/autoload.php');

    use Clases\Jugadores;
    use Faker\Factory;

    // Borramos todos los datos de todos los jugadores de la base de datos
    $jugador = (new Jugadores())->borrarTodo(); // TODO: La función no devuelve nada
    $jugador = null;

    $faker = Factory::create('es_ES');

    $cantidad = 12;
    for ($i = 0; $i < $cantidad; $i++) { 
        $jugador = new Jugadores();
        $jugador->setNombre($faker->firstName('male' | 'female'));
        $jugador->setApellidos($faker->lastName . " " . $faker->lastName);
        $jugador->setDorsal($faker->unique()->numberBetween(1, 60));
        $jugador->setPosicion($faker->numberBetween(1, 6));
        $jugador->setBarcode($faker->unique()->ean13);
        $jugador->create();
        $jugador = null;
    }

    $_SESSION['mensaje'] = 'Datos de ejemplo creados correctamente.';

    header('Location: jugadores.php');

