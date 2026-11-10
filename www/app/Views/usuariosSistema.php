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
<!--                INICIO CABECERA CON LOS FILTROS-->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>

                    <a href="/usuariosSistema/new" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Nuevo">
                        <i class="fa-solid fa-user-plus"></i>
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">-->
<!--                //En value: --><?php //echo $order; ?>
                    <input type="hidden" name="order" value="1"/>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $input['name'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="salarioBruto">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $input['email'] ?? ''; ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="idioma">Idioma:</label>
                                <select name="idioma" id="idioma" class="form-control" data-placeholder="Tipo proveedor">
                                    <option value=""selected>-</option>
                                    <?php foreach ($idiomas as $idioma):?>
                                        <option value="<?php echo $idioma['idioma']; ?>"<?php echo (isset($input['idioma']) && $input['idioma'] == $idioma['idioma']) ? ' selected' : ''; ?>><?php echo $idioma['idioma']; ?></option>
                                        <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Rol:</label>
                                <select name="id_rol[]" id="id_rol" class="form-control select2" data-placeholder="Administrador,Staff..." multiple>
                                    <?php foreach ($roles as $rol) {
                                        if (isset($input['id_rol']) && in_array($rol['id_rol'], $input['id_rol'])) { ?>
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
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                <input type="text" class="form-control" name="last_date_min" id="last_date_min" value="<?php echo $input['retencionIRPFMin'] ?? ''; ?>" placeholder="Desde..." />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" name="last_date_max" id="last_date_max" value="<?php echo $input['retencionIRPFMax'] ?? ''; ?>" placeholder="Hasta..." />
                                    </div>
                                </div>
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
            <?php
            require_once '../app/Helpers/formulario_helper.php';
            echo printTableHeader(
                ['Nombre', 'Email', 'Idioma', 'Rol', 'Último acceso','Acciones'],
                $order,
                $input['sentido'] ?? null,
                $queryParams
            );
            ?>
            <tbody>
            <?php
            foreach ($usuarios as  $datos) {
                ?><tr class="<?php echo $datos['baja'] ? 'bg-danger' : ''; ?>">
                <td><?php echo $datos['nombre']?></td>
                <td><?php echo $datos['email']?></td>
                <td><?php echo $datos['idioma']?></td>
                <td><?php echo $datos['rol']?></td>
                <td><?php echo !empty($datos['last_date']) ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $datos['last_date'])->format('d/m/y H:i:s') : '-'?></td>
                <td>
                    <a href="/usuariosSistema/edit/<?php echo $datos['id_usuario'] ?>" class="btn btn-sm btn-primary" title="Editar">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="mailto:<?php echo $datos['email']?>" class="btn btn-sm btn-info" title="Enviar correo">
                        <i class="fa-solid fa-square-envelope"></i>
                    </a>

                    <a href="/usuariosSistema/delete/<?php echo $datos['id_usuario'] ?>" class="btn btn-sm btn-danger" title="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
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
        <div class="card-footer">
            <nav aria-label="Navegacion por paginas">
                <?php

                require_once '../app/Helpers/formulario_helper.php';
                echo paginado(
                    $lastPage,
                    $page,
                    $queryParamsPages
                );
                ?>

            </nav>
        </div>
<!--        //FIN NAVEGACIÓN POR PAGINAS-->
    </div>

