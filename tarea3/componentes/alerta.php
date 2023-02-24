<?php

    function configurarAlerta($conexionOk, $mensaje, $tiempo) {?>

        <script>

            const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

            <?php if($tiempo != null) : ?>
                const tiempo = <?=$tiempo?>;
            <?php endif ?>

            const alert = (message, type) => {
                const wrapper = document.createElement('div');
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible" id="alerta" role="alert">`,
                    `   <div>${message}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('');

                alertPlaceholder.append(wrapper);
            }

            <?php if ($conexionOk) : ?>
                $tipo = 'success';
                // $tiempo = 2000
            <?php else : ?>
                $tipo = 'danger';
                // $tiempo = 10000
            <?php endif ?>
            alert('<?=$mensaje?>', $tipo);
            if (tiempo != null) {
                setTimeout(function() {
                    const alerta = document.getElementById('alerta') // No es necesario con id
                    alerta.remove();
                }, tiempo);
            }

        </script>

    <?php }


?>