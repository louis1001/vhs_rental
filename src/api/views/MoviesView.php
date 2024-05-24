<?php
namespace App\views;

class MoviesView extends BaseView {
    public function renderList($data)
    {
        // This is the listing of all the topicos
        $this->renderJsonOrNotFound($data);
    }

    public function renderItem($data)
    {
        // This is one item
        $this->renderJsonOrNotFound($data);
    }
}