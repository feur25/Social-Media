<?php


require_once __DIR__.'/src/Controller/homeController.php';
// include_once(__DIR__. "/util/server.php");
// include_once(__DIR__. "/util/client.php");

$controller = new HomeController();
$controller->index();


?>