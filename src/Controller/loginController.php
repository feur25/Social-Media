<?php

require_once(__DIR__.'/../Model/userModel.php');

class LoginController {

    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

	public function index(){

        if ( isset($_GET) ) {

            if ( isset($_GET['id']) && isset($_GET['password']) ) {
                
                $loggedUser = $this->userRepository->login( $_GET['id'], $_GET['password'] );

                if ($loggedUser != null) {
                    $_SESSION['user'] = $loggedUser;
                    $_COOKIE['user'] = $loggedUser;
                    header('Location: /');
                } else {
                    $error_message = "Mot de Passe ou Identifiant incorrect";
                }
            }
        }

		require(__DIR__.'/../View/login.php');
	}
}

?>