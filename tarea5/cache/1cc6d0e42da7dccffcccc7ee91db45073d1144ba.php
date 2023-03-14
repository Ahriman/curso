<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
    <?php if(isset($mensaje)): ?>
        <div class="alert alert-success h-100 mt-3">
            <p><?php echo e($mensaje); ?></p>
        </div>
    <?php endif; ?>

    <a href="fcrear.php" class="btn btn-success mt-2 mb-2">
        <i class="fas fa-plus"></i> Nuevo jugador
    </a>

    <table class="table table-striped table-dark">
        <thead>
            <tr class="text-center" style="font-weight: bold; font-size:1.1rem">
                <th scope="col">Nombre completo</th>
                <th scope="col">Posición</th>
                <th scope="col">Dorsal</th>
                <th scope="col">Código de barras</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <th scope="row"><?php echo e($jugador->apellidos . ", " . $jugador->nombre); ?></th>
                <td><?php echo e($jugador->posicion); ?></td>
                <?php if(isset($jugador->dorsal)): ?>
                    <td><?php echo e($jugador->dorsal); ?></td>
                <?php else: ?>
                    <td>Sin asignar</td>
                <?php endif; ?>
                <td class="d-flex justify-content-center">
                    <?php echo $d->getBarcodeHTML($jugador->barcode, 'EAN13', 2, 33, 'white') ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>