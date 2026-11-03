<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="">
<!--                INICIO CABECERA CON LOS FILTROS-->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
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
                                <label for="name">Nombre (NA):</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $input['name'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="salarioBruto">Email (NA):</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $input['email'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="id_rol">Idioma (NA):</label>
                                <select name="idioma" id="idioma" class="form-control" data-placeholder="Tipo proveedor">
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
                                <label for="id_rol">Rol (NA):</label>
                                <select name="id_rol" id="id_rol" class="form-control select2" data-placeholder="Administrador,Staff..." multiple>
                                    <?php foreach ($roles as $rol) {
                                        if (isset($input['id_rol']) && in_array($rol['id_rol'], $input['id_country'])) { ?>
                                            <option value="<?php echo $rol['id_rol']; ?>" selected><?php echo $rol['rol']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rol['id_rol']?>"><?php echo $rol['rol'];?></option>
                                        <?php }
                                    };?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="last_date">Último acceso (NA):</label>
                                <input type="text" class="form-control" name="last_date_max" id="last_date_max" value="<?php echo $input['retencionIRPFMax'] ?? ''; ?>" placeholder="Última fecha" /><br/>
                                <input type="text" class="form-control" name="last_date_min" id="last_date_min" value="<?php echo $input['retencionIRPFMin'] ?? ''; ?>" placeholder="Primera fecha" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/usuariosSistema" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
<!--                //FIN CABECERA CON FILTROS-->
            </form>
        </div>
<!--        //INICIO TABLA CON RESULTADOS-->
    </div>
    <?php
    if (!empty($usuarios)) {
    ?>
    <div class="col-12">
        <table class="table table-striped">
<!--            --><?php
//            require_once '../app/Helpers/formulario_helper.php';
//            echo printTableHeader(
//                ['Nombre', 'Email', 'Idioma', 'Rol', 'Último acceso'],
//                $order,
//                $input['sentido'] ?? null,
//                $queryParams
//            );
//            ?>
            <tbody>
            <?php
            foreach ($usuarios as  $datos) {
                ?><tr class="<?php echo $datos['baja'] ? '' : 'bg-danger'; ?>">
                <td><?php echo $datos['nombre']?></td>
                <td><?php echo $datos['email']?></td>
                <td><?php echo $datos['idioma']?></td>
                <td><?php echo $datos['rol']?></td>
                <td><?php echo $datos['last_date']?></td>
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
<!--        //FIN TABLA CON RESULTADOS-->
<!--        //INICIO NAVEGACIÓN POR PAGINAS-->
<!--        TODO: Crear esas variables y debería ir bien-->
<!--        <div class="card-footer">-->
<!--            <nav aria-label="Navegacion por paginas">-->
<!--                --><?php
//
//                require_once '../app/Helpers/formulario_helper.php';
//                echo paginado(
//                    $lastPage,
//                    $page,
//                    $queryParamsPages
//                );
//                ?>
<!---->
<!--            </nav>-->
<!--        </div>-->
<!--        //FIN NAVEGACIÓN POR PAGINAS-->
    </div>

