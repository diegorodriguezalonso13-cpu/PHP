<?php
declare(strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class IterativasController  extends BaseController
{
    public function ejercicio1(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo1.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicio1(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $numeros = $_POST['numeros'];
        $check = $this->checkEjercicio1($numeros);
        if ($check === true) {
            $arrayNumero = explode(',', $numeros);
            $data['mayor'] = max($arrayNumero);
            $data['menor'] = min($arrayNumero);
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo1.php', 'templates/footer.view.php'), $data);
        } else {
            $data['error'] = $check;
            $data['numeros'] = filter_var($numeros, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo1.php', 'templates/footer.view.php'), $data);
        }
    }

    private function checkEjercicio1(string $numeros): string | true
    {
        if ($numeros === '') {
            return 'Debe ingresar numeros';
        }
        $arrayNumero = explode(',', $numeros);

        foreach ($arrayNumero as $numero) {
            if (!is_numeric($numero)) {
                return 'Debe ingresar numeros separados por comas';
            }
        }
        return true;
    }
    public function ejercicioIterativo2(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo2.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicioIterativo2(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $numeros = $_POST['numeros'];
        $check = $this->checkEjercicio1($numeros);
        if ($check === true) {
            $arrayNumero = explode(',', $numeros);
            sort($arrayNumero);
            $data['arrayNumero'] = $arrayNumero;
            $data['numeros'] = $numeros;
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo2.php', 'templates/footer.view.php'), $data);
        } else {
            $data['error'] = $check;
            $data['numeros'] = filter_var($numeros, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo2.php', 'templates/footer.view.php'), $data);
        }
    }
    public function ejercicioIterativo3(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo3.php', 'templates/footer.view.php'), $data);
    }
    public function doEjercicioIterativo3(): void
    {
        $errores=$this->checkEjercicio3($_POST);
        if($errores===[]){

        }else{

        }
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $numeros = $_POST['numeros'];
        $check = $this->checkEjercicio3($numeros);
        if ($check === true) {
            $arrayNumero = explode(',',implode(',',explode('|', $numeros)));
            sort($arrayNumero);
            $data['arrayNumero'] = $arrayNumero;
            $data['numeros'] = $numeros;
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo3.php', 'templates/footer.view.php'), $data);
        } else {
            $data['error'] = $check;
            $data['numeros'] = filter_var($numeros, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php', 'ejercicioIterativo3.php', 'templates/footer.view.php'), $data);
        }
    }
    private function checkEjercicio3(array $data): array
    {
        if(empty($data['numeros'])){
            $errores['numeros']='Campo obligatorio';
        }else{
            $numeros=explode('|',$data['numeros']);
            $numeros=explode(',',$numeros);
            foreach ($numeros as $numero) {
                if (!is_numeric($numero)) {
                    $errores['numeros']='Debe ingresar numeros, '$numero' no lo es';
                }
            }
        }
        if ($numeros === '') {
            return 'Debe ingresar numeros';
        }

        $arrayNumero = explode(',',implode(',',explode('|', $numeros)));
        foreach ($arrayNumero as $numero) {
            if (!is_numeric($numero)) {
                return 'Debe ingresar numeros';
            }
        }
        return true;
    }
    private function montarMatriz(array $arrayNumero,int $numColumnas): array
    {
        $matriz=[];
        $aux=[];
        foreach ($arrayNumero as $numero) {
            if(count($aux)){}
        }
    }

}