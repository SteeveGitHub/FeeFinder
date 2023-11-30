<?php
require_once('model.php');

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        $content = $this->model->getContent();
        include 'view.php';
    }
}

$controller = new Controller();
$controller->invoke();
