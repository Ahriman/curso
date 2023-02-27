<?php 

    session_start();

    if(isset($_POST['enviar'])) {
        if(isset($_SESSION['idioma'])) {
            session_unset(); // Elimina las variables de sesión, pero no elimina la sesión (se mantiene el mismo SESSION ID)
            $mensaje = 'Preferencias Borradas.';
        } else {
            $mensaje = 'Debes fijar primero las preferencias.';
        }
    }

    require('datos.inc.php');
    $idioma_usuario = isset($_SESSION['idioma']) ? $idiomas[$_SESSION['idioma']] : 'No establecido';
    $perfil_usuario = isset($_SESSION['perfil']) ? $perfil[$_SESSION['perfil']] : 'No establecido';
    $zona_usuario = isset($_SESSION['zona']) ? $zonas[$_SESSION['zona']] : 'No establecido';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('css/links_cdns.inc.php') ?>
    <style>
        body {
            background: gray;
        }

        #card_prefs {
            background-color: #00b74a;
            width: 35rem
        }
        p, .btn {
            font-size: 1.1em
        }
        span {
            font-weight: bold;
        }
        
    </style>
</head>
<body>
    
    <div class="container mt-4">

        <div class="card text-white mb-3 m-auto" id="card_prefs">
            <div class="card-body">
                <h3 class="card-title"><i class="fas fa-user-cog me-2"></i>Preferencias</h3>
                <?php if(isset($mensaje)) : ?>
                    <p class="card-text text-danger"><span class="mensaje"><?=$mensaje?></span></p>
                <?php endif ?>
                <p class="card-text"><span>Idioma: </span><?=$idioma_usuario?></p>
                <p class="card-text"><span>Perfil Público: </span><?=$perfil_usuario?></p>
                <p class="card-text"><span>Zona Horaria: </span><?=$zona_usuario?></p>

                <form method="POST" name="borrar" class="form-inline">
                    <a href="preferencias.php" class="btn btn-primary me-2">Establecer</a>
                    <input type="submit" name="enviar" value="Borrar" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>

</body>
</html>