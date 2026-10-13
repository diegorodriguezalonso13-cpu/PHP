<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class RegularesController extends BaseController
{
    public function ejercicioIterativo4(): void
    {
        $data = array(
            'titulo' => 'Ejercicios regulares',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo4.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicioIterativo4(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $letras = $_POST['letras'];
        $check = $this->checkEjercicio4($letras);
        if ($check === true) {
            $numeroLetras = [];
            for ($i = 0; $i <= 25; $i++) {
                $asci = chr(65 + $i);
                    $numeroLetras[$asci] = preg_match_all('/' . $asci . '/i', $letras);
                if ($numeroLetras[$asci] == 0) {
                    unset($numeroLetras[$asci]);
                }
            }
            arsort($numeroLetras);
            $data['letras'] = $numeroLetras;
            $data['texto'] = $letras;
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo4.php', 'templates/footer.view.php'), $data);
        } else {
            $data['error'] = $check;
            $data['letras'] = filter_var($letras, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo4.php', 'templates/footer.view.php'), $data);
        }
    }

    private function checkEjercicio4(string $letras): string | true
    {

        if (!preg_match("/[a-z]{1,}/i", $letras)) {
            return 'Debe ingresar letras';
        }
        return true;
    }
    public function ejercicioIterativo5(): void
    {
        $data = array(
            'titulo' => 'Ejercicios regulares',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo5.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicioIterativo5(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $letras = $_POST['letras'];
        $check = $this->checkEjercicio5($letras);
        if ($check === true) {
            $numeroPalabras = [];
            $palabras = preg_split('/[^\p{L}]+/u', $letras);
            foreach ($palabras as $palabra) {
                if (isset($numeroPalabras[$palabra])) {
                    $numeroPalabras[$palabra] = +1;
                } else {
                    $numeroPalabras[$palabra] = 1;
                }
            }




            arsort($numeroPalabras);
            $data['palabras'] = $numeroPalabras;
            $data['texto'] = $letras;
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo5.php', 'templates/footer.view.php'), $data);
        } else {
            $data['error'] = $check;
            $data['letras'] = filter_var($letras, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo5.php', 'templates/footer.view.php'), $data);
        }
    }

    private function checkEjercicio5(string $letras): string | true
    {

        if (!preg_match("/[a-z]{1,}/i", $letras)) {
            return 'Debe ingresar letras';
        }
        return true;
    }

    //Ejercicio 5 casi terminado, más abajo ejercicio 8
    public function ejercicioIterativo8(string $json = '', array $errores = [], array $resultado = [], array $resultados = []): void
    {
        $data = array(
            'titulo' => 'Ejercicios regulares',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $data['errores'] = $errores;
        $data['json'] = $json;
        $data['resultado'] = $resultado;
        $data['resultados'] = $resultados;
        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo8.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicioIterativo8(): void
    {
        $json = $_POST['json'] ?? '';
        $errores = $this->checkEjercicio8($json);
        if ($errores === []) {
            $resultados = [];
            foreach (json_decode($json, true) as $asignatura => $alumnos) {
                foreach ($alumnos as $alumno => $nota) {
                    if (!isset($resultados[$alumno])) {
                        $resultados[$alumno] = 0;
                    }
                    if ($nota < 5) {
                        $resultados[$alumno] += 1;
                    }
                }
            }


            $resultado = $this->procesarEjercicio8(json_decode($json, true));
            $this->ejercicioIterativo8(filter_var($json, FILTER_SANITIZE_FULL_SPECIAL_CHARS), $errores, $resultado, $resultados);
        } else {
            $this->ejercicioIterativo8(filter_var($json, FILTER_SANITIZE_FULL_SPECIAL_CHARS), $errores);
        }
    }

    private function procesarEjercicio8(array $datos): array
    {
        $resultado = [];
        foreach ($datos as $asignatura => $alumnos) {
            $datosAsignatura = [
                'media' => 0,
                'suspensos' => 0,
                'aprobados' => 0,
                'max' => ['alumno' => null,'nota' => null],
                'max' => ['alumno' => null,'nota' => null]
            ];
            $numAlumnos = count($alumnos);
            $notaAgregada = 0;
            foreach ($alumnos as $nombre => $nota) {
                $notaAgregada += $nota;
                if ($nota >= 5) {
                    $datosAsignatura['aprobados']++;
                } else {
                    $datosAsignatura['suspensos']++;
                }
                if ($datosAsignatura['max']['alumno'] === null) {
                    $datosAsignatura['max']['alumno'] = $nombre;
                    $datosAsignatura['max']['nota'] = $nota;
                    $datosAsignatura['min']['alumno'] = $nombre;
                    $datosAsignatura['min']['nota'] = $nota;
                } else {
                    if ($datosAsignatura['max']['nota'] < $nota) {
                        $datosAsignatura['max']['alumno'] = $nombre;
                        $datosAsignatura['max']['nota'] = $nota;
                    }
                    if ($datosAsignatura['min']['nota'] > $nota) {
                        $datosAsignatura['min']['alumno'] = $nombre;
                        $datosAsignatura['min']['nota'] = $nota;
                    }
                }
            }
            $datosAsignatura['media'] = ($numAlumnos > 0) ? $notaAgregada / $numAlumnos : null;
            $resultado[$asignatura] = $datosAsignatura;
        }
        return $resultado;
    }

    private function checkEjercicio8(string $json)
    {
        $errores = [];
        if ($json === '') {
            $errores['json'][] = 'Campo obligatorio';
        } else {
            if (json_validate($json)) {
                $datos = json_decode($json, true);
                if (is_array($datos)) {
                    foreach ($datos as $asignatura => $alumnos) {
                        if (!is_string($asignatura)) {
                            $errores['json'][] = "El valor $asignatura no es una string";
                        } else {
                            if (!is_array($alumnos)) {
                                $errores['json'][] = "No tenemos alumnos en $asignatura ";
                            } else {
                                foreach ($alumnos as $nombre => $nota) {
                                    if (!is_string($nombre)) {
                                        $errores['json'][] = "El valor $nombre no es una string";
                                    } elseif (!is_numeric($nota)) {
                                        $errores['json'][] = "En $asignatura, $nombre no es un numero";
                                    } elseif ($nota > 10 || $nota < 0) {
                                        $errores['json'][] = "No tiene una nota válida";
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $errores['json'][] = 'El json no tiene el formato esperado';
                }
            } else {
                $errores['json'][] = 'Inserte un json valido';
            }
        }
        return $errores;
    }
    //EJ 9 abajo
    public function ejercicioIterativo9(string $json = '', array $errores = [], array $resultado = [], array $resultados = []): void
    {
        $data = array(
            'titulo' => 'Ejercicios regulares',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $data['errores'] = $errores;
        $data['json'] = $json;
        $data['resultado'] = $resultado;
        $data['resultados'] = $resultados;
        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo9.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicio9():void
    {
        $errores=
    }

    private function checkejercicio9(string $jsonText): array
    {
        $errores = [];
        if (!isset($datosFormulario['json'])) {
        } else {
            $jsonText = $datosFormulario['json'];

            if ($jsonText === '') {
                $errores['json'][] = 'Campo obligatorio';
            } else {
                if (json_validate($jsonText)) {
                    $errores['json'][] = 'Inserta Json valido';
                } else {
                    $data = json_decode($jsonText, true);
                    foreach ($data as $modulo => $alumnos) {
                        if (!is_string($modulo)) {
                            $errores['json'][] = "El valor $modulo no es una string";
                        }
                        if (!is_array($alumnos)) {
                            $errores['json'][] = "No tenemos alumnos asociados en $modulo ";
                        } else {
                            foreach ($alumnos as $nombre => $notas) {
                                if (!is_string($nombre)) {
                                    $errores['json'][] = "El valor $nombre, de $modulo no es una string";
                                }
                                if (!is_array($notas)) {
                                    $errores['json'][] = "No tenemos notas asociadas a $nombre en $modulo ";
                                } else {
                                    if($notas===[]){
                                        $errores['json'][] = "En el modulo $modulo, el alumno '$nombre' no tiene notas asignadas";
                                    }else{
                                    foreach ($notas as $nota) {
                                        if (!is_numeric($nota)) {
                                            $errores['json'][] = "En el modulo $modulo, el alumno '$nombre' tiene la nota $nota que no es un número";
                                        } else if ($nota < 0 || $nota > 10) {
                                            $errores['json'][] = "En el modulo $modulo, el alumno '$nombre' tiene la nota $nota que no es un valor entre 0 y 10";
                                        }
                                    }}
                                }
                            }
                        }
                    }
                }
            }
        }
        return $errores;
    }
    private function procesarejercicio9(array $datos):array{
        $resultado = [];
        foreach ($datos as $modulo => $alumnos) {
            $datosModulo=[
                'media'=>null,
                'aprobados' => 0,
                'suspensos' => 0,
                'max' => ['alumno' => null,'nota' => null],
                'min' => ['alumno' => null,'nota' => null]
            ];
            $notasFinales=[];
            foreach($alumnos as $nombre => $notas){
                $mediaAlumno =array_sum($notas)/count($notas);
                $notasFinales[]=$mediaAlumno;
                if($mediaAlumno>=5){
                    $datosModulo['aprobados']++;
                }else{
                    $datosModulo['suspensos']++;
                }
                if ($datosModulo['max']['alumno'] === null) {
                    $datosModulo['max']['alumno'] = $nombre;
                    $datosModulo['max']['nota'] = $mediaAlumno;
                    $datosModulo['min']['alumno'] = $nombre;
                    $datosModulo['min']['nota'] = $mediaAlumno;
                } else {
                    if ($datosModulo['max']['nota'] < $mediaAlumno) {
                        $datosModulo['max']['alumno'] = $nombre;
                        $datosModulo['max']['nota'] = $mediaAlumno;
                    }
                    if ($datosModulo['min']['nota'] > $mediaAlumno) {
                        $datosModulo['min']['alumno'] = $nombre;
                        $datosModulo['min']['nota'] = $mediaAlumno;
                    }
                }

            }
            if (count($notasFinales) > 0) {
                $datosModulo['media'] = array_sum($notasFinales) / count($notasFinales);
            }
            $resultado[$modulo] = $datosModulo;
        }
        return $resultado;
    }
}
