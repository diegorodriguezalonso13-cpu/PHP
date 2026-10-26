<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class TrabajadorModel extends BaseDbModel
{
    private const string SELECT_FROM = "SELECT t.*, art.nombre_rol, ac.country_name FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country";
    public function getTrabajadores(): array
    {
        $trabajadores = $this->pdo->query('SELECT * FROM trabajadores')->fetchAll();
        return $trabajadores;
    }
    public function getAllTrabajadores(): array
    {
        $sql = self::SELECT_FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function getAllTrabajadoresOrdenados(): array
    {
        $sql = self::SELECT_FROM . " ORDER BY salarioBruto DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getFilterBy(array $filtros): array
    {
        $sql = self::SELECT_FROM;
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
        //TODO: Preguntar a Rafa si un foreach podría ser óptimo

        if (!empty($condiciones)) {
            $sql .= " WHERE " . implode(" AND ", $condiciones);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
    public function getTrabajadoresByName($username): array
    {
        $sql = self::SELECT_FROM . " WHERE username LIKE :username ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => "%{$username}%"]);
        return $stmt->fetchAll();
    }
    public function getTrabajadoresByRol($id_rol): array
    {
        $sql = self::SELECT_FROM . " WHERE t.id_rol LIKE :id_rol ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_rol' => "$id_rol"]);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresBySalario(): array
    {
        $sql = self::SELECT_FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
