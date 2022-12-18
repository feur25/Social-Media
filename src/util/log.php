<?php
function writeFile($taskName, $taskDescription){
    $tmpName = fopen("log.txt", "a");
    fwrite($tmpName, "Nom de la l'action : [" . $taskName . "] - " . "Description de l'action : [" . $taskDescription . "]" . PHP_EOL);
    fclose($tmpName);
}

?>