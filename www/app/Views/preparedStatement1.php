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
            <?php
            require_once '../app/Helpers/formulario_helper.php';
            echo printTableHeader(
                ['Username', 'Salario Bruto', 'Retención', 'Rol', 'País'],
                $order,
                $input['sentido'] ?? null,
                $queryParams
            );
            ?>
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
        <div class="card-footer">
            <p>Paginas:<?php echo $paginates ?></p>
            <nav aria-label="Navegacion por paginas">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="/preparedStatement?page=1&<?php echo $queryParams?>" aria-label="First">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">First</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="/preparedStatement?page=2" aria-label="Previous">
                            <span aria-hidden="true">&lt;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <li class="page-item active"><a class="page-link" href="#"><?php echo $page ?></a></li>
                    <li class="page-item">
                        <a class="page-link" href="/preparedStatement?page=4" aria-label="Next">
                            <span aria-hidden="true">&gt;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="/preparedStatement?page=<?php echo $lastPage ?>&<?php echo $queryParams?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Last</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

