<?php

class Repository {

    private static PDO $connection;

    public static function getPDO(): PDO {
        if (!isset(self::$connection)) {
            self::$connection = new PDO("mysql:dbname=social-media;host=localhost", "root", "");
        }
        return self::$connection;
    }

}

?>