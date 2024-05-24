<?php
namespace App\controllers;

use App\views\RentsView;
use App\models\RentsModel;

class RentsController extends BaseController {
    protected RentsModel $model;

    public function __construct()
    {
        parent::__construct(new RentsView());
        $this->model = new RentsModel();
    }
    public function index()
    {
        $data = $this->model->getAll();

        $this->view->renderList($data);
    }

    public function create($params = [], $data = []) {
        $this->model->create($data);
        $this->view->renderItem($data);
    }
}