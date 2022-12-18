<?php

require_once __DIR__.'/src/Controller/modifyController.php';

if (isset($_GET["modifyPassword"])){
    ModifyController::changePassword();
}

if (isset($_GET['forgetPassword'])){
    ModifyController::forgetPassword();
}

// if (isset($_GET['pin'])){
//     ModifyController::getCodePin();
// }
 
    
?>