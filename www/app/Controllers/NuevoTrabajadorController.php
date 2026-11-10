<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxCountryModel;
use Com\Daw2\Models\AuxRolTrabajadorModel;
use Com\Daw2\Models\TrabajadorModel;

class NuevoTrabajadorController extends BaseController
{
    public function nuevoTrabajdor(): void
    {
        $data = array(
            'titulo' => 'Datos nuevo trabajador',
            'breadcrumb' => ['Inicio', 'Consultas simples'],
        );
        $model = new TrabajadorModel();
        $modelRol = new AuxRolTrabajadorModel();
        $modelCountry = new AuxCountryModel();
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['roles'] = $modelRol->getAllRoles();
        $data['countries'] = $modelCountry->getAllCountries();
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'nuevoTrabajador.php', 'templates/footer.view.php'), $data);
    }
}
