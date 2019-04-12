<?php

    //
    session_start();

    //Si une session existe (en d'autres termes, si un utilisateur est bien authentifié sur l'application)
    if( isset($_SESSION) && !empty($_SESSION))
    {

        //L'utilisateur est redirigé vers la page de gestion locative (intranet.php)
        header("Location: accueil.php");
        exit;

    }
    //Sinon...
    else
    {

        //L'utilisateur est redirigé vers la page d'authentification (authentification.php)
        header("Location: authentification.php");
        exit;

    }

?>