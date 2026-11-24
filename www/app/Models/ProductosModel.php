<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ProductosModel extends BaseDbModel
{
    private const SELECT = "SELECT p.*,c.nombre_categoria FROM producto p LEFT JOIN categoria c ON c.id_categoria = p.id_categoria";
    public function getProductos(): array
    {
        $sql = self::SELECT;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
