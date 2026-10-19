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
    public function consultas2(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $model = new TrabajadorModel();
        $trabajadores = $model -> getTrabajadores();
        $salarioBruto = array_column($trabajadores, 'salarioBruto');
        array_multisort($salarioBruto, SORT_DESC, $trabajadores);
        $data['trabajadores'] = $trabajadores;
        $this->view->showViews(array('templates/header.view.php', 'consultas2.php', 'templates/footer.view.php'), $data);
    }
    public function consultas3(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $model = new TrabajadorModel();
        $trabajadores = $model -> getTrabajadores();
        foreach($trabajadores as $trabajador => $dato) {
            if($dato['id_rol']!=5){
                unset($trabajadores[$trabajador]);
            }
        }
        $data['trabajadores'] = $trabajadores;
        $this->view->showViews(array('templates/header.view.php', 'consultas3.php', 'templates/footer.view.php'), $data);
    }
    public function consultas4(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $model = new TrabajadorModel();
        $trabajadores = $model -> getTrabajadores();
        foreach($trabajadores as $trabajador => $dato) {
            if(!preg_match("/^Carlos/",$dato['username'])){
                unset($trabajadores[$trabajador]);
            }
        }
        $data['trabajadores'] = $trabajadores;
        $this->view->showViews(array('templates/header.view.php', 'consultas4.php', 'templates/footer.view.php'), $data);
    }
}
