<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    public function prepStmt2()
    {
        $data = array(
            'titulo' => 'Usuarios del sistema',
            'breadcrumb' => ['Inicio', 'Ordenar'],
            'js' => ['assets/js/pages/usuarios-sistema.js']
        );
        $model = new UsuariosModel();
        $data['usuarios'] = $model->getFilterBy($_GET);
        $data['roles'] = $model->getAllRoles();
        $data['idiomas'] = $model->getAllIdiomas();
        $data['order'] = $model->getOrderIndex($_GET);
        $data['page'] = $model->getPage($_GET);
        $data['lastPage'] = $model->getLastPage($_GET);
        //No modificamos la superglobal, la copiamos en $getOrder
        $getOrder = $_GET;
        unset($getOrder['order']);
        unset($getOrder['sentido']);
        $data['queryParams'] = http_build_query($getOrder);
        $getPages = $_GET;
        unset($getPages['page']);
        $data['queryParamsPages'] = http_build_query($getPages);
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'usuariosSistema.php', 'templates/footer.view.php'), $data);
    }
    public function checkNuevoUsuario(array $datos, bool $edicion): array
    {
        $errores = [];
        if (!$edicion) {
            if (empty($datos['username'])) {
                $errores['username'] = 'Campo obligatorio';
            } elseif (!preg_match('/^[\p{L}0-9_]{5,20}$/', $datos['username'])) {
                $errores['username'] = 'Nombre de usuario no válido';
            } else {
                $modelo = new UsuariosModel();
                $usuario = $modelo->findByUsername($datos['username']);
                if ($usuario) {
                    $errores['username'] = 'El nombre de usuario ya existe';
                }
            }
        }
        if (empty($datos['email'])) {
            $errores['email'] = 'Campo obligatorio';
        } elseif (!preg_match('/^[\p{L}0-9._%+-]+@[\p{L}0-9-]+(?:\.[\p{L}0-9-]+)*\.\p{L}{2,}$/', $datos['email'])) {
            $errores['email'] = 'Correo no valido';
        } else {
            $modelo = new UsuariosModel();
            $usuario = $modelo->findByEmail($datos['email']);
            if ($usuario) {
                $errores['email'] = 'El correo ya existe';
            }
        }
        if (empty($datos['idioma'])) {
            $errores['idioma'] = 'Campo obligatorio';
        } elseif (!in_array($datos['idioma'], ['es', 'en', 'gl'])) {
            $errores['idioma'] = 'No se ha registrado un idioma válido';
        }

        if (empty($datos['id_rol'])) {
            $errores['id_rol'] = 'Campo obligatorio';
        } elseif (filter_var($datos['id_rol'], FILTER_VALIDATE_INT) === false) {
            $errores['id_rol'] = 'Rol no válido';
        } else {
            $rolModel = new UsuariosModel();
            $rol = $rolModel->getAllRoles();
            if ($rol === false) {
                $errores['id_rol'] = 'Rol no válido';
            }
        }
        return $errores;
    }

    public function editUsuario(int $id, array $input = [], array $errores = []): void
    {
        $data = array(
            'titulo' => 'Editar usuario',
            'breadcrumb' => ['Inicio', 'Editar'],
            'input' => $input,
            'errors' => $errores,
        );
        $model = new UsuariosModel();
        $data['roles'] = $model->getAllRoles();
        $data['idiomas'] = ['es', 'en', 'gl'];
        if ($input == []) {
            $input = $model->verificarId($id);
            if ($input) {
                $data['input'] = $input;
            } else {
                header('Location: /preparedstatement1');
            }
        }
        $this->view->showViews(array('templates/header.view.php', 'editarUsuario.php', 'templates/footer.view.php'), $data);
    }
    public function doEditUsuario(int $id): void
    {
        $errores = $this->checkNuevoUsuario($_POST, true);
        if (empty($errores)) {

        }
    }
    public function nuevoUsuario(): void
    {
    }
    public function doNuevoUsuario(): void
    {
    }
    public function deleteUsuario(int $id): void
    {
    }
    public function login(bool $error = false): void
    {
        $this->view->show('login.php', ['error' => $error]);
    }

    public function nosequeLogin(): void
    {
        $error = false;
        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            $model = new UsuariosModel();
            $user = $model->verificarUsuario($_POST['email']);
            if ($user !== false && password_verify($_POST['pass'], $user['pass'])) {
                session_regenerate_id(true);
                $_SESSION['usuario'] = $user;
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
        if (!$error) {
            header('Location: /');
        } else {
            $this->login(true);
        }
    }
}
