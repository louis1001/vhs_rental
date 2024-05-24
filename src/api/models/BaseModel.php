<?php
namespace App\models;
use App\core\database\DbHandler;

class BaseModel
{
    protected $table;
    protected $db_handle;

    public function __construct()
    {
        $this->db_handle = DbHandler::getInstance()->getDbHandle();
    }

    public function get($id)
    {
        $stmt = $this->db_handle->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAll($page = 1, $limit = 20): array
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db_handle->query("SELECT * FROM $this->table LIMIT $limit OFFSET $offset");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $set = implode(', ', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($data)));
        $stmt = $this->db_handle->prepare("UPDATE $this->table SET $set WHERE id = :id");
        $stmt->bindParam(':id', $id);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db_handle->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}