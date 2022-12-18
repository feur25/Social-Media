<?php

class HomeController {

	public static function index(){

		ob_start();

		require __DIR__.'/../View/home.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
	}
}

?>