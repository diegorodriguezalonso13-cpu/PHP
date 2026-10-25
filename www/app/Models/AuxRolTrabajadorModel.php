<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class AuxRolTrabajadorModel extends BaseDbModel
{
    public function getAllRoles(): array
    {
        $sql = "SELECT art.* FROM aux_rol_trabajador art ORDER BY art.nombre_rol ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

}
