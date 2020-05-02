<?php

namespace Aurore\Model;

abstract class Manager
{
    protected function dbConnect()
    {
        $host = 'localhost';
        $port = '8889';
        $dbname = 'aurore';
        $username = 'dbuser';
        $password = '';

        $db = new \PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset=utf8', $username, $password);
        return $db;
    }
}