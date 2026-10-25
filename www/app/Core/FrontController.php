<?php

namespace Com\Daw2\Core;

use Com\Daw2\Controllers\CategoriaController;
use Com\Daw2\Controllers\EjerciciosController;
use Com\Daw2\Controllers\PreferenciasController;
use Com\Daw2\Controllers\UsuarioSistemaController;
use Steampixel\Route;

class FrontController
{
    public static function main()
    {
        Route::add(
            '/',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            },
            'get'
        );
        Route::add(
            '/ejercicio1-strings',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio1Strings();
            },
            'get'
        );
        Route::add(
            '/ejercicio1-cuadrado',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio1cuadrado();
            },
            'get'
        );
        Route::add(
            '/ejercicio2-trabajo',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio2trabajo();
            },
            'get'
        );
        Route::add(
            '/ejercicio3-rectangulo',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio3rectangulo();
            },
            'get'
        );
        Route::add(
            '/ejercicio4-alumno',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio4alumno();
            },
            'get'
        );
        Route::add(
            '/ejercicio5-hotel',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio5hotel();
            },
            'get'
        );
        Route::add(
            '/ejercicio6-circulo',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio6circulo();
            },
            'get'
        );
        Route::add(
            '/ejercicio7-transformar',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio7transformar();
            },
            'get'
        );
        Route::add(
            '/ejercicio8-cifras',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio8cifras();
            },
            'get'
        );
        Route::add(
            '/ejercicio9-cadena',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio9cadena();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf1',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf1();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf2',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf2();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf3',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf3();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf4',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf4();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf5',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf5();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf6',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf6();
            },
            'get'
        );
        Route::add(
            '/ejercicioIf7',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
                $controlador->ejercicioIf7();
            },
            'get'
        );

        Route::add(
            '/ejercicioIterativo1',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->ejercicio1();
            },
            'get'
        );
        Route::add(
            '/ejercicioIterativo1',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->doEjercicio1();
            },
            'post'
        );
        Route::add(
            '/ejercicioIterativo2',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->ejercicioIterativo2();
            },
            'get'
        );
        Route::add(
            '/ejercicioIterativo2',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->doEjercicioIterativo2();
            },
            'post'
        );
        Route::add(
            '/ejercicioIterativo3',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->ejercicioIterativo3();
            },
            'get'
        );
        Route::add(
            '/ejercicioIterativo3',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->doEjercicioIterativo3();
            },
            'post'
        );
        Route::add(
            '/ejercicioIterativo4',
            function () {
                $controlador = new \Com\Daw2\Controllers\RegularesController();
                $controlador->ejercicioIterativo4();
            },
            'get'
        );
        Route::add(
            '/ejercicioIterativo4',
            function () {
                $controlador = new \Com\Daw2\Controllers\RegularesController();
                $controlador->doEjercicioIterativo4();
            },
            'post'
        );
        Route::add(
            '/ejercicioIterativo5',
            function () {
                $controlador = new \Com\Daw2\Controllers\RegularesController();
                $controlador->ejercicioIterativo5();
            },
            'get'
        );
        Route::add(
            '/ejercicioIterativo5',
            function () {
                $controlador = new \Com\Daw2\Controllers\RegularesController();
                $controlador->doEjercicioIterativo5();
            },
            'post'
        );
        Route::add(
            '/ejercicioIterativo8',
            function () {
                $controlador = new \Com\Daw2\Controllers\RegularesController();
                $controlador->ejercicioIterativo8();
            },
            'get'
        );
        Route::add(
            '/ejercicioIterativo8',
            function () {
                $controlador = new \Com\Daw2\Controllers\RegularesController();
                $controlador->doEjercicioIterativo8();
            },
            'post'
        );

        Route::add(
            '/TrabajadorController',
            function () {
                $controlador = new \Com\Daw2\Controllers\TrabajadorController();
                $controlador->testDb();
            },
            'get'
        );
        Route::add(
            '/consultas1',
            function () {
                $controlador = new \Com\Daw2\Controllers\TrabajadorController();
                $controlador->consultas1();
            },
            'get'
        );
        Route::add(
            '/consultas2',
            function () {
                $controlador = new \Com\Daw2\Controllers\TrabajadorController();
                $controlador->consultas2();
            },
            'get'
        );
        Route::add(
            '/preparedStatement1',
            function () {
                $controlador = new \Com\Daw2\Controllers\TrabajadorController();
                $controlador->prepStmt1();
            },
            'get'
        );

        Route::add(
            '/demo-proveedores',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demo();
            },
            'get'
        );
        Route::pathNotFound(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );
        Route::methodNotAllowed(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
        Route::run();
    }
}
