<?php


function translate(string $untranslated) : string {

    $englishTranslations = [
        "identifier" => "Email or Username",
        "login" => "Login",
        "logout" => "Logout",
        "register" => "Register",
        "username" => "Username",
        "email" => "Email Address",
        "password" => "Password",
        "confirm_password" => "Confirm Password",
        "cancel" => "Cancel",
        "confirm" => "Confirm",
        "remember_me" => "Remember Me",
        "title" => "Title",
        "content" => "Content",
        "friend" => "Friend",
        "friends" => "Friends",
        "sent_requests" => "Sent Requests",
        "received_requests" => "Received Requests",
        "messages" => "Messages",
    ];
    
    $frenchTranslations = [
        "identifier" => "Courriel ou Nom d'utilisateur",
        "login" => "Se Connecter",
        "logout" => "Se Déconnecter",
        "register" => "S'inscrire",
        "username" => "Nom d'utilisateur",
        "email" => "Adresse Email",
        "password" => "Mot de Passe",
        "confirm_password" => "Confirmer le Mot de Passe",
        "cancel" => "Annuler",
        "confirm" => "Confirmer",
        "remember_me" => "Se Souvenir de Moi",
        "title" => "Titre",
        "content" => "Contenu",
        "friend" => "Ami",
        "friends" => "Amis",
        "sent_requests" => "Demandes Envoyées",
        "received_requests" => "Demandes Reçues",
        "messages" => "Messages",
    ];
    
    $spanishTranslations = [
        "identifier" => "Correo Electrónico o Nombre de Usuario",
        "login" => "Iniciar Sesión",
        "logout" => "Cerrar Sesión",
        "register" => "Registrarse",
        "username" => "Nombre de Usuario",
        "email" => "Dirección de Correo Electrónico",
        "password" => "Contraseña",
        "confirm_password" => "Confirmar Contraseña",
        "cancel" => "Cancelar",
        "confirm" => "Confirmar",
        "remember_me" => "Recordarme",
        "title" => "Título",
        "content" => "Contenido",
        "friend" => "Amigo",
        "friends" => "Amigos",
        "sent_requests" => "Solicitudes Enviadas",
        "received_requests" => "Solicitudes Recibidas",
        "messages" => "Mensajes",
    ];

    $_COOKIE['language'] = "english";

    if (!isset($_COOKIE['language'])) {
        $_COOKIE['language'] = "english";
    }

    switch ($_COOKIE['language']) {
        case "english":
            return $englishTranslations[$untranslated];
        case "french":
            return $frenchTranslations[$untranslated];
        case "spanish":
            return $spanishTranslations[$untranslated];
    }

}

?>