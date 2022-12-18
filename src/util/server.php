<?php 
$host = "127.0.0.1";
$port = 8080;
set_time_limit(0);
//crée le socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
//lie le socket a la bonne url ex : 127.0.0.1:8080
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
//Attend une connexion sur un socket, 3 = le nombre de demmandes en attentes si bessoin doc : https://www.php.net/manual/fr/function.socket-listen.php
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");
//accept les connections entrante
$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
//lie l'entrer du client 1024 == taille de l'entrer (max)
$input = socket_read($spawn, 1024) or die("Could not read input\n");
//nettoi la chaine d'entrée
$input = trim($input);

echo "Client Message : ". $input;
//inverser l'entrée du client et renvoyer 
$output = strrev($input) . "\n";

socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
//ferme le socket
socket_close($spawn);
socket_close($socket);

?>