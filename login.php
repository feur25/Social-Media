<?php

require_once __DIR__.'/src/Controller/userController.php';

$controller = new UserController();
$controller->login_page();

?>