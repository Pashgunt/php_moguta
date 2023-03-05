<?php

namespace core;

class View
{
    public function mainPage()
    {
        return include __DIR__ . "/../views/main.php";
    }
}