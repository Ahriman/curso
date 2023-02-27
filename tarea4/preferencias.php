<?php 

    session_start();

    require('datos.inc.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea Unidad 4</title>
    <?php require('css/links_cdns.inc.php') ?>
    <style>
        body {
            background: silver;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST['enviar'])) {
            $_SESSION['idioma'] = $_POST['idioma'];
            $_SESSION['perfil'] = $_POST['perfil'];
            $_SESSION['zona'] = $_POST['zona'];
            $_SESSION['mensaje'] = 'Preferencias de usuario guardadas.';
        }
    ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-center h-100">
            <div class="card" style="width: 30rem">
                <div class="card-header">
                    <h3><i class="fa-sharp fa-solid fa-user-gear"></i><i class="fa-thin fa-user-gear"></i>Preferencias Usuario</h3>
                </div>

                <div class="card-body p-4">

                    <?php if(isset($_SESSION['mensaje'])) : ?>
                        <p class="card-text text-primary"><?=$_SESSION['mensaje']?></p>
                        <?php unset($_SESSION['mensaje']); ?>
                    <?php endif ?>

                    <form method="POST" name="preferencias">

                        <!-- Los datos que se almacenan en $_SESSION son enteros -->
                        <label for="idioma">Idioma</label>
                        <div class="input-group mt-2">
                            <span class="input-group-text"><i class="fas fa-language"></i></span>
                            <select class="form-control form-select" name="idioma" id="id">
                                <?php foreach($idiomas as $clave => $valor) : 
                                    if(isset($_SESSION['idioma']) && $_SESSION['idioma'] == $clave): ?>
                                        <option value="<?=$clave?>" selected><?=$valor?></option>
                                    <?php else : ?>
                                        <option value="<?=$clave?>"><?=$valor?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <label for="perfil" class="mt-3">Perfil Público</label>
                        <div class="input-group mt-2">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                            <select class="form-control form-select" name="perfil" id="perfil">
                                <?php foreach($perfil as $clave => $valor) : 
                                    if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == $clave): ?>
                                        <option value="<?=$clave?>" selected><?=$valor?></option>
                                    <?php else : ?>
                                        <option value="<?=$clave?>"><?=$valor?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <label for="zona" class="mt-3">Zona Horaria</label>
                        <div class="input-group mt-2">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                            <select class="form-control form-select" name="zona" id="zona">
                                <?php foreach($zonas as $clave => $valor) : 
                                    if(isset($_SESSION['zona']) && $_SESSION['zona'] == $clave): ?>
                                        <option value="<?=$clave?>" selected><?=$valor?></option>
                                    <?php else : ?>
                                        <option value="<?=$clave?>"><?=$valor?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between form-group mt-3">
                            <a href="mostrar.php" class="btn btn-primary">Mostrar Preferencias</a>
                            <input type="submit" name="enviar" value="Establecer Preferencias" class="btn btn-success">
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

</body>
</html>