<?php

session_start();

require_once __DIR__.'/../Model/userModel.php';

class UserController {

    public static function login(string $identifier, string $password) : ?User {
        $get_user = UserRepository::getUserByIdentifierAndPassword( $identifier, hash("sha256", $password) );
        $get_user->password = $password;
        return $get_user;
    }

    public static function register(string $username, string $email, string $password) : bool {
        $user = UserRepository::getUserByUsernameOrEmail($username, $email);

        if($user == null) {
            UserRepository::insertUser($username, $email, hash("sha256", $password));
        }

        return $user == null; 
    }


    public static function emailCheck(string $email): bool {
        return $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public static function passwordCheck(string $password) : bool{
        $upperCase = '/[A-Z]/';
        $lowerCase = '/[a-z]/';
        $special = '/[\/\'^£$%&*()}{@#~?><>,|=_+¬-]/';

        return preg_match($upperCase, $password) && preg_match($lowerCase, $password) && preg_match($special, $password);
    }

    private static function try_register() : string {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password-confirm'];

        if ( !UserController::emailCheck($email) ) {
            return "Email is not valid";
        }

        if ( $username == "" ) {
            return "Username is empty";
        }

        if ( !UserController::passwordCheck($password) ) {
            return "Password must contain at least one uppercase letter, one lowercase letter and one special character";
        }

        if ( $password != $passwordConfirm ) {
            return "Password and Confirmation Password must match";
        }

        if ( !UserController::register($username, $email, $password) ) {
            return "The Username or Email is already in use";
        }
        
        header('Location: /login');
        return "";
    }

    public static function index() {

        if ( isset($_GET['id']) ) {
            $user = UserRepository::getUserById($_GET['id']);
        } else if ( isset($_SESSION) && isset($_SESSION['userId']) ) {
            $user = UserRepository::getUserById($_SESSION['userId']);
        } else {
            header('Location: /login');
            return;
        }


        ob_start();

        require __DIR__.'/../View/user.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
    }

	public static function login_page(){

        if ( isset($_GET) ) {
            
            if ( isset($_GET['id']) && isset($_GET['password']) ) {

                $loggedUser = UserController::login( $_GET['id'], $_GET['password'] );

                if ($loggedUser != null) {
                    if (session_status() == PHP_SESSION_ACTIVE){
                        session_destroy();
                    }

                    session_start();
                    $_SESSION['userId'] = $loggedUser->id;
                    $_SESSION['userName'] = $loggedUser->username;
                    $_SESSION['userEmail'] = $loggedUser->email;
                    $_SESSION['userPassword'] = $loggedUser->password;
                    $_SESSION['userProfile'] = $loggedUser->profileUrl;
                    $_SESSION['userKey'] = $loggedUser->publicKey;
                    $_SESSION['userDate'] = $loggedUser->date;

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    $error_message = "Mot de Passe ou Identifiant incorrect";
                }
            }
        }


        ob_start();

		require __DIR__.'/../View/login.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
	}

	public static function logout_page(){

        session_destroy();
        
        header('Location: /');
	}

	public static function register_page(){

        if ( isset($_POST) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) ) {

            $error_message = UserController::try_register();
            
        }


        ob_start();

		require __DIR__.'/../View/register.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';

	}
}

?>