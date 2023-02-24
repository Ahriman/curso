<?php

    function configurarAlerta($resultadoOk, $mensaje, $tiempo) {?>

        <script>

            const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

            // Establecer si tiene un intervalo de tiempo para cerrarse automáticamente o no
            <?php if($tiempo != null) : ?>
                const tiempo = <?=$tiempo?>;
            <?php endif ?>

            // Tipo de alerta
            <?php if ($resultadoOk) : ?>
                $tipo = 'success';
            <?php else : ?>
                $tipo = 'danger';
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

            // Alerta
            alert('<?=$mensaje?>', $tipo);
            if (tiempo != null) {
                setTimeout(function() {
                    // const alerta = document.getElementById('alerta') // No es necesario con id
                    alerta.remove();
                }, tiempo);
            }

        </script>

    <?php }


?>