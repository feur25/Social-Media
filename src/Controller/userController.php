<?php

session_start();

require_once(__DIR__.'/../Model/userModel.php');

class UserController extends UserRepository {

    public function login(string $identifier, string $password) : ?User {
        $get_user = $this->getUserByIdentifierAndPassword( $identifier, hash("sha256", $password) );
        $get_user->password = $password;
        return $get_user;
    }

    public function register(string $username, string $email, string $password) : bool {
        $user = $this->getUserByUsernameOrEmail($username, $email);

        if($user == null) {
            $this->insertUser($username, $email, hash("sha256", $password));
        }

        return $user == null; 
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

    private function try_register() : string {

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

	public function login_page(){

        if ( isset($_GET) ) {

            if ( isset($_GET['id']) && isset($_GET['password']) ) {
                
                $loggedUser = $this->login( $_GET['id'], $_GET['password'] );

                if ($loggedUser != null) {
                    if (session_status() == PHP_SESSION_ACTIVE)
                        session_destroy();

                    session_start();
                    $_SESSION['userId'] = $loggedUser->id;
                    $_SESSION['userName'] = $loggedUser->username;
                    $_SESSION['userEmail'] = $loggedUser->email;
                    $_SESSION['userPassword'] = $loggedUser->password;
                    $_SESSION['userKey'] = $loggedUser->publicKey;
                    $_SESSION['userDate'] = $loggedUser->date;

                    header('Location: /');
                } else {
                    $error_message = "Mot de Passe ou Identifiant incorrect";
                }
            }
        }

		require(__DIR__.'/../View/login.php');
	}

	public function logout_page(){

        session_destroy();
        
        header('Location: /');
	}

	public function register_page(){

        if ( isset($_POST) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) ) {

            $error_message = $this->try_register();
            
        }

		require(__DIR__.'/../View/register.php');

	}
}

?>