<?php

class ModifyController {

	public static function changePassword(){
        ob_start();
        require __DIR__.'/../View/Template/modifyAccount/changePassword.php';
        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
	}
    public static function forgetPassword(){
        ob_start();
        require __DIR__.'/../View/Template/modifyAccount/forgetPassword.php';
        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
    }
    public static function getCodePin(){
        //a mofier pour page code pin valentin
        ob_start();
        require __DIR__.'/../View/Template/modifyAccount/changePassword.php';
        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
    }
    
}

?>