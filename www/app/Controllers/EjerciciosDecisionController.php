<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class ejerciciosDecisionController extends BaseController
{
    public function ejercicioIf1(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 7;
        $y = 2;
        $data['x'] = $x;
        $data['y'] = $y;

        $data['respuesta'] = $x % $y;
        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf1.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicioIf2(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 7;
        $y = 2;
        $z = 8;
        $data['x'] = $x;
        $data['y'] = $y;
        $data['z'] = $z;
        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf2.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicioIf3(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 36060;
        $dias = intval($x / 86400);
        $horas = intval($x % 86400 / 3600);
        $minutos = intval($x % 86400 % 3600 / 60);
        $data['segundos'] = $x;
        $data['dias'] = $dias;
        $data['horas'] = $horas;
        $data['minutos'] = $minutos;
        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf3.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicioIf4(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $anho = 2028;
        if ($anho % 4 == 0 && $anho % 100 != 0) {
            $data['bisiesto'] = true;
        } else {
            $data['bisiesto'] = false;
        }

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf4.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicioIf5(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $sueldo = 1000;
        if ($sueldo > 2000) {
            $final = $sueldo - 250 - ($sueldo - 2000) / 100 * 18;
        } elseif ($sueldo > 1000) {
            $final = $sueldo - 100 - ($sueldo - 1000) / 100 * 15;
        } else {
            $final = $sueldo - ($sueldo / 100 * 10);
        }
        $data['final'] = $final;

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf5.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicioIf6(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $nota = 9;
        $data['nota'] = $nota;

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf6.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicioIf7(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $refrigerio = "Kas";
        $tipo = match($refrigerio) {
            'Marcilla','Bonka'=> "café",
            'Coca-cola','Kas','Pepsi'=> "refresco",
            'Mondariz','Cabreiroá','Sousas'=>"agua",
        };
        $data['refrigerio'] = $refrigerio;
        $data['tipo'] = $tipo;

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIf7.php', 'templates/footer.view.php'), $data);
    }
}
