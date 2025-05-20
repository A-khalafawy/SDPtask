<?php
require_once 'config/Database.php';
class Beneficiary {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); // Use Singleton for database instance
    }

    public function getBeneficiaries() {
        $query = "SELECT * FROM beneficiary";
        return $this->db->query($query);
    }

    public function getBeneficiaryById($beneficiaryId) {
        $query = "SELECT * FROM beneficiary WHERE beneficiary_id = :beneficiary_id";
        $result = $this->db->query($query, [':beneficiary_id' => $beneficiaryId]);
        if ($result === false || count($result) === 0) {
            return null;
        }
        return $result[0];
    }

    public function addBeneficiary($data) {
        $query = "INSERT INTO beneficiary (name, need) VALUES (:name, :need)";
        return $this->db->execute($query, $data);
    }

    public function updateBeneficiary($beneficiaryId, $data) {
        $query = "UPDATE beneficiary 
                  SET name = :name, need = :need 
                  WHERE beneficiary_id = :beneficiary_id";
        return $this->db->execute($query, array_merge($data, [':beneficiary_id' => $beneficiaryId]));
    }

    public function deleteBeneficiary($beneficiaryId) {
        $query = "DELETE FROM beneficiary WHERE beneficiary_id = :beneficiary_id";
        return $this->db->execute($query, [':beneficiary_id' => $beneficiaryId]);
    }
}

?>
