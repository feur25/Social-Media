<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/../util/encrypt.php';
require_once __DIR__.'/../util/mailSender.php';
require_once __DIR__ . '/../util/log.php' ;

class User {
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public string $date;

    public function __construct(int $id, string $username, string $email, string $password, string $date = "") {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->date = $date;
    }
}

class UserRepository {

    public static function updateProfilePic(int $id, array $pictureFile) {
        $file_path = __DIR__.'/../../public/images/user/'.$id.'/';

        if( isset( $pictureFile ) ){

            if (!is_dir($file_path)) {
                mkdir($file_path);
            }

            // Move the file and convert it to jpg if needed
            switch ($pictureFile['type']) {
                case 'image/jpeg':
                    $tmpName = $pictureFile['tmp_name'];
                    $image = imagecreatefrompng($tmpName);
                    imagepng($image, $file_path.'profile.png', 100);
                    imagedestroy($image);
                    break;
                case 'image/gif':
                    // Convert gif to jpg
                    $tmpName = $pictureFile['tmp_name'];
                    $image = imagecreatefromgif($tmpName);
                    imagepng($image, $file_path.'profile.png', 100);
                    imagedestroy($image);
                    break;
                case 'image/webp':
                    // Convert webp to jpg
                    $tmpName = $pictureFile['tmp_name'];
                    $image = imagecreatefromwebp($tmpName);
                    imagepng($image, $file_path.'profile.png', 100);
                    imagedestroy($image);
                    break;
                default:
                    $tmpName = $pictureFile['tmp_name'];
                    move_uploaded_file($tmpName, $file_path.'profile.png');
                    break;
            }
        }
    }

    public static function getProfilePicURL(User $user) {
        $profileUrl = "/public/images/user/default.png";

        if ( is_file(__DIR__."/../../public/images/user/".$user->id."/profile.png") ) {
            $profileUrl = "/public/images/user/".$user->id."/profile.png";
        }
        return $profileUrl;
    }

    public static function insertUser(string $username, string $email, string $password, array $pictureFile) : User {
        $sql = Repository::getPDO()->prepare( "INSERT INTO user (username, email, password, public_key) VALUES (:username, :email, :password, :key)" );
        $sql->execute( [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'key' => createKeyUser()
        ] );


        $sql = Repository::getPDO()->query("SELECT last_insert_id();");
        $id = intval($sql->fetchColumn());
        writeFile(__FUNCTION__, "L'utilisateur " . $id . " vient d'être créé avec le nom d'Utilisateur " . $username . ".");
        UserRepository::updateProfilePic($id, $pictureFile);
        return UserRepository::getUserById($id);
    }

    public static function editUser(int $id, string $username, string $email, string $password, array $pictureFile) : User {
        $sql = Repository::getPDO()->prepare( "UPDATE user SET username = :username, email = :email, password = :password WHERE id = :id" );
        $sql->execute( [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ] );

        UserRepository::updateProfilePic($id, $pictureFile);
        return UserRepository::getUserById($id);
    }

    public static function getUserByUsernameOrEmail(string $username, string $email) : ?User {
        
        $sql = Repository::getPDO()->prepare("SELECT * FROM user WHERE (username = :username OR email = :email) ");
        $sql->execute( [
            'username' => $username,
            'email' => $email,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['register_date']);
    }

    public static function getUser(int $nameFriend) : array{
        $sql = Repository::getPDO()->prepare("SELECT username FROM user WHERE id = :id");
        $sql->execute( [
            'id' => $nameFriend,
        ] );
    

        $array = $sql->fetchAll();
        $userArray = [];
        foreach($array as $arrayUser){
            $userArray[] = $arrayUser['username'];
        }
        if ($sql->rowCount() == 0) {
            $userArray[] = null;
        }
        return $userArray;
    }
    
    public static function getUserById(int $id) : ?User {
        
        $sql = Repository::getPDO()->prepare("SELECT * FROM user WHERE id = :id");
        $sql->execute( [
            'id' => $id,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['register_date']);
    }

    public static function getUserByIdentifier(string $identifier) : ?User {
            $sql = Repository::getPDO()->prepare("SELECT * FROM user WHERE (username = :identifier OR email = :identifier)");
            $sql->execute( [
                'identifier' => $identifier,
            ] );
            
    
            if ($sql->rowCount() == 0) {
                return null;
            }
    
            $array = $sql->fetch();
            return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['register_date']);
    }

    public static function getUserByIdentifierAndPassword(string $identifier, string $password) : ?User {

        $sql = Repository::getPDO()->prepare("SELECT * FROM user WHERE (username = :identifier OR email = :identifier) AND password = :password");
        $sql->execute( [
            'identifier' => $identifier,
            'password' => $password
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['register_date']);
    }
}

?>