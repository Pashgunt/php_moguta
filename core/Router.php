ssss<?php

namespace core;

use controllers\Controller;

class Router
{
    protected static ?Router $_instance = null;
    protected Controller $controller;

    function __construct()
    {
        $this->controller = Controller::getInstance();
        $this->run();
    }

    /**
     * Принцип singleton
     * Суть такая, что если объект уже существует при повторном его вызове не будет
     * создаваться новый объект, а будет работа с тем же
     */
    public static function getInstance(): Router
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function run(): void
    {
        switch ($_SERVER['REQUEST_URI']) {
            case "/":
                $this->controller->showMainPage();
                break;
            case "/api/info/get":
                $this->controller->getInfo();
                break;
            case "/api/info/get-key":
                $this->controller->getInfoByClick();
                break;
        }
    }

}