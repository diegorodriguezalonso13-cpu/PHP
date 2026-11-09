<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuariosModel extends BaseDbModel
{
    private const SELECT = "SELECT us.*, ar.rol";
    private const SELECT_COUNT = "SELECT COUNT(*) as total";
    private const string FROM = " FROM usuario_sistema us LEFT JOIN aux_rol ar ON ar.id_rol = us.id_rol ";
    private const DEFAULT_ORDER_INDEX = 1;
    private const ORDER_FIELDS = ['us.nombre','us.email','us.idioma','ar.rol','us.last_date'];
    private const DEFAULT_ITEMS_QUANTITY =1;

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
            $fechaReciente= \DateTimeImmutable::createFromFormat('d/m/Y',$filtros['last_date_max']);
            if($fechaReciente !==false) {
                $condiciones[] = " us.last_date <= :last_date_max ";
                $values["last_date_max"] = $filtros['last_date_max'];
            }
        }
        if (!empty($filtros['last_date_min'])) {
            $fechaAntigua= \DateTimeImmutable::createFromFormat('d/m/Y',$filtros['last_date_min']);
            if($fechaAntigua !==false) {
                $condiciones[] = " us.last_date >= :last_date_min ";
                $values["last_date_min"] = $filtros['last_date_in'];
            }
        }
        //TODO esto de abajo es para poner bien el formato de las fechas
//        if(!empty($filtros['last_date_from'])){
//            $fromdate = \DateTimeImmutable::createFromFormat('d/m/Y H:i:s', $filtros['last_date_from']);
//            if ($fromdate !== false) {
//                $condiciones[] = 'u.last_date >= :last_date_from';
//                $values['last_date_from'] = $fromdate->format('Y-m-d H:i:s');
//            }
//        }
//        if(!empty($filtros['last_date_to'])){
//            $toDate = \DateTimeImmutable::createFromFormat('d/m/Y H:i:s', $filtros['last_date_to']);
//            if ($toDate !== false) {
//                $condiciones[] = 'u.last_date >= :last_date_to';
//                $values['last_date_to'] = $toDate->format('Y-m-d H:i:s');
//            }
//        }

        //Aquí se aplican los filtros en la consulta
        if (!empty($condiciones)) {
            $sql .= " WHERE " . implode(" AND ", $condiciones);
        }
        $sentido = !empty($filtros['sentido']) && $filtros['sentido'] === 'desc' ? 'DESC' : 'ASC';
        $sql .= " ORDER BY " . self::ORDER_FIELDS[$this->getOrderIndex($filtros) - 1] . " $sentido";

        return ['sql' => $sql, 'values' => $values];
    }
    public function getFilterBy(array $filtros): array
    {
        $aux = $this->getFilters($filtros);
        $sql = self::SELECT . $aux['sql'];
        $values = $aux['values'];
        $paginaActual = $this->getPage($filtros);
        $inicio = self::DEFAULT_ITEMS_QUANTITY * ($paginaActual - 1);
        $sql .= " LIMIT " . $inicio . " ," . self::DEFAULT_ITEMS_QUANTITY;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
    public function getNumeroRegistros(array $filtros): int
    {

        $aux = $this->getFilters($filtros);
        $sql = self::SELECT_COUNT . $aux['sql'];
        $values = $aux['values'];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchColumn(0);
    }

    public function getOrderIndex(array $filtros): int
    {
        if (empty($filtros['order'])) {
            return self::DEFAULT_ORDER_INDEX;
        } elseif (filter_var($filtros['order'], FILTER_VALIDATE_INT) === false || $filtros['order'] < 1 || $filtros['order'] > count(self::ORDER_FIELDS)) {
            return self::DEFAULT_ORDER_INDEX;
        } else {
            return (int)$filtros['order'];
        }
    }
    public function getPage(array $filtros): int
    {
        return !empty($filtros['page']) && filter_var($filtros['page'], FILTER_VALIDATE_INT) ? (int)$filtros['page'] : 1;
    }
    public function getLastPage(array $filtros): int
    {
        return (int)ceil($this->getNumeroRegistros($filtros) / self::DEFAULT_ITEMS_QUANTITY);
    }
}
