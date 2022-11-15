<?php

require(__DIR__.'/../src/Controller/taskController.php');

if (isset($_GET)) {
    if ($_GET['id'] !== '') {
        $taskController = new TaskController();
        $taskController->deleteTask($_GET['id']);
    }
}

$callbackLocation = "/";
if (isset($_GET['callback'])) {
    $callbackLocation = $_GET['callback'];
}
header('Location: '.$callbackLocation);

?>