<?php
namespace  App\controllers;

use App\views\BaseView;

class BaseController {
    protected object $view;

    public function __construct($baseView) {
        $this->view = $baseView;
    }
}
?>