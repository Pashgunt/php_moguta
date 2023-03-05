<?php

namespace repositories;

use enums\Enums;

class MainRepository
{
    protected static ?MainRepository $_instance = null;
    protected Enums $enums;
    protected \mysqli $conn;

    public static function getInstance(): MainRepository
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->enums = new Enums();
        $this->conn = new \mysqli(
            $this->enums::HOSTNAME,
            $this->enums::USERNAME,
            $this->enums::PASSWORD,
            $this->enums::DATABASE
        );
    }

    public function __dispatch()
    {
        mysqli_close($this->conn);
    }

    public function getCompare(string $str): ?array
    {
        $res = $this->conn->query("select 
                                            user.id,
                                            user.email,
                                           Moguta.user_info.name,
                                           Moguta.user_info.sname
                                    FROM user
                                    inner join user_info  on user.id = user_info.user_id
                                    where user.email = '{$str}';");
        return $res->fetch_assoc();
    }

    public function getCompareKeydown(string $str): ?array
    {
        $arr = [];
        $res = $this->conn->query("select 
                                            user.id,
                                            user.email,
                                           Moguta.user_info.name,
                                           Moguta.user_info.sname
                                    FROM user
                                    inner join user_info  on user.id = user_info.user_id
                                    where user.email LIKE '%{$str}%';");
        while ($row = $res->fetch_assoc()) $arr[] = $row;
        return $arr;
    }
}