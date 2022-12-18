<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/../util/encrypt.php';
require_once __DIR__.'/../util/mailSender.php';

class User {
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public string $profileUrl;
    public string $publicKey;
    public string $date;

    public function __construct(int $id, string $username, string $email, string $password, string $pictureUrl, string $publicKey, string $date = "") {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->profileUrl = $pictureUrl;
        $this->publicKey = $publicKey;
        $this->date = $date;
    }
}

class UserRepository {

    public static function insertUser(string $username, string $email, string $password) {
        $sql = Repository::getPDO()->prepare( "INSERT INTO user (username, email, password, profile_url, public_key) VALUES (:username, :email, :password, :profile, :key)" );
        $sql->execute( [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'profile' => "https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-Image.png",
            'key' => createKeyUser()
        ] );
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
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['profile_url'], $array['public_key'], $array['register_date']);
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
        return new User($array['id'], $array['username'], $array['email'], $array['password'] , $array['profile_url'], $array['public_key'], $array['register_date']);
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
            return new User($array['id'], $array['username'], $array['email'], $array['password'] , $array['profile_url'], $array['public_key'], $array['register_date']);
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
        return new User($array['id'], $array['username'], $array['email'], $array['password'] , $array['profile_url'], $array['public_key'], $array['register_date']);
    }
}

?>