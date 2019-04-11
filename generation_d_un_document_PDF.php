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
    require_once("librairie_des_fonctions_importantes/fonctions_de_validation_des_donnees_du_formulaire.php");

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
            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = htmlspecialchars($_POST['nom_de_famille_du_locataire']);

            //
            $prenom_du_locataire = htmlspecialchars($_POST['prenom_du_locataire']);

            //
            $adresse_d_habitation_du_locataire = htmlspecialchars($_POST['adresse_postale_de_residence_du_locataire']);

            //
            $date_de_naissance_du_locataire = htmlspecialchars($_POST['date_de_naissance_du_locataire']);

            //
            $adresse_email_du_locataire = htmlspecialchars($_POST['adresse_email_du_locataire']);

            //
            $numero_du_studio_pour_le_locataire = htmlspecialchars($_POST['numero_du_studio_pour_a_choisir_pour_location']);

            //
            $numero_de_telephone_du_locataire = htmlspecialchars($_POST['numero_de_telephone_du_locataire']);

            //
            $type_de_public_choisi_pour_le_locataire = htmlspecialchars($_POST['type_de_public_choisi']);

            //
            $type_de_contrat_choisi_pour_le_locataire = htmlspecialchars($_POST['type_de_contrat_choisi']);

            //
            $ensemble_des_conditions_choisi_pour_le_contrat_du_locataire = htmlspecialchars($_POST['ensemble_des_conditions_du_contrat_de_location']);

            //


            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                if(verification_de_la_validite_de_l_adresse($adresse_d_habitation_du_locataire))
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("nature_du_document_PDF_a_generer" => "Le contrat de location"));

                    //
                    $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                }
                else {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("inititule_de_l_erreur" => "L'adresse postale entrée est invalide",
                                        "description_de_l_erreur" => "L'adresse d'habitation du locataire ne doit contenir que des lettres, des chiffres, des espaces ou des tirets."));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }

            }
            else {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("inititule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets."));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");
            }
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