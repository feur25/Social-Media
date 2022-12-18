<?php


function translate(string $untranslated) : string {

    $englishTranslations = [
        
        "cancel" => "Cancel",
        "confirm" => "Confirm",
        "delete" => "Delete",
        "edit" => "Edit",

        "create_account" => "Create Account",
        "modify_password" => "Modify Password",
        "forgot_password" => "Forgot Password",
        "login_to_respond" => "Login to respond",

        "identifier" => "Email or Username",
        "login" => "Login",
        "logout" => "Logout",
        "register" => "Register",
        "old_password" => "Old Password",
        "new_password" => "New Password",
        "confirm_password" => "Confirm Password",
        "remember_me" => "Remember Me",

        "username" => "Username",
        "email" => "Email Address",
        "password" => "Password",
        "joined_on" => "Joined on",
        "topics_by" => "Posts from this user",

        "title" => "Title",
        "content" => "Content",

        "friend" => "Friend",
        "friends" => "Friends",
        "sent_requests" => "Sent Requests",
        "received_requests" => "Received Requests",
        "accept_request" => "Accept Request",
        "decline_request" => "Decline Request",
        "messages" => "Messages",
    ];
    
    $frenchTranslations = [

        "cancel" => "Annuler",
        "confirm" => "Confirmer",
        "delete" => "Supprimer",
        "edit" => "Modifier",
        
        "create_account" => "Crée un compte",
        "modify_password" => "Modifier le mot de passe",
        "forgot_password" => "J'ai oublié mon mot de passe",
        "login_to_respond" => "Connectez-vous pour répondre",

        "identifier" => "Courriel ou Nom d'utilisateur",
        "login" => "Se Connecter",
        "logout" => "Se Déconnecter",
        "register" => "S'inscrire",
        "old_password" => "Actua",
        "new_password" => "",
        "confirm_password" => "Confirmer le Mot de Passe",
        "remember_me" => "Se Souvenir de Moi",

        "username" => "Nom d'utilisateur",
        "email" => "Adresse Email",
        "password" => "Mot de Passe",
        "joined_on" => "Rejoint le",
        "topics_by" => "Messages de cet utilisateur",

        "title" => "Titre",
        "content" => "Contenu",

        "friend" => "Ami",
        "friends" => "Amis",
        "sent_requests" => "Demandes Envoyées",
        "received_requests" => "Demandes Reçues",
        "accept_request" => "Accepter la Demande",
        "decline_request" => "Refuser la Demande",
        "messages" => "Messages",
    ];
    
    $spanishTranslations = [

        "cancel" => "Cancelar",
        "confirm" => "Confirmar",
        "delete" => "Eliminar",
        "edit" => "Editar",

        "create_account" => "Crear una cuenta",
        "modify_password" => "Modificar la contraseña",
        "forgot_password" => "Olvidé mi contraseña",
        "login_to_respond" => "Inicie sesión para responder",

        "identifier" => "Correo Electrónico o Nombre de Usuario",
        "login" => "Iniciar Sesión",
        "logout" => "Cerrar Sesión",
        "register" => "Registrarse",
        "confirm_password" => "Confirmar Contraseña",
        "remember_me" => "Recordarme",
        
        "username" => "Nombre de Usuario",
        "email" => "Dirección de Correo Electrónico",
        "password" => "Contraseña",
        "topics_by" => "Mensajes de este usuario",
        "new_password" => "TG",

        "title" => "Título",
        "content" => "Contenido",

        "friend" => "Amigo",
        "friends" => "Amigos",
        "sent_requests" => "Solicitudes Enviadas",
        "received_requests" => "Solicitudes Recibidas",
        "accept_request" => "Aceptar la Solicitud",
        "decline_request" => "Rechazar la Solicitud",
        "messages" => "Mensajes",
        "joined_on" => "Se unió el",
    ];

    if (!isset($_COOKIE['language'])) {
        $_COOKIE['language'] = "english";
    }

    switch ($_COOKIE['language']) {
        default:
            $dictionary = $englishTranslations;
            break;
        case "french":
            $dictionary = $frenchTranslations;
            break;
        case "spanish":
            $dictionary = $spanishTranslations;
            break;
    }

    if ( !isset($dictionary[$untranslated]) )
        return "TRANSLATION ERROR";
    return $dictionary[$untranslated];

}

?>