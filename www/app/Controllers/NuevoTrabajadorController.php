<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class NuevoTrabajadorController extends BaseController
{
    public function nuevoTrabajdor(): void
    {
        $data = array(
            'titulo' => 'Todos los trabajadores ordenados',
            'breadcrumb' => ['Inicio', 'Consultas simples'],
        );
        $this->view->showViews(array('templates/header.view.php', 'preparedStatement1.php', 'templates/footer.view.php'), $data);
    }
}
