<?php 
require __DIR__. '/vendor/autoload.php';

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;

$client = new Client(new Version1X('//127.0.0.1:1337'));

$client->initialize();
// send message to connected clients
$client->emit('broadcast', ['type' => 'notification', 'text' => 'Hello There!']);
$client->close();
?>