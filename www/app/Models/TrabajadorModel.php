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
    public function getAllRoles(): array
    {
        $sql = "SELECT art.* FROM aux_rol_trabajador art";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function getTrabajadoresBySalario(): array
    {
        $sql = self::SELECT_FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }


}
