<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuariosModel extends BaseDbModel
{
    private const SELECT = "SELECT us.*, ar.rol";
    private const string FROM = " FROM usuario_sistema us LEFT JOIN aux_rol ar ON ar.id_rol = us.id_rol ";

    public function getAllUsuarios(): array
    {
        $sql = self::SELECT . self::FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
