<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\TrabajadorModel;

class TrabajadorController extends BaseController
{
    /*public function testDb()
    {
        $model = new TrabajadorModel();
        $model->getTrabajadores();
    }*/
    public function consultas1(): void
    {
        $data = array(
            'titulo' => 'Ejercicios regulares',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $model = new TrabajadorModel();
        $data['trabajadores'] = $model->getTrabajadores();
        $this->view->showViews(array('templates/header.view.php', 'consultas1.php', 'templates/footer.view.php'), $data);
    }
}
