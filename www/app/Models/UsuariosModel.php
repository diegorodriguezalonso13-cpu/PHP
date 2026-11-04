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
    public function getAllRoles(): array
    {
        $sql = "SELECT * FROM aux_rol";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function getAllIdiomas(): array
    {
        $sql = "SELECT DISTINCT us.idioma FROM usuario_sistema us";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    private function getFilters(array $filtros): array
    {
        $sql = self::FROM;
        $values = [];
        $condiciones = [];
        if (!empty($filtros['name'])) {
            $condiciones[] = " us.nombre LIKE :name ";
            $values["name"] = "%" . $filtros['name'] . "%";
        }
        if (!empty($filtros['email'])) {
            $condiciones[] = " us.email LIKE :email ";
            $values["email"] = "%" . $filtros['email'] . "%";
        }
        if (!empty($filtros['idioma'])) {
            $condiciones[] = " us.idioma LIKE :idioma ";
            $values["idioma"] = "%" . $filtros['idioma'] . "%";
        }


        if (!empty($filtros['id_rol']) && is_array($filtros['id_rol'])) {
            $roles = [];
            $i = 1;
            foreach ($filtros['id_rol'] as $idRol) {
                $roles[":id_rol{$i}"] = $idRol;
                $i++;
            }
            $claves = array_keys($roles);
            $condiciones[] = " ar.id_rol IN (" . implode(", ", $claves) . ") ";
            $values = array_merge($values, $roles);
        }



        if (!empty($filtros['last_date_max'])) {
            $condiciones[] = " us.ultimo_acceso <= :last_date_max ";
            $values["last_date_max"] = $filtros['last_date_max'];
        }
        if (!empty($filtros['last_date_min'])) {
            $condiciones[] = " us.ultimo_acceso >= :last_date_min ";
            $values["last_date_min"] = $filtros['last_date_in'];
        }
        //Aquí se aplican los filtros en la consulta
        if (!empty($condiciones)) {
            $sql .= " WHERE " . implode(" AND ", $condiciones);
        }
        //TODO: meter la ordenación aquí

        return ['sql' => $sql, 'values' => $values];
    }
    public function getFilterBy(array $filtros): array
    {
        $aux = $this->getFilters($filtros);
        $sql = self::SELECT . $aux['sql'];
        $values = $aux['values'];
        //TODO meter el paginado aquí
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
}
