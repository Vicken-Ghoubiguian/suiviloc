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
            $montant_de_la_location_pour_le_locataire = htmlspecialchars($_POST['montant_de_la_location']);

            //
            $montant_du_depot_de_garanti_pour_le_locataire = htmlspecialchars($_POST['montant_du_depot_de_garanti']);

            //
            $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire = htmlspecialchars($_POST['choix_d_encaissement_du_depot_de_garanti']);

            //
            $date_de_debut_du_contrat_pour_le_locataire = htmlspecialchars($_POST['date_de_debut_du_contrat_de_location']);

            //
            $date_de_fin_du_contrat_pour_le_locataire = htmlspecialchars($_POST['date_de_fin_du_contrat_de_location']);

            //
            $date_d_arrivee_du_locataire_dans_son_studio = htmlspecialchars($_POST['date_d_arrivee_du_locataire_dans_son_studio']);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                if(verification_de_la_validite_de_l_adresse($adresse_d_habitation_du_locataire))
                {

                    //
                    if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_de_naissance_du_locataire))
                    {

                        //
                        if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_de_naissance_du_locataire))
                        {

                            //
                            if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_de_debut_du_contrat_pour_le_locataire))
                            {

                                //
                                if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_de_debut_du_contrat_pour_le_locataire))
                                {

                                    //
                                    if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_d_arrivee_du_locataire_dans_son_studio))
                                    {

                                        //
                                        if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_d_arrivee_du_locataire_dans_son_studio))
                                        {

                                            //
                                            if (verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_de_fin_du_contrat_pour_le_locataire))
                                            {

                                                //
                                                if (verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_de_fin_du_contrat_pour_le_locataire))
                                                {

                                                    //
                                                    $date_de_naissance_du_locataire_sous_forme_de_tableau = explode("/", $date_de_naissance_du_locataire);

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_tableau = explode("/", $date_d_arrivee_du_locataire_dans_son_studio);

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_tableau = explode("/", $date_de_debut_du_contrat_pour_le_locataire);

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_tableau = explode("/", $date_de_fin_du_contrat_pour_le_locataire);

                                                    //
                                                    $date_de_naissance_du_locataire_sous_forme_de_DateTime = new DateTime($date_de_naissance_du_locataire_sous_forme_de_tableau[2] . "-" . $date_de_naissance_du_locataire_sous_forme_de_tableau[0] . "-" . $date_de_naissance_du_locataire_sous_forme_de_tableau[1]);

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime = new DateTime($date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_tableau[2] . "-" . $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_tableau[0] . "-" . $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_tableau[1]);

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_DateTime = new DateTime($date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_tableau[2] . "-" . $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_tableau[0] . "-" . $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_tableau[1]);

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_DateTime = new DateTime($date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_tableau[2] . "-" . $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_tableau[0] . "-" . $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_tableau[1]);

                                                    //
                                                    $date_de_naissance_du_locataire_sous_forme_de_timestamp = $date_de_naissance_du_locataire_sous_forme_de_DateTime->getTimestamp();

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp = $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime->getTimestamp();

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_DateTime->getTimestamp();

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_DateTime->getTimestamp();

                                                    //
                                                    if (($date_de_naissance_du_locataire_sous_forme_de_timestamp < $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp) && ($date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp <= $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp) && ($date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp < $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp)) {

                                                        //
                                                        $smarty = new Smarty();

                                                        //
                                                        $smarty->assign(array("nature_du_document_PDF_a_generer" => "Le contrat de location"));

                                                        //
                                                        $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                                                    }
                                                    else
                                                        {

                                                        //
                                                        $smarty = new Smarty();

                                                        //
                                                        $smarty->assign(array("inititule_de_l_erreur" => "Les dates que vous avez renseignés sont incohérentes",
                                                            "description_de_l_erreur" => "La date de naissance du locataire est strictement inférieure à la date de début de son contrat de location.
                                                                                            Sa date d'arrivée dans la résidence est supérieur ou égal à la date de début de son contrat de location.
                                                                                            Et la date de début de son contrat de location est strictement inférieur à la date de début de son contrat de location."));

                                                        //
                                                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                    }

                                                }
                                                else
                                                    {

                                                    //
                                                    $smarty = new Smarty();

                                                    //
                                                    $smarty->assign(array("inititule_de_l_erreur" => "La date de fin du contrat du locataire que vous avez entré n'est pas valide",
                                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                                    //
                                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                }

                                            }
                                            else
                                                {

                                                //
                                                $smarty = new Smarty();

                                                //
                                                $smarty->assign(array("inititule_de_l_erreur" => "Pour la date de fin du contrat du locataire, ce n'est pas une date que vous avez entré",
                                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                                //
                                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                            }

                                        }
                                        else
                                        {

                                            //
                                            $smarty = new Smarty();

                                            //
                                            $smarty->assign(array("inititule_de_l_erreur" => "La date d'arrivée du locataire que vous avez entré n'est pas valide",
                                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                            //
                                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                        }

                                    }
                                    else
                                    {

                                        //
                                        $smarty = new Smarty();

                                        //
                                        $smarty->assign(array("inititule_de_l_erreur" => "Pour la date d'arrivée du locataire dans son studio, ce n'est pas une date que vous avez entré",
                                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                        //
                                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                    }

                                }
                                else
                                {

                                    //
                                    $smarty = new Smarty();

                                    //
                                    $smarty->assign(array("inititule_de_l_erreur" => "La date de debut du contrat du locataire que vous avez entré n'est pas valide",
                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                    //
                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                }

                            }
                            else
                            {

                                //
                                $smarty = new Smarty();

                                //
                                $smarty->assign(array("inititule_de_l_erreur" => "Pour la date de debut du contrat du locataire, ce n'est pas une date que vous avez entré",
                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                //
                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                            }

                        }
                        else
                        {

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("inititule_de_l_erreur" => "La date de naissance du locataire que vous avez entré n'est pas valide",
                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                            //
                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                        }

                    }
                    else
                    {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("inititule_de_l_erreur" => "Pour la date de naissance du locataire, ce n'est pas une date que vous avez entré",
                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }

                }
                else {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("inititule_de_l_erreur" => "L'adresse postale entrée est invalide",
                                        "description_de_l_erreur" => "L'adresse d'habitation du locataire ne doit contenir que des lettres, des chiffres, des espaces ou des tirets"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }

            }
            else {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("inititule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

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