<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class EjerciciosController extends \Com\Daw2\Core\BaseController
{
    public function ejercicio1strings(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $s = 'Carmiña';
        $final = '_user';
        $comillasDobles = "{$s}_user";
        $comillasSimples = $s . '_user'; //rafa_user

        $data['comillasSimples'] = $comillasSimples;
        $data['comillasDobles'] = $comillasDobles;
        $data['s'] = $s;
        $data['final'] = $final;
        $this->addNumbers(1, 2);
        $this->addNumbers(2, 3, 4);
        $this->addNumbers(a:5, b:6, d: '8');


        $this->view->showViews(array('templates/header.view.php', 'ejercicios1-strings.view.php', 'templates/footer.view.php'), $data);
    }

    function addNumbers(int|float $a, int|float $b, int|float $c = 0, int|float|string $d = 0): int|false
    {
        return $a + $b + $c + $d;
    }

    function getFechaNacimiento(Persona $p): Date
    {
    }
    public function ejercicio1cuadrado(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 5;
        $y = $x ** 2;
        $data['x'] = $x;
        $data['y'] = $y;

        $this->view->showViews(array('templates/header.view.php', 'eje1diego.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio2trabajo(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 20;
        $y = 8;
        $z = $x * $y;
        $data['x'] = $x;
        $data['y'] = $y;
        $data['z'] = $z;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio2trabajo.php', 'templates/footer.view.php'), $data);
    }

    public function ejercicio3rectangulo(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 2;
        $y = 8;
        $a = $x * $y;
        $p = $x * 2 + $y * 2;
        $data['x'] = $x;
        $data['y'] = $y;
        $data['area'] = $a;
        $data['perimetro'] = $p;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio3rectangulo.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio4alumno(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $nombre = 'Diego';
        $y = 19;
        $z = 7.75;
        $data['nombre'] = $nombre;
        $data['edad'] = $y;
        $data['media'] = $z;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio4alumno.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio5hotel(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $w = 1;
        $x = 30;
        $y = 19;
        $z = 7;
        $total = $w * $y + $x * $z;
        $data['nochesAlta'] = $w;
        $data['nochesBaja'] = $x;
        $data['tAlta'] = $y;
        $data['tBaja'] = $z;
        $data['total'] = $total;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio5hotel.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio6circulo(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $r = 6;
        $area = pi() * $r ** 2;
        $perimetro = pi() * $r * 2;
        $data['radio'] = $r;
        $data['area'] = $area;
        $data['perimetro'] = $perimetro;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio6circulo.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio7transformar(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 60;
        $y = $x / 3.6;
        $data['kmH'] = $x;
        $data['mS'] = $y;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio7transformar.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio8cifras(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $x = 189;
        $y = intval($x / 100);
        $d = intval(intval($x % 100) / 10);
        $u = intval($x % 10);
        $data['numero'] = $x;
        $data['centena'] = $y;
        $data['decena'] = $d;
        $data['unidad'] = $u;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio8cifras.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio9cadena(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $cadena = 'cadena de texto';
        $y = mb_strlen($cadena);
        $z = str_word_count($cadena);
        $data['cadena'] = $cadena;
        $data['caracteres'] = $y;
        $data['palabras'] = $z;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio9cadena.php', 'templates/footer.view.php'), $data);
    }
}
