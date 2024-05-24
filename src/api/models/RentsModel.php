<?php

namespace App\models;

class RentsModel extends BaseModel {
    protected $table = 'prestamos';

    public function create($data): false|array {
        $stmt = $this->db_handle->prepare("
        INSERT INTO prestamos (pelicula_prestada_id, cliente_prestando_id, fecha_prestamo, fecha_devolucion)
        VALUES (:pelicula_prestada_id, :cliente_prestando_id, :fecha_prestamo, :fecha_devolucion)
        ");
        $stmt->bindParam(':pelicula_prestada_id', $data['pelicula_prestada_id']);
        $stmt->bindParam(':cliente_prestando_id', $data['cliente_prestando_id']);
        $stmt->bindParam(':fecha_prestamo', $data['fecha_prestamo']);
        $stmt->bindParam(':fecha_devolucion', $data['fecha_devolucion']);
        $stmt->execute();

        return $data;
    }

    public function rentsForMovie($id): false|array {
        $stmt = $this->db_handle->query("SELECT prestamos.pelicula_prestada_id, prestamos.cliente_prestando_id,
       prestamos.fecha_prestamo, prestamos.fecha_devolucion, clientes.id AS cliente_id, clientes.nombre AS cliente_nombre,
       clientes.apellido AS cliente_apellido, clientes.correo AS cliente_correo, clientes.telefono AS cliente_telefono
    FROM prestamos
    INNER JOIN peliculas ON prestamos.pelicula_prestada_id = peliculas.id
    INNER JOIN clientes ON prestamos.cliente_prestando_id = clientes.id WHERE prestamos.pelicula_prestada_id = $id");

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $actual_result = [];

        foreach ($result as $row) {
            $row['cliente'] = [
                'id' => $row['cliente_id'],
                'nombre' => $row['cliente_nombre'],
                'apellido' => $row['cliente_apellido'],
                'correo' => $row['cliente_correo'],
                'telefono' => $row['cliente_telefono']
            ];
            unset($row['cliente_id']);
            unset($row['cliente_nombre']);
            unset($row['cliente_apellido']);
            unset($row['cliente_correo']);
            unset($row['cliente_telefono']);

            $actual_result[] = $row;
        }

        return $actual_result;
    }
}