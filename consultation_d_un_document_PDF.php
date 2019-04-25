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
        elseif($_GET['type_de_document'] == 'preavis')
        {

            //
            require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

            //
            $chemin_d_accee_du_fichier_PDF_selectionne = $_GET['preavis_choisi'];

            echo $chemin_d_accee_du_fichier_PDF_selectionne;

            //
            $corps_et_pied_de_la_page_HTML = "<body>
                <div id='conteneur_de_la_balise_d_affichage'>
                    <object id='balise_d_affichage' data='" . $chemin_d_accee_du_fichier_PDF_selectionne . "'></object>
                </div>
            </body>";

            //
            echo $corps_et_pied_de_la_page_HTML;

        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'attestation')
        {

            //
            require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

            //
            $chemin_d_accee_du_fichier_PDF_selectionne = $_GET['attestation_choisie'];

            //
            $corps_et_pied_de_la_page_HTML = "<body>
                <div id='conteneur_de_la_balise_d_affichage'>
                    <object id='balise_d_affichage' data='" . $chemin_d_accee_du_fichier_PDF_selectionne . "'></object>
                </div>
            </body>";

            //
            echo $corps_et_pied_de_la_page_HTML;

        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'expiration_de_contrat_de_location')
        {

            //
            require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

            //
            $chemin_d_accee_du_fichier_PDF_selectionne = $_GET['expiration_de_contrat_de_location_choisie'];

            //
            $corps_et_pied_de_la_page_HTML = "<body>
                <div id='conteneur_de_la_balise_d_affichage'>
                    <object id='balise_d_affichage' data='" . $chemin_d_accee_du_fichier_PDF_selectionne . "'></object>
                </div>
            </body>";

            //
            echo $corps_et_pied_de_la_page_HTML;

        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'relance_loyer_impaye')
        {

            //
            require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

            //
            $chemin_d_accee_du_fichier_PDF_selectionne = $_GET['relance_d_impaye_choisie'];

            //
            $corps_et_pied_de_la_page_HTML = "<body>
                <div id='conteneur_de_la_balise_d_affichage'>
                    <object id='balise_d_affichage' data='" . $chemin_d_accee_du_fichier_PDF_selectionne . "'></object>
                </div>
            </body>";

            //
            echo $corps_et_pied_de_la_page_HTML;

        }
        //Sinon si,
        elseif($_GET['type_de_document'] == 'etat_des_lieux')
        {

            //
            require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

            //
            $chemin_d_accee_du_fichier_PDF_selectionne = $_GET['etat_des_lieux_choisi'];

            //
            $corps_et_pied_de_la_page_HTML = "<body>
                <div id='conteneur_de_la_balise_d_affichage'>
                    <object id='balise_d_affichage' data='" . $chemin_d_accee_du_fichier_PDF_selectionne . "'></object>
                </div>
            </body>";

            //
            echo $corps_et_pied_de_la_page_HTML;

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