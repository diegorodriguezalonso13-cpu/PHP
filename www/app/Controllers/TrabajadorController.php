<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxCountryModel;
use Com\Daw2\Models\AuxRolTrabajadorModel;
use Com\Daw2\Models\TrabajadorModel;

class TrabajadorController extends BaseController
{
    /*public function testDb()
    {
        $model = new TrabajadorModel();
        $model->getTrabajadores();
    }*/
    //Prueba de que si van los commits
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
        $id_country = $_GET['id_country'] ?? '';
        $model = new TrabajadorModel();
        $modelRol = new AuxRolTrabajadorModel();
        $modelCountry=new AuxCountryModel();
//        if ($username === '' && $id_rol === '') {
//            $data['trabajadores'] = $model->getAllTrabajadores();
//        } elseif ($id_rol === '') {
//            $data['trabajadores'] = $model->getTrabajadoresByName($username);
//        } elseif ($username === '') {
//            $data['trabajadores'] = $model->getTrabajadoresByRol($id_rol);
//        }

        //http_build_query(array): string
        $data['trabajadores'] = $model->getFilterBy($_GET);
        $data['order'] = $model->getOrderIndex($_GET);
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['roles'] = $modelRol->getAllRoles();
        $data['countries'] = $modelCountry->getAllCountries();
        $data['input'] = $input;
        //No modificamos la superglobal, la copiamos en $getOrder
        $getOrder = $_GET;
        unset($getOrder['order']);
        $data['queryParams'] = http_build_query($getOrder);
        $this->view->showViews(array('templates/header.view.php', 'preparedStatement1.php', 'templates/footer.view.php'), $data);
    }
}
