<?php

require_once(__DIR__.'/repository.php');

class User {
    public int $id;
    public string $username;
    public string $email;
    public string $password;

    public function __construct(int $id, string $username, string $email, string $password) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}

class UserRepository extends Repository{

    public function login(string $identifier, string $password) : ?User {
        return $this->getUserByIdentifierAndPassword( $identifier, hash("sha256", $password) );
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
        $sql = $this->connection->prepare( "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)" );
        $sql->execute( [
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ] );
    }

    public function getUserByUsernameOrEmail(string $username, string $email) : ?User {
        
        $sql = $this->connection->prepare("SELECT * FROM users WHERE (username = :username OR email = :email) ");
        $sql->execute( [
            'username' => $username,
            'email' => $email,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password']);
    }

    public function getUserById(int $id) : ?User {
        
        $sql = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $sql->execute( [
            'id' => $id,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password']);
    }

    public function getUserByIdentifierAndPassword(string $identifier, string $password) : ?User {

        $sql = $this->connection->prepare("SELECT * FROM users WHERE (username = :identifier OR email = :identifier) AND password = :password");
        $sql->execute( [
            'identifier' => $identifier,
            'password' => $password
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password']);
    }
}

?>