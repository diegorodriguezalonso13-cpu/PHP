<?php

declare(strict_types=1);
?>
<div class="row">
    <?php
    if (isset($palabras)):
        ?>
        <div class="col-12 alert alert-success">
            <p>Estas son las veces que aparecen tus palabras: <?php foreach($palabras as $palabra =>$cantidad){ echo $palabra.':'.$cantidad.' ';}?></p>
        </div>
    <?php endif; ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ordenación de mayor a menor</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="numeros">Introduce una cadena de texto:</label>
                                <textarea name="letras" id="letras" cols="12" rows="5" class="form-control" placeholder="El cielo estaba despejado y el sol iluminaba las calles. Las personas caminaban tranquilamente mientras el viento movía suavemente las hojas de los árboles. Era una mañana tranquila y agradable."><?php echo $texto ?? '' ?></textarea>
                                <p class="text-danger small"><?php echo $error ?? ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Ordenar palabras" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>