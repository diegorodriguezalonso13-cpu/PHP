<?php

declare(strict_types=1);

?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Campos</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">-->
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
                                <input type="text" class="form-control" name="salario" id="salario" value="<?php echo $input['salario'] ?? ''; ?>" placeholder="1000,2000..."/>
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
                                <select name="id_country" id="id_country" class="form-control select2" data-placeholder="Afghanistan,Albania,..." multiple>
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
                                <input type="text" class="form-control" name="retencionIRPFMax" id="retencionIRPFMax" value="<?php echo $input['retencionIRPFMax'] ?? ''; ?>" placeholder="Entre 0 y 100, ambos inclusive" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="activo">Activo:</label>
                                <div class="custom-control custom-switch" style="zoom: 1.4">
                                    <input type="checkbox" class="custom-control-input" name="activo" id="activo" data-gtm-form-interact-field-id="0" checked>
                                    <label class="custom-control-label" for="activo"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/preparedStatement1/new" value="" name="reiniciar" class="btn btn-danger">Borrar</a>
                        <input type="submit" value="Añadir" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

