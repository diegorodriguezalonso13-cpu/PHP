<?php

declare(strict_types=1);
?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>

                    <a href="/preparedStatement1/new" class="btn btn-sm btn-primary ml-auto" data-toggle="tooltip" data-placement="top" title="Añadir trabajador">
                        <i class="fa-solid fa-user-plus"></i>
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">-->
<!--                    TODO descomentar cuando tenga el orden-->
<!--                    <input type="hidden" name="order" value="--><?php //echo $order; ?><!--"/>-->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
<!--                                TODO preguntar a rafa si hay que poner la clave primaria para buscar-->
                                <label for="nombre">Nombre: (NA)</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $input['nombre'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="codigo">Codigo: (NA)</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo $input['codigo'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="coste">Coste: (NA)</label>
                                <input type="text" class="form-control" name="costeMax" id="costeMax" value="<?php echo $input['costeMax'] ?? ''; ?>" placeholder="Máximo"/><br/>
                                <input type="text" class="form-control" name="costeMin" id="costeMin" value="<?php echo $input['costeMin'] ?? ''; ?>" placeholder="Mínimo"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
<!--                                TODO preguntar a rafa si la categoria es padre que muestre los elemetnos de categorias hijas-->
                                <label for="id_categoria">Categoría: (NA)</label>
                                <select name="id_categoria" id="id_categoria" class="form-control" >
                                    <option value=""selected>-</option>
                                    <?php foreach ($roles as $rol) {
                                        if ($input['id_categoria'] == $rol['id_categoria']) { ?>
                                            <option value="<?php echo $rol['id_categoria']; ?>" selected><?php echo $rol['nombre_categoria']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rol['id_categoria']?>"><?php echo $rol['nombre_categoria'];?></option>
                                        <?php }
                                    };?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="proveedor">Proveedor:(NA)</label>
                                <select name="proveedor[]" id="proveedor" class="form-control select2" data-placeholder="A10000xxZ" multiple>
                                    <?php foreach ($countries as $country) {
                                        if (isset($input['proveedor']) && in_array($country['codigo'], $input['proveedor'])) { ?>
                                            <option value="<?php echo $country['codigo']; ?>" selected><?php echo $country['country_name']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $country['codigo']?>"><?php echo $country['proveedor'];?></option>
                                        <?php }
                                    };?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="margen">Margen: (NA entre 1 y 5)</label>
                                <input type="text" class="form-control" name="margenMax" id="margenMax" value="<?php echo $input['margenMax'] ?? ''; ?>" placeholder="Máximo(5)" /><br/>
                                <input type="text" class="form-control" name="margenMin" id="margenMin" value="<?php echo $input['margenMin'] ?? ''; ?>" placeholder="Mínimo(1)" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_producto">ID: (NA)</label>
                                <input type="text" class="form-control" name="id_producto" id="id_producto" value="<?php echo $input['id_producto'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="stock">Stock: (NA)</label>
                                <input type="text" class="form-control" name="stockMax" id="stockMax" value="<?php echo $input['stockMax'] ?? ''; ?>" placeholder="Máximo" /><br/>
                                <input type="text" class="form-control" name="stockMin" id="stockMin" value="<?php echo $input['stockMin'] ?? ''; ?>" placeholder="Mínimo" />
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
    if (!empty($productos)) {
    ?>
    <div class="col-12">
        <table class="table table-striped">
<!--            TODO descomentar cuando haya hecho un nuevo helper para ordenar-->
<!--            --><?php
//            require_once '../app/Helpers/formulario_helper.php';
//            echo printTableHeader(
//                    ['Username', 'Salario Bruto', 'Retención', 'Rol', 'País'],
//                    $order,
//                    $input['sentido'] ?? null,
//                    $queryParams
//            );
//            ?>
            <thead>
            <td>Identificador</td>
            <td>Codigo</td>
            <td>Coste</td>
            <td>Categoria</td>
            <td>Proveedor</td>
            <td>Margen de beneficios</td>
            <td>Stock</td>
            </thead>
            <tbody>
            <?php
            foreach ($productos as $producto => $datos) {
                ?><tr>
                <td><?php echo $datos['id_producto']?></td>
                <td><?php echo $datos['nombre']?></td>
                <td><?php echo $datos['coste']?></td>
                <td><?php echo $datos['nombre_categoria']?></td>
                <td><?php echo $datos['proveedor']?></td>
                <td><?php echo $datos['margen']?></td>
                <td><?php echo $datos['stock']?></td>
                <td>
                    <a href="/preparedStatement1/edit/<?php echo $datos['id_producto'] ?>" class="btn btn-sm btn-primary" title="Editar">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="/preparedStatement1/delete/<?php echo $datos['id_producto'] ?>" class="btn btn-sm btn-danger" title="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
