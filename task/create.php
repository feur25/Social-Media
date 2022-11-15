<?php

require(__DIR__.'/../src/Controller/taskController.php');

if (isset($_GET)) {
    if ( isset($_GET['description']) && $_GET['description'] !== '' && isset($_GET['priority']) && $_GET['priority'] !== '') {
        $taskController = new TaskController();
        $taskController->createTask($_GET['description'], $_GET['priority']);
    }
}

$callbackLocation = "/";
if (isset($_GET['callback'])) {
    $callbackLocation = $_GET['callback'];
}
header('Location: '.$callbackLocation);

?>