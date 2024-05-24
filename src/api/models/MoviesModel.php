<?php
namespace App\models;

class MoviesModel extends BaseModel {
    protected $table = 'peliculas';

    public function get($id)
    {
        $stmt = $this->db_handle->prepare("SELECT
            peliculas.id, peliculas.titulo, peliculas.resumen, peliculas.anio, peliculas.disponible,
            topicos.id AS topico_id, topicos.nombre AS topico_nombre
        FROM $this->table
        INNER JOIN topicos ON peliculas.topico_id = topicos.id
        WHERE peliculas.id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result !== false) {
            $result['topico'] = [
                'id' => $result['topico_id'],
                'nombre' => $result['topico_nombre']
            ];
            unset($result['topico_id']);
            unset($result['topico_nombre']);

            $result['disponible'] = (bool) $result['disponible'];

            return $result;
        } else {
            return [];
        }
    }

    public function getAll($page = 1, $limit = 20): array
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db_handle->query("SELECT
            peliculas.id, peliculas.titulo, peliculas.resumen, peliculas.anio, peliculas.disponible,
            topicos.id AS topico_id, topicos.nombre AS topico_nombre
            FROM $this->table
        INNER JOIN topicos ON peliculas.topico_id = topicos.id
        LIMIT $limit OFFSET $offset");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $actual_result = [];

        foreach ($result as $row) {
            $row['topico'] = [
                'id' => $row['topico_id'],
                'nombre' => $row['topico_nombre']
            ];
            unset($row['topico_id']);
            unset($row['topico_nombre']);

            $row['disponible'] = (bool) $row['disponible'];

            $actual_result[] = $row;
        }

        return $actual_result;
    }

    public function update($id, $data)
    {
        $stmt = $this->db_handle->prepare("UPDATE $this->table SET
            titulo = :titulo,
            resumen = :resumen,
            anio = :anio,
            disponible = :disponible,
            topico_id = :topico_id
        WHERE id = :id");

        $data['disponible'] = $data['disponible'] ? 1 : 0;

        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':resumen', $data['resumen']);
        $stmt->bindParam(':anio', $data['anio']);
        $stmt->bindParam(':disponible', $data['disponible']);
        $stmt->bindParam(':topico_id', $data['topico']['id']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->get($id);
    }

    public function create($data): false|array
    {
        $stmt = $this->db_handle->prepare("INSERT INTO $this->table
            (titulo, resumen, anio, disponible, topico_id)
            VALUES (:titulo, :resumen, :anio, :disponible, :topico_id)");

        $data['disponible'] = $data['disponible'] ? 1 : 0;

        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':resumen', $data['resumen']);
        $stmt->bindParam(':anio', $data['anio']);
        $stmt->bindParam(':disponible', $data['disponible']);
        $stmt->bindParam(':topico_id', $data['topico']['id']);
        $stmt->execute();

        $id = $this->db_handle->lastInsertId();
        return $this->get($id);
    }
}