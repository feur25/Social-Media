<?php


require_once __DIR__.'/../Model/repository.php';

function generateKey() : string {
    $characters = '0CDK123EFGHIJ45789abcdef$("ghi`jklmnoABLMNO~[|PQRSWXY:/!%^*-+}=çè-)#&]@à£¤µùpqrstu6vwxyz§;.:?!<,TUV¨>';
    $randomString = '';
    
    for ($i = 0; $i <= 24; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

function encryptKey() : string {
    $encrypt = md5(generateKey());
    return $encrypt;
}
function createKeyUser() : string {
    $duplicate = new Duplicate();
    while(! $duplicate->verifyPublicKey()){
        encryptKey();
    }
    return encryptKey();
}
class Duplicate extends Repository {
    public function verifyPublicKey() : bool{
        $checkOut = $this->connection->prepare("SELECT public_key, COUNT(public_key)
        FROM users
        GROUP BY public_key
        HAVING COUNT(public_key) > 1");
        $checkOut->execute();
        if ($checkOut->rowCount() > 1){
            return false;
        }
        return true;
    } 
}


?>