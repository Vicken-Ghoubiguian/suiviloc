<?php

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //
    require_once("classes_du_modele/Contrat.php");

    //
    require_once("classes_du_modele/Garant.php");

    //
    require_once("classes_du_modele/Locataire.php");

    //
    require_once("classes_du_modele/Studio.php");

    //
    require_once("PHPMailer/src/PHPMailer.php");

    //
    require_once("PHPMailer/src/SMTP.php");

    //
    require_once("PHPMailer/src/Exception.php");

    //
    require_once("smarty/libs/Smarty.class.php");

    //
    require_once("dompdf/autoload.inc.php");

    //
    use Dompdf\Dompdf;

    //
    session_start();

    //
    if($_POST['soumission_du_formulaire_de_generation_de_PDF'])
    {

        //
        if($_POST['type_de_document'] == 'contrat_de_location')
        {



        }
        //Sinon...
        else
        {

        }

    }
    //
    else
    {

        //
        header("Location: index.php");
        exit;

    }