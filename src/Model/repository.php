<?php

class Repository {

    public PDO $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:dbname=social-media;host=localhost", "root", "");
    }

}

?>