<?php
namespace App\views;

class RentsView extends BaseView {
    public function renderList(array $data)
    {
        $this->renderJsonOrNotFound($data);
    }

    public function renderItem(array $data)
    {
        $this->renderJsonOrNotFound($data);
    }
}