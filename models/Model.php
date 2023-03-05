<?php

namespace models;

use repositories\MainRepository;

class Model
{
    protected static ?Model $_instance = null;
    protected MainRepository $mainRepository;

    public static function getInstance(): Model
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->mainRepository = MainRepository::getInstance();
    }

    public function getInfo(string $str): string
    {
        if (is_null($this->mainRepository->getCompare($str))) return json_encode("Записей для email {$str} не обнаружено!");
        return json_encode($this->mainRepository->getCompare($str));
    }

    public function getInfoByClick(string $str): string
    {
        if (empty($this->mainRepository->getCompareKeydown($str))) return json_encode("Записей для email {$str} не обнаружено!");
        return json_encode($this->mainRepository->getCompareKeydown($str));
    }
}