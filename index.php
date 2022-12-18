<?php


require_once __DIR__.'/src/Controller/homeController.php';
// include_once(__DIR__. "/util/server.php");
// include_once(__DIR__. "/util/client.php");


HomeController::index();


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.4/socket.io.min.js" integrity="sha512-HTENHrkQ/P0NGDFd5nk6ibVtCkcM7jhr2c7GyvXp5O+4X6O5cQO9AhqFzM+MdeBivsX7Hoys2J7pp2wdgMpCvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>