<?php

namespace controllers;

use core\View;
use models\Model;

class Controller
{
    protected View $view;
    protected Model $model;
    protected static ?Controller $_instance = null;

    public static function getInstance(): Controller
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->view = new View();
        $this->model = Model::getInstance();
    }

    public function showMainPage(): void
    {
        $this->view->mainPage();
    }

    public function getInfo(): void
    {
        print_r($this->model->getInfo($_POST['value']));
    }

    public function getInfoByClick(): void
    {
        print_r($this->model->getInfoByClick($_POST['value']));
    }
}