<?php

namespace App\models;

class ClientsModel extends BaseModel
{
    protected $table = 'clientes';

    public function update($id, $data)
    {
        $stmt = $this->db_handle->prepare("UPDATE $this->table
            SET nombre = :nombre, apellido = :apellido, correo = :correo, telefono = :telefono
            WHERE id = :id");

        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':apellido', $data['apellido']);
        $stmt->bindParam(':correo', $data['correo']);
        $stmt->bindParam(':telefono', $data['telefono']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->get($id);
    }

    public function create($data)
    {
        $sql = "INSERT INTO $this->table (nombre, apellido, correo, telefono)
            VALUES (:nombre, :apellido, :correo, :telefono)";
        $stmt = $this->db_handle->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':apellido', $data['apellido']);
        $stmt->bindParam(':correo', $data['correo']);
        $stmt->bindParam(':telefono', $data['telefono']);
        $stmt->execute();
    }
}