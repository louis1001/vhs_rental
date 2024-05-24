<?php
namespace App\controllers;

use App\models\TopicosModel;
use App\views\TopicosView;

class TopicosController extends BaseController {
    protected TopicosModel $model;

    public function __construct() {
        parent::__construct(new TopicosView());
        $this->model = new TopicosModel();
    }

    public function index($params = []) {
        $data = $this->model->getAll();

        $this->view->renderList($data);
    }

    public function getTopico($params = []) {
        $id = array_pop($params);
        $data = $this->model->get($id);

        $this->view->renderItem($data);
    }
}
?>