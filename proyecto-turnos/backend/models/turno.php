<?php
class Turno {
    private $conn;
    private $table = "turnos";

    public function obtenerHorariosOcupados($fecha) {
    $query = "SELECT hora FROM turnos WHERE fecha = :fecha AND estado = 'activo'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([":fecha" => $fecha]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($data) {
        $query = "INSERT INTO {$this->table} 
        (nombre_cliente, servicio_id, fecha, hora) 
        VALUES (:nombre, :servicio, :fecha, :hora)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":nombre" => $data['nombre'],
            ":servicio" => $data['servicio_id'],
            ":fecha" => $data['fecha'],
            ":hora" => $data['hora']
        ]);
    }

    public function existeTurno($fecha, $hora) {
        $query = "SELECT COUNT(*) as total 
                  FROM {$this->table} 
                  WHERE fecha = :fecha AND hora = :hora AND estado = 'activo'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ":fecha" => $fecha,
            ":hora" => $hora
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }
}