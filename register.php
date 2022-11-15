<?php

require_once __DIR__.'/src/Controller/registerController.php';

$controller = new RegisterController();
$controller->index();

// class Register extends Repository{

//     public function email(string $email): boolean {
//         return filter_var($email, FILTER_VALIDATE_EMAIL);
//     }
    
//     public function checkPassword(string $password) : boolean{
//         $uperCase = "/[A-Z]/i";
//         $lowerCase = "/[a-z]/i";
//         $special = "/&=€%µ!@?:.#|_-'`/i";
//         if(!preg_match($uperCase, $password) && !preg_match($lowerCase, $password) && !preg_match($special, $password)){
//             return false;
//         }
//         return true;
//     }
    
    // public function createNewUser(string $username, string $email, string $password){
    //     if( !empty($username) && !empty($email) && !empty($password) ) {
    //         if( email($email) && checkPassword($password)) {
    //             $sql = $this->connection->prepare( "INSERT INTO users (username, email, password) VALUES (:username , :email , :password)" );
    //             $sql->execute( [
    //                 'username' => $username,
    //                 'email' => $email,
    //                 'password' => hash('sha256',$password)
    //             ] );
    //         }
    //         return;
    //     }
    //     echo "<h1>Il manque un champ a remplire salope d'axel </h1>";
    // }
    
    // public function deleteUser(int $userId){
    //     $sql = $this->connection->prepare("DELETE INTO users WHERE id = :id");
    //     $sql->execute([
    //         'id'=> $userId
    //     ]);
    // }
// }
    
?>