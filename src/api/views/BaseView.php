<?php

namespace App\views;
class BaseView {
    public function renderJsonOrNotFound($data): void
    {
        if ($data === false) {
            $this->renderError(404, "Not found");
        } else {
            echo json_encode($data);
        }
    }

    public function renderError($code, $message): void
    {
        http_response_code($code);
        echo json_encode(['error' => $message]);
    }
}