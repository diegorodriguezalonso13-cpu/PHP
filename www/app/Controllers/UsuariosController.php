<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    public function prepStmt2()
    {
        $data = array(
            'titulo' => 'Usuarios del sistema',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $model = new UsuariosModel();
        $data['usuarios'] = $model->getAllUsuarios();
        $data['roles'] = $model->getAllRoles();
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'usuariosSistema.php', 'templates/footer.view.php'), $data);
    }
}
