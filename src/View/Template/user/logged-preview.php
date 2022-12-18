
<?php

require_once __DIR__.'/../../../Model/userModel.php';

if ( session_status() == PHP_SESSION_ACTIVE ) {
    $user = new User($_SESSION['userId'], $_SESSION['userName'], $_SESSION['userEmail'], $_SESSION['userPassword'], $_SESSION['userDate']);
    require __DIR__.'/preview.php';
}

?>