<?php
declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class AuxCountryModel extends BaseDbModel
{
    public function getAllCountries(): array
    {
        $sql = "SELECT ac.* FROM aux_countries ac ORDER BY ac.country_name ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function find(int $idCountry): array|false
    {
        $sql = "SELECT * FROM aux_countries WHERE id = :idCountry";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idCountry' => $idCountry]);
        return $stmt->fetch();
    }

}