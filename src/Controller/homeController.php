<?php

session_start();

class HomeController {

	public function index(){
		require(__DIR__.'/../View/home.php');
	}
}

?>