<?php

namespace App\controllers;

use App\models\RentsModel;
use App\views\MoviesView;
use App\models\MoviesModel;

class MoviesController extends BaseController
{
    protected MoviesModel $model;

    public function __construct()
    {
        parent::__construct(new MoviesView());
        $this->model = new MoviesModel();
    }

    public function index()
    {
        $data = $this->model->getAll();

        $rentsModel = new RentsModel();

        foreach ($data as $key => $value) {
            $prestamos = $rentsModel->rentsForMovie($value['id']);
            $data[$key]['prestamos'] = $prestamos;
        }

        $this->view->renderList($data);
    }

    public function getMovie($params = [])
    {
        $id = array_pop($params);
        $data = $this->model->get($id);
        $rentsModel = new RentsModel();
        $prestamos = $rentsModel->rentsForMovie($id);

        $data['prestamos'] = $prestamos;

        $this->view->renderItem($data);
    }

    public function updateMovie($params = [], $data = [])
    {
        $id = array_pop($params);
        $this->model->update($id, $data);

        $this->view->renderItem($data);
    }

    public function createMovie($params = [], $data = [])
    {
        $id = array_pop($params);
        $this->model->create($data);

        $this->view->renderItem($data);
    }

    public function deleteMovie($params = [])
    {
        $id = array_pop($params);
        $this->model->delete($id);

        $this->view->renderItem($id);
    }
}