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
        $modelCountry = new AuxCountryModel();

        //http_build_query(array): string
        $data['trabajadores'] = $model->getFilterBy($_GET);
        $data['page'] = $model->getPage($_GET);
        $data['lastPage'] = $model->getLastPage($_GET);
        $data['order'] = $model->getOrderIndex($_GET);
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['roles'] = $modelRol->getAllRoles();
        $data['countries'] = $modelCountry->getAllCountries();
        $data['input'] = $input;
        //No modificamos la superglobal, la copiamos en $getOrder
        $getOrder = $_GET;
        unset($getOrder['order']);
        unset($getOrder['sentido']);
        $data['queryParams'] = http_build_query($getOrder);
        $getPages = $_GET;
        unset($getPages['page']);
        $data['queryParamsPages'] = http_build_query($getPages);
        $this->view->showViews(array('templates/header.view.php', 'preparedStatement1.php', 'templates/footer.view.php'), $data);
    }
    public function nuevoTrabajdor(array $input = [], array $errores = []): void
    {
        $data = array(
            'titulo' => 'Datos nuevo trabajador',
            'breadcrumb' => ['Inicio', 'Consultas simples'],
            'input' => $input,
            'errors' => $errores,
        );
        $modelRol = new AuxRolTrabajadorModel();
        $modelCountry = new AuxCountryModel();
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['roles'] = $modelRol->getAllRoles();
        $data['countries'] = $modelCountry->getAllCountries();
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'nuevoTrabajador.php', 'templates/footer.view.php'), $data);
    }
    public function doNuevoTrabajador(): void
    {
        $errores = $this->checkNuevoTrabajador($_POST);

    }
    private function checkNuevoTrabajador(array $datos): array
    {
        $errores = [];

        if (empty($datos['username'])) {
            $errores['username'] = 'Campo obligatorio';
        } elseif (!preg_match('/^[\p{L}0-9_]{4,50}$/', $datos['username'])) {
            $errores['username'] = 'Username solo acepta caracteres alfanuméricos y _. Longitud mínima: 4, máxima: 50';
        } else {
            $trabajadorModel = new TrabajadorModel();
            $trabajador = $trabajadorModel->find($datos['username']);
            if ($trabajador !== false) {
                $errores['username'] = 'El nombre de usuario ya está en uso';
            }
        }

        if (empty($datos['salarioBruto'])) {
            $errores['salarioBruto'] = 'Campo obligatorio';
        } elseif (!is_numeric($datos['salarioBruto'])) {
            $errores['salarioBruto'] = 'Inserte un número';
        } elseif ($datos['salarioBruto'] < 500) {
            $errores['salarioBruto'] = 'El debe ser mayor que 500';
        }

        if (empty($datos['retencionIRPF'])) {
            $errores['retencionIRPF'] = 'Campo obligatorio';
        } elseif (!is_numeric($datos['retencionIRPF'])) {
            $errores['retencionIRPF'] = 'Inserte un número';
        } elseif ($datos['retencionIRPF'] < 0 || $datos['retencionIRPF'] > 100) {
            $errores['retencionIRPF'] = 'La retención debe tener un valor comprendido entre 0 y 100';
        }

        if (empty($datos['id_rol'])) {
            $errores['id_rol'] = 'Campo obligatorio';
        } elseif (filter_var($datos['id_rol'], FILTER_VALIDATE_INT) === false) {
            $errores['id_rol'] = 'Rol no válido';
        } else {
            $rolModel = new AuxRolTrabajadorModel();
            $rol = $rolModel->find((int)$datos['id_rol']);
            if ($rol === false) {
                $errores['id_rol'] = 'Rol no válido';
            }
        }

        if (empty($datos['id_country'])) {
            $errores['id_country'] = 'Campo obligatorio';
        } elseif (filter_var($datos['id_country'], FILTER_VALIDATE_INT) === false) {
            $errores['id_country'] = 'País no válido';
        } else {
            $countryModel = new AuxCountryModel();
            $country = $countryModel->find((int)$datos['id_country']);
            if ($country === false) {
                $errores['id_country'] = 'País no válido';
            }
        }

        return $errores;
    }
    public function editTrabajador(string $username): void
    {
        $data = array(
            'titulo' => 'Trabajador',
            'breadcrumb' => ['Inicio', 'Consultas simples'],
        );
        $model = new TrabajadorModel();
        $modelRol = new AuxRolTrabajadorModel();
        $modelCountry = new AuxCountryModel();
        $data['roles'] = $modelRol->getAllRoles();
        $data['countries'] = $modelCountry->getAllCountries();
        $input = $model->obtenerUnTrabajador($username);
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'editarTrabajador.php', 'templates/footer.view.php'), $data);
    }
}
