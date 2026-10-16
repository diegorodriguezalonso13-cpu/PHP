<?php

declare(strict_types=1);

?>
<div class="row">
    <?php
    if (!empty($trabajadores)) {
        ?>
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>salarioBruto</th>
                    <th>retencionIRPF</th>
                    <th>Activo</th>
                    <th>id_rol</th>
                    <th>id_country</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($trabajadores as $trabajador => $datos) {
                    ?><tr>
                        <td><?php echo $trabajador?></td>
                        <td><?php echo $datos['username']?></td>
                        <td><?php echo $datos['salarioBruto']?></td>
                        <td><?php echo $datos['retencionIRPF']?></td>
                        <td><?php echo $datos['activo']?></td>
                        <td><?php echo $datos['id_rol']?></td>
                        <td><?php echo $datos['id_country']?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
    <?php }; ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ordenación de mayor a menor, prueba github va bien</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="numeros">Json:</label>
                                <textarea class="form-control" rows="5" name="json"><?php echo $json ?? ''; ?></textarea>
                                <p class="text-danger small">
                                    <?php
                                    if (!empty($errores)) {
                                        foreach ($errores['json'] as $error) {
                                            echo $error . '<br/>';
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Hacer cálculos" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

