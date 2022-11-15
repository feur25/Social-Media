<?php

require_once(__DIR__.'/../Model/userModel.php');

class RegisterController {

    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function emailCheck(string $email): bool {
        return $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public function passwordCheck(string $password) : bool{
        $upperCase = '/[A-Z]/';
        $lowerCase = '/[a-z]/';
        $special = '/[\/\'^£$%&*()}{@#~?><>,|=_+¬-]/';

        return preg_match($upperCase, $password) && preg_match($lowerCase, $password) && preg_match($special, $password);
    }

    private function try_add_user() : string {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password-confirm'];

        if ( !$this->emailCheck($email) ) {
            return "Email is not valid";
        }

        if ( $username == "" ) {
            return "Username is empty";
        }

        if ( !$this->passwordCheck($password) ) {
            return "Password must contain at least one uppercase letter, one lowercase letter and one special character";
        }

        if ( $password != $passwordConfirm ) {
            return "Password and Confirmation Password must match";
        }

        if ( !$this->userRepository->register($username, $email, $password) ) {
            return "The Username or Email is already in use";
        }
        
        header('Location: /login');
        return "";
    }

	public function index(){

        if ( isset($_POST) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) ) {

            $error_message = $this->try_add_user();
            
        }

		require(__DIR__.'/../View/register.php');

	}
}

?>