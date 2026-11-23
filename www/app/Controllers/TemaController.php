<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class TemaController extends BaseController
{
    public function tema(): void
    {
        $data = array(
            'titulo' => 'Tema de la pagina',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $this->view->showViews(array('templates/header.view.php', 'tema.php', 'templates/footer.view.php'), $data);
    }
    //Esta función comprueba que recibe un valor true o false y lo guarda como cookie en dark-mode
    public function guardarTema(): void
    {
        $darkmode = !empty($_POST['tema']) && $_POST['tema'] == 'dark';
        setcookie('dark_mode', (string)$darkmode, time() + 2592000);
        $_COOKIE['dark_mode'] = $darkmode;
        $this->tema();
    }
}
