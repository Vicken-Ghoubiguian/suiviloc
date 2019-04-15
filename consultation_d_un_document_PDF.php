<?php

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //
    require_once("librairie_des_fonctions_importantes/fonctions_de_validation_des_donnees_du_formulaire.php");

    //
    require_once("smarty/libs/Smarty.class.php");

    //
    session_start();

    //
    if($_GET['soumission_du_formulaire_de_consultation_de_PDF'])
    {

        //
        if($_GET['type_de_document'] == 'contrat_de_location')
        {


        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'attestation')
        {


        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'expiration_de_contrat_de_location')
        {


        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'relance_loyer_impaye')
        {


        }
        //Sinon...
        else
        {
            //
            header("Location: index.php");
            exit;

        }

    }
    //Sinon...
    else
    {
        //
        header("Location: index.php");
        exit;

    }