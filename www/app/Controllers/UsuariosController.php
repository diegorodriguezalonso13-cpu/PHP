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
            'js' => ['assets/js/pages/usuarios-sistema.js']
        );
        $model = new UsuariosModel();
        $data['usuarios'] = $model->getFilterBy($_GET);
        $data['roles'] = $model->getAllRoles();
        $data['idiomas'] = $model->getAllIdiomas();
        $data['order'] = $model->getOrderIndex($_GET);
        $data['page'] = $model->getPage($_GET);
        $data['lastPage'] = $model->getLastPage($_GET);
        //No modificamos la superglobal, la copiamos en $getOrder
        $getOrder = $_GET;
        unset($getOrder['order']);
        unset($getOrder['sentido']);
        $data['queryParams'] = http_build_query($getOrder);
        $getPages = $_GET;
        unset($getPages['page']);
        $data['queryParamsPages'] = http_build_query($getPages);
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'usuariosSistema.php', 'templates/footer.view.php'), $data);
    }
}
