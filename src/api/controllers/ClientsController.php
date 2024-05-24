<?php

namespace App\controllers;

use App\models\ClientsModel;
use App\views\ClientsView;

class ClientsController extends BaseController
{
    protected ClientsModel $model;

    public function __construct()
    {
        parent::__construct(new ClientsView());
        $this->model = new ClientsModel();
    }

    public function index($params = [])
    {
        $data = $this->model->getAll();

        $this->view->renderList($data);
    }

    public function getClient($params = [])
    {
        $id = array_pop($params);
        $data = $this->model->get($id);
        if ($data !== false) {
            $this->view->renderItem($data);
        } else {
            $this->view->renderError(404, 'Not found');
        }
    }

    public function updateClient($params = [], $data = [])
    {
        $id = array_pop($params);
        $this->model->update($id, $data);

        $this->view->renderItem($data);
    }

    public function createClient($params = [], $data = [])
    {
        $this->model->create($data);

        $this->view->renderItem(['message' => 'Client created']);
    }

    public function deleteClient($params = [])
    {
        $id = array_pop($params);
        $this->model->delete($id);

        $this->view->renderItem(['message' => 'Client deleted']);
    }
}