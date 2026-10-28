<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">-->
                        <input type="hidden" name="order" value="<?php echo $order; ?>"/>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $input['username'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="salarioBruto">Salario Bruto:</label>
                                <input type="text" class="form-control" name="salarioMax" id="salarioMax" value="<?php echo $input['salarioMax'] ?? ''; ?>" placeholder="Máximo"/><br/>
                                <input type="text" class="form-control" name="salarioMin" id="salarioMin" value="<?php echo $input['salarioMin'] ?? ''; ?>" placeholder="Mínimo"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="id_rol">Rol:</label>
                                <select name="id_rol" id="id_rol" class="form-control" data-placeholder="Tipo proveedor">
                                    <option value=""selected>-</option>
                                    <?php foreach ($roles as $rol) {
                                        if ($input['id_rol'] == $rol['id_rol']) { ?>
                                            <option value="<?php echo $rol['id_rol']; ?>" selected><?php echo $rol['nombre_rol']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rol['id_rol']?>"><?php echo $rol['nombre_rol'];?></option>
                                        <?php }
                                    };?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_country">País:</label>
                                <select name="id_country[]" id="id_country" class="form-control select2" data-placeholder="Afghanistan,Albania,..." multiple>
                                    <?php foreach ($countries as $country) {
                                        if (isset($input['id_country']) && in_array($country['id'], $input['id_country'])) { ?>
                                            <option value="<?php echo $country['id']; ?>" selected><?php echo $country['country_name']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $country['id']?>"><?php echo $country['country_name'];?></option>
                                        <?php }
                                    };?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="retencionIRPF">Retención IRPF:</label>
                                <input type="text" class="form-control" name="retencionIRPFMax" id="retencionIRPFMax" value="<?php echo $input['retencionIRPFMax'] ?? ''; ?>" placeholder="Máximo" /><br/>
                                <input type="text" class="form-control" name="retencionIRPFMin" id="retencionIRPFMin" value="<?php echo $input['retencionIRPFMin'] ?? ''; ?>" placeholder="Mínimo" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/preparedStatement1" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (!empty($trabajadores)) {
        ?>
    <div class="col-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><a href="/preparedStatement1?order=1&<?php echo $queryParams ?>">Username</a><?php if ($order === 1) :
                    ?><i class="fas fa-sort-amount-down-alt"></i><?php
                                                         endif; ?></th>
                <th><a href="/preparedStatement1?order=2&<?php echo $queryParams ?>">Salario Bruto</a> <?php if ($order === 2) :
                    ?><i class="fas fa-sort-amount-down-alt"></i><?php
                                                         endif; ?></th>
                <th><a href="/preparedStatement1?order=3&<?php echo $queryParams ?>">Retención IRPF</a> <?php if ($order === 3) :
                    ?><i class="fas fa-sort-amount-down-alt"></i><?php
                                                         endif; ?></th>
                <th>Activo</th>
                <th><a href="/preparedStatement1?order=4&<?php echo $queryParams ?>">Rol</a> <?php if ($order === 4) :
                    ?><i class="fas fa-sort-amount-down-alt"></i><?php
                                                         endif; ?></th>
                <th><a href="/preparedStatement1?order=5&<?php echo $queryParams ?>">País</a> <?php if ($order === 5) :
                    ?><i class="fas fa-sort-amount-down-alt"></i><?php
                                                         endif; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($trabajadores as $trabajador => $datos) {
                ?><tr>
                <td><?php echo $datos['username']?></td>
                <td><?php echo $datos['salarioBruto']?></td>
                <td><?php echo $datos['retencionIRPF']?></td>
                <td><?php echo $datos['activo']?></td>
                <td><?php echo $datos['nombre_rol']?></td>
                <td><?php echo $datos['country_name']?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div>
            <p class="text-danger">
                No se encontraron coincidencias.
            </p>
        </div>
    <?php }; ?>
    </div>

