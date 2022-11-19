<?php

require_once(__DIR__.'/repository.php');
require_once(__DIR__.'/../../util/encrypt.php');

class User {
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public string $publicKey;
    public string $date;

    public function __construct(int $id, string $username, string $email, string $password, string $publicKey, string $date = "") {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->publicKey = $publicKey;
        $this->date = $date;
    }
}

class UserRepository extends Repository{

    public function login(string $identifier, string $password) : ?User {
        $get_user = $this->getUserByIdentifierAndPassword( $identifier, hash("sha256", $password) );
        $get_user->password = $password;
        return $get_user;
    }

    public function register(string $username, string $email, string $password) : bool {
        $user = $this->getUserByUsernameOrEmail($username, $email);

        if($user == null) {

            $this->insertUser($username, $email, hash("sha256", $password));
            return true; 

        } else {
            
            return false;
        }


    }


    public function insertUser(string $username, string $email, string $password) {
        $sql = $this->connection->prepare( "INSERT INTO user (username, email, password, public_key) VALUES (:username, :email, :password, :key)" );
        $sql->execute( [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'key' => createKeyUser()
        ] );
    }

    public function getUserByUsernameOrEmail(string $username, string $email) : ?User {
        
        $sql = $this->connection->prepare("SELECT * FROM user WHERE (username = :username OR email = :email) ");
        $sql->execute( [
            'username' => $username,
            'email' => $email,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['public_key'], $array['register_date']);
    }

    public function getUser(int $nameFriend) : array{
        $sql = $this->connection->prepare("SELECT username FROM user WHERE id = :id");
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
    
    public function getUserById(int $id) : ?User {
        
        $sql = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $sql->execute( [
            'id' => $id,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['public_key'], $array['register_date']);
    }

    public function getUserByIdentifierAndPassword(string $identifier, string $password) : ?User {

        $sql = $this->connection->prepare("SELECT * FROM user WHERE (username = :identifier OR email = :identifier) AND password = :password");
        $sql->execute( [
            'identifier' => $identifier,
            'password' => $password
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['public_key'], $array['register_date']);
    }
}

?>