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
        $data['trabajadores'] = $model->getAllTrabajadores();
        $this->view->showViews(array('templates/header.view.php', 'consultas1.php', 'templates/footer.view.php'), $data);
    }
    public function consultas2(): void
    {
        $data = array(
            'titulo' => 'Todos los trabajadores ordenados',
            'breadcrumb' => ['Inicio', 'Consultas simples'],
        );
        $model = new TrabajadorModel();
        $data['trabajadores'] = $model->getAllTrabajadoresOrdenados();
        $this->view->showViews(array('templates/header.view.php', 'consultas2.php', 'templates/footer.view.php'), $data);
    }
    public function prepStmt1(): void
    {
        $data = array(
            'titulo' => 'Todos los trabajadores ordenados',
            'breadcrumb' => ['Inicio', 'Consultas simples'],
        );
        $username = $_GET['username'] ?? '';
        $id_rol = $_GET['id_rol'] ?? '';
        $model = new TrabajadorModel();
        if ($username === '' && $id_rol === '') {
            $data['trabajadores'] = $model->getAllTrabajadores();
        } elseif ($id_rol === '') {
            $data['trabajadores'] = $model->getTrabajadoresByName($username);
        } elseif ($username === '') {
            $data['trabajadores'] = $model->getTrabajadoresByRol($id_rol);
        }
        $data['username'] = $username;
        $data['id_rol'] = $id_rol;
        $this->view->showViews(array('templates/header.view.php', 'preparedStatement1.php', 'templates/footer.view.php'), $data);
    }
}
