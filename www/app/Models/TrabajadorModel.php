<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class TrabajadorModel extends BaseDbModel
{
    private const array ORDER_FIELDS = ['t.username', 't.salarioBruto', 't.retencionIRPF', 'nombre_rol', 'country_name'];
    private const DEFAULT_ORDER_INDEX = 1;
    private const DEFAULT_ITEMS_QUANTITY = 20;
    private const SELECT = "SELECT t.*, art.nombre_rol, ac.country_name";
    private const SELECT_COUNT = "SELECT COUNT(*) as total";
    private const string FROM = " FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country";
    private array $allowedFields = ['username', 'salarioBruto', 'retencionIRPF', 'activo', 'id_rol', 'id_country'];

    //private const string SELECT_FROM = "SELECT t.*, art.nombre_rol, ac.country_name FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country";
    public function getTrabajadores(): array
    {
        $trabajadores = $this->pdo->query('SELECT * FROM trabajadores')->fetchAll();
        return $trabajadores;
    }
    public function getAllTrabajadores(): array
    {
        $sql = self::SELECT . self::FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function getAllTrabajadoresOrdenados(): array
    {
        $sql = self::SELECT . self::FROM . " ORDER BY salarioBruto DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    private function filters(array $filtros): array
    {
        $sql = self::FROM;
        $values = [];
        $condiciones = [];
        if (!empty($filtros['username'])) {
            $condiciones[] = " username LIKE :username ";
            $values["username"] = "%" . $filtros['username'] . "%";
        }
        if (!empty($filtros['id_rol'])) {
            $condiciones[] = " t.id_rol LIKE :id_rol ";
            $values["id_rol"] = $filtros['id_rol'];
        }
        if (!empty($filtros['salarioMin'])) {
            $condiciones[] = "salarioBruto >= :salarioMin";
            $values["salarioMin"] = $filtros['salarioMin'];
        }
        if (!empty($filtros['salarioMax'])) {
            $condiciones[] = "salarioBruto <= :salarioMax";
            $values["salarioMax"] = $filtros['salarioMax'];
        }
        if (!empty($filtros['retencionIRPFMin'])) {
            $condiciones[] = "retencionIRPF >= :retencionIRPFMin";
            $values["retencionIRPFMin"] = $filtros['retencionIRPFMin'];
        }
        if (!empty($filtros['retencionIRPFMax'])) {
            $condiciones[] = "retencionIRPF <= :retencionIRPFMax";
            $values["retencionIRPFMax"] = $filtros['retencionIRPFMax'];
        }
        if (!empty($filtros['id_country']) && is_array($filtros['id_country'])) {
            $countries = [];
            $i = 1;
            foreach ($filtros['id_country'] as $idCountry) {
                $countries[":id_country{$i}"] = $idCountry;
                $i++;
            }
            $claves = array_keys($countries);
            $condiciones[] =  "t.id_country IN (" . implode(", ", $claves) . ")";
            $values = array_merge($values, $countries);
        }

        if (!empty($condiciones)) {
            $sql .= " WHERE " . implode(" AND ", $condiciones);
        }
        $sentido = !empty($filtros['sentido']) && $filtros['sentido'] === 'desc' ? 'DESC' : 'ASC';
        $sql .= " ORDER BY " . self::ORDER_FIELDS[$this->getOrderIndex($filtros) - 1] . " $sentido";

        return ['sql' => $sql, 'values' => $values];
    }

    public function getFilterBy(array $filtros): array
    {

        $aux = $this->filters($filtros);
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

        $aux = $this->filters($filtros);
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

    public function find(string $username): array|false
    {
        $sql = self::SELECT . self::FROM . " WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function addTrabajador(array $newTrabajador): bool
    {
        $sql = "insert into trabajadores (username, salarioBruto, retencionIRPF, activo, id_rol, id_country)
                values (:username, :salarioBruto, :retencionIRPF, :activo, :id_rol, :id_country)";
        $insertData = array_filter($newTrabajador, fn($key) => in_array($key, $this->allowedFields), ARRAY_FILTER_USE_KEY);
        $insertData['activo'] = !empty($newTrabajador['activo']) ? 1 : 0;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($insertData);
    }
    public function obtenerUnTrabajador(string $claveTrabajador): array
    {
        $sql = 'SELECT * FROM trabajadores WHERE username = :username';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $claveTrabajador]);
        return $stmt->fetch();
    }
    public function updateTrabajador(string $username, array $newTrabajador): bool
    {
        $sql = "update trabajadores
        set  salarioBruto=:salarioBruto,id_rol=:id_rol,id_country=:id_country,retencionIRPF=:retencionIRPF,activo=:activo where username=:username";

        $updateData = array_filter($newTrabajador, fn($key) => in_array($key, $this->allowedFields), ARRAY_FILTER_USE_KEY);
        $updateData['activo'] = !empty($newTrabajador['activo']) ? 1 : 0;
        $updateData['username'] = $username;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($updateData);
    }

    public function deleteTrabajador(string $username): bool
    {
        $sql = "delete from trabajadores where username = :username";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['username' => $username]);
    }
}
