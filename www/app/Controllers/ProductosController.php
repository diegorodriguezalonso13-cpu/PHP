<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\ProductosModel;

class ProductosController extends BaseController
{
    public function prepStmt3(): void
    {
        $data = array(
            'titulo' => 'Filtrado de productos',
            'breadcrumb' => ['Inicio', 'Consultas simples'],

        );
        $model = new ProductosModel();
        $data['productos'] = $model->getProductos();
        $this->view->showViews(array('templates/header.view.php', 'productos.php', 'templates/footer.view.php'), $data);
    }
}
