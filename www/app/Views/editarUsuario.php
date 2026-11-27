<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!--                INICIO CABECERA CON LOS FILTROS-->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">-->
                    <!--                //En value: --><?php //echo $order; ?>
                    <input type="hidden" name="order" value="1"/>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $input['nombre'] ?? ''; ?>" />
                                <p class="text-danger small">
                                    <?php
                                    echo $errors['nombre'] ?? '';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="salarioBruto">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $input['email'] ?? ''; ?>" />
                                <p class="text-danger small">
                                    <?php
                                    echo $errors['email'] ?? '';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="idioma">Idioma:</label>
                                <select name="idioma" id="idioma" class="form-control" data-placeholder="Tipo proveedor">
                                    <option value=""selected>-</option>
                                    <?php foreach ($idiomas as $idioma) :?>
                                        <option value="<?php echo $idioma; ?>"<?php echo (isset($input['idioma']) && $input['idioma'] == $idioma) ? ' selected' : ''; ?>><?php echo $idioma; ?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="text-danger small">
                                    <?php
                                    echo $errors['idioma'] ?? '';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Rol:</label>
                                <select name="id_rol[]" id="id_rol" class="form-control select2" data-placeholder="Administrador,Staff..." multiple>
                                    <?php foreach ($roles as $rol) : ?>
                                            <option value="<?php echo $rol['id_rol']; ?>"<?php echo (isset($input['id_rol']) && $input['id_rol'] == $rol['id_rol']) ? ' selected' : ''; ?>><?php echo $rol['rol']; ?></option>
                                        <?php endforeach;?>
                                </select>
                                <p class="text-danger small">
                                    <?php
                                    echo $errors['id_rol'] ?? '';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="pass">Contraseña:</label>
                                <input type="password" class="form-control" name="pass" id="pass" value="" placeholder="Contraseña"/>
                                <p class="text-danger small">
                                    <?php
                                    echo $errors['pass'] ?? '';
                                    ?>
                                </p>
                                <input type="password" class="form-control" name="pass2" id="pass2" value="" placeholder="Repite contraseña"/>
                                <p class="text-danger small">
                                    <?php
                                    echo $errors['pass2'] ?? '';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="baja">Baja:</label>
                                <div class="custom-control custom-switch" style="zoom: 1.4">
                                    <input type="checkbox" class="custom-control-input" name="baja" id="baja" value="1" data-gtm-form-interact-field-id="0">
                                    <label class="custom-control-label" for="baja"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/usuariosSistema" value="" name="reiniciar" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Aplicar cambios" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
                <!--                //FIN CABECERA CON FILTROS-->
            </form>
        </div>
        <!--        //INICIO TABLA CON RESULTADOS-->
    </div>
</div>
