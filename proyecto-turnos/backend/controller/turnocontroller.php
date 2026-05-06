<?php
require_once '../models/turno.php';

class TurnoController {
    private $model;

    public function __construct($db) {
        $this->model = new Turno($db);
    }

    public function reservar() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data['nombre'] || !$data['fecha'] || !$data['hora']) {
            echo json_encode(["error" => "Datos incompletos"]);
            return;
        }

        if ($this->model->existeTurno($data['fecha'], $data['hora'])) {
            echo json_encode(["error" => "Horario ocupado"]);
            return;
        }

        $ok = $this->model->crear($data);

        echo json_encode([
            "success" => $ok ? true : false
        ]);
    }
}