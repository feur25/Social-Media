<?php

function translate(string $untranslated) : string {
    switch ($untranslated) {
        case 'login':
            return 'Se Connecter';
        case 'logout':
            return 'Se Déconnecter';
        default:
            return $untranslated;
    }
}

?>