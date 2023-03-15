<?php 

    session_start();
    require('../vendor/autoload.php');

    use Philo\Blade\Blade;

    $views = ['../views'];
    $cache = '../cache';
    $blade = new Blade($views, $cache); // TODO: Corregir problema array

    $titulo = 'Nuevo';
    $encabezado = 'Crear jugador';

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo $blade
            ->view()
            ->make('vcrear', compact('titulo', 'encabezado', 'error'))
            ->render();
            unset($_SESSION['error']); // Eliminar el error para evitar un bucle infinito
    } else if (isset($_SESSION['codigo'])) {
        $codigo = $_SESSION['codigo'];
        echo $blade
            ->view()
            ->make('vcrear', compact('titulo', 'encabezado', 'codigo'))
            ->render();
            unset($_SESSION['codigo']);
    } else {
        echo $blade
            ->view()
            ->make('vcrear', compact('titulo', 'encabezado'))
            ->render();
    }
