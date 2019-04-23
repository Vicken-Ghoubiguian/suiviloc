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
    require_once("classes_du_modele/Preavis.php");

    //
    require_once("classes_du_modele/Relance_loyer_impaye.php");

    //
    require_once("classes_du_modele/Expiration_de_contrat_de_location.php");

    //
    require_once("classes_du_modele/Etat_des_lieux.php");

    //
    require_once("classes_du_modele/Relance_loyer_impaye.php");

    //
    require_once("librairie_des_fonctions_importantes/fonctions_de_validation_des_donnees_du_formulaire.php");

    //
    require_once("smarty/libs/Smarty.class.php");

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
            $type_de_public_choisi_pour_le_locataire = htmlspecialchars($_POST['type_de_public_choisi']);

            //
            $type_de_contrat_choisi_pour_le_locataire = htmlspecialchars($_POST['type_de_contrat_choisi']);

            //
            $ensemble_des_conditions_choisies_pour_le_contrat_du_locataire = htmlspecialchars($_POST['ensemble_des_conditions_du_contrat_de_location']);

            //
            $montant_de_la_location_pour_le_locataire = htmlspecialchars($_POST['montant_de_la_location']);

            //
            $montant_du_depot_de_garanti_pour_le_locataire = htmlspecialchars($_POST['montant_du_depot_de_garanti']);

            //
            $recuperation_du_choix_de_recuperation_du_depot_de_garantie = htmlspecialchars($_POST['choix_d_encaissement_du_depot_de_garanti']);

            //
            $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire = boolval($recuperation_du_choix_de_recuperation_du_depot_de_garantie);

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
                                                    $date_de_naissance_du_locataire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_naissance_du_locataire);

                                                    //
                                                    $date_de_naissance_du_locataire_sous_forme_de_DateTime = $date_de_naissance_du_locataire_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_de_naissance_du_locataire_sous_forme_de_timestamp = $date_de_naissance_du_locataire_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_debut_du_contrat_pour_le_locataire);

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_DateTime = $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_d_arrivee_du_locataire_dans_son_studio);

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime = $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp = $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_fin_du_contrat_pour_le_locataire);

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_DateTime = $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    if (($date_de_naissance_du_locataire_sous_forme_de_timestamp < $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp) && ($date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp <= $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp) && ($date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp < $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp)) {

                                                        //
                                                        if(verification_de_la_validite_d_un_numero_de_telephone_portable($_POST['numero_de_telephone_du_locataire']))
                                                        {

                                                            //
                                                            $numero_de_telephone_du_locataire = htmlspecialchars($_POST['numero_de_telephone_du_locataire']);

                                                            //
                                                            $locataire_courant = new Locataire($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire, $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime, $adresse_email_du_locataire, $date_de_naissance_du_locataire_sous_forme_de_DateTime, $adresse_d_habitation_du_locataire, $type_de_public_choisi_pour_le_locataire, $numero_de_telephone_du_locataire);

                                                            //
                                                            try
                                                            {
                                                                //
                                                                $identifiant_du_locataire = recuperation_de_l_id_d_un_element_passe_en_parametre($locataire_courant);

                                                                //
                                                                $tableau_associatif_de_l_ensemble_des_conditions_choisies_pour_le_contrat_du_locataire = mise_en_evidence_de_l_ensemble_des_conditions_du_contrat_de_location($ensemble_des_conditions_choisies_pour_le_contrat_du_locataire);

                                                                //
                                                                $libelle_du_type_de_contrat_choisi = recuperation_du_libelle_du_type_du_contrat_de_location_a_partir_des_donnees_renseignees_dans_le_formulaire($type_de_contrat_choisi_pour_le_locataire, $ensemble_des_conditions_choisies_pour_le_contrat_du_locataire);

                                                                //
                                                                $id_du_type_de_contrat = recuperation_de_l_id_de_type_de_contrat_a_partir_de_son_libelle($libelle_du_type_de_contrat_choisi);

                                                                //
                                                                $inclusion_EDF = $tableau_associatif_de_l_ensemble_des_conditions_choisies_pour_le_contrat_du_locataire["inclusion_edf"];

                                                                //
                                                                $inclusion_eau = $tableau_associatif_de_l_ensemble_des_conditions_choisies_pour_le_contrat_du_locataire["inclusion_eau"];

                                                                //
                                                                $inclusion_internet = $tableau_associatif_de_l_ensemble_des_conditions_choisies_pour_le_contrat_du_locataire["inclusion_internet"];

                                                                //
                                                                $inclusion_assurance_locative = $tableau_associatif_de_l_ensemble_des_conditions_choisies_pour_le_contrat_du_locataire["inclusion_assurance_locative"];

                                                                //
                                                                $inclusion_charges_immeuble = $tableau_associatif_de_l_ensemble_des_conditions_choisies_pour_le_contrat_du_locataire["inclusion_charges_immeuble"];

                                                                //
                                                                $id_du_studio_selectionne = extraction_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_pour_le_locataire);

                                                                //
                                                                if((verification_que_le_locataire_occupe_bel_et_bien_le_studio($identifiant_du_locataire, $id_du_studio_selectionne) == True) || (verification_que_le_studio_est_libre($id_du_studio_selectionne) == True))
                                                                {

                                                                    //Processus de génération du fichier PDF

                                                                    //
                                                                    $chemin_du_fichier_genere = "0";

                                                                    //
                                                                    $instance_smarty_pour_la_generation_du_contrat_de_location_sous_format_PDF = new Smarty();

                                                                    //
                                                                    $instance_smarty_pour_la_generation_du_contrat_de_location_sous_format_PDF->assign(array(

                                                                    ));

                                                                    //
                                                                    if($type_de_contrat_choisi_pour_le_locataire == 1)
                                                                    {
                                                                        //
                                                                        $instance_smarty_pour_la_generation_du_contrat_de_location_sous_format_PDF->assign(array(

                                                                        ));

                                                                        //
                                                                        $template_remplie_avec_tous_les_elements_renseignes_dans_le_formulaire = $instance_smarty_pour_la_generation_du_contrat_de_location_sous_format_PDF->fetch('templates_des_documents_PDF/Contrat.html');

                                                                        //
                                                                        if(est_element_present_dans_la_base($locataire_courant) == False)
                                                                        {

                                                                            insertion_de_l_element_dans_la_base_de_donnees($locataire_courant);

                                                                        }

                                                                        //
                                                                        //$contrat_courant = new Contrat($id_du_type_de_contrat, $libelle_du_type_de_contrat_choisi, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_DateTime, $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_DateTime, $montant_de_la_location_pour_le_locataire, $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble, $chemin_du_fichier_genere, $identifiant_du_locataire, $numero_du_studio_pour_le_locataire, NULL);

                                                                        $contrat_courant = new Contrat($id_du_type_de_contrat, 3, new DateTime("2019-04-01"), new DateTime("2019-04-30"), (new DateTime('now'))->format('Y-m-d'), True, True, True, True, True, True, '01222', $identifiant_du_locataire, '206', NULL);

                                                                        //
                                                                        insertion_de_l_element_dans_la_base_de_donnees($contrat_courant);

                                                                        //
                                                                        $smarty = new Smarty();

                                                                        //
                                                                        $smarty->assign(array("nature_du_document_PDF_a_generer" => "Le contrat de location"));

                                                                        //
                                                                        $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                                                                    }
                                                                    elseif($type_de_contrat_choisi_pour_le_locataire == 2)
                                                                    {
                                                                        //
                                                                        $nom_de_famille_du_garant_renseigne_dans_le_formulaire = $_POST['nom_de_famille_du_garant'];

                                                                        //
                                                                        $prenom_du_garant = $_POST['prenom_du_garant'];

                                                                        //
                                                                        $date_de_naissance_du_garant = $_POST['date_de_naissance_du_garant'];

                                                                        //
                                                                        $adresse_d_habitation_du_garant = $_POST['adresse_postale_de_residence_du_garant'];

                                                                        //
                                                                        if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_garant_renseigne_dans_le_formulaire, $prenom_du_garant))
                                                                        {

                                                                            //
                                                                            if(verification_de_la_validite_de_l_adresse($adresse_d_habitation_du_garant))
                                                                            {

                                                                                //
                                                                                if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_de_naissance_du_garant))
                                                                                {

                                                                                    //
                                                                                    if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_de_naissance_du_garant))
                                                                                    {
                                                                                        //
                                                                                        $date_de_naissance_du_garant_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_naissance_du_garant);

                                                                                        //
                                                                                        $date_de_naissance_du_garant_sous_forme_de_DateTime = $date_de_naissance_du_garant_sous_toutes_ses_formes['datetime'];

                                                                                        //
                                                                                        $date_de_naissance_du_garant_sous_forme_de_timestamp = $date_de_naissance_du_garant_sous_toutes_ses_formes['timestamp'];

                                                                                        //
                                                                                        if($date_de_naissance_du_garant_sous_forme_de_timestamp < $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp)
                                                                                        {
                                                                                            //
                                                                                            $instance_smarty_pour_la_generation_du_contrat_de_location_sous_format_PDF->assign(array());

                                                                                            //
                                                                                            $template_remplie_avec_tous_les_elements_renseignes_dans_le_formulaire = $instance_smarty_pour_la_generation_du_contrat_de_location_sous_format_PDF->fetch('templates_des_documents_PDF/Contrat_12_mois.html');

                                                                                            //
                                                                                            if(est_element_present_dans_la_base($locataire_courant) == False)
                                                                                            {

                                                                                                insertion_de_l_element_dans_la_base_de_donnees($locataire_courant);

                                                                                            }

                                                                                            //
                                                                                            $garant_courant = new Garant($nom_de_famille_du_garant_renseigne_dans_le_formulaire, $prenom_du_garant, $date_de_naissance_du_garant_sous_forme_de_DateTime, $adresse_d_habitation_du_garant);

                                                                                            //
                                                                                            if(est_element_present_dans_la_base($garant_courant))
                                                                                            {

                                                                                                insertion_de_l_element_dans_la_base_de_donnees($garant_courant);

                                                                                            }

                                                                                            //
                                                                                            $identifiant_du_garant = renvoi_de_l_id_du_garant_passe_en_parametre($garant_courant);

                                                                                            //
                                                                                            $contrat_courant = new Contrat($id_du_type_de_contrat, $libelle_du_type_de_contrat_choisi, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_DateTime, $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_DateTime, (new DateTime('now'))->format('Y-m-d'), $montant_de_la_location_pour_le_locataire, $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble, $chemin_du_fichier_genere, $identifiant_du_locataire, $numero_du_studio_pour_le_locataire, $identifiant_du_garant);

                                                                                            //
                                                                                            insertion_de_l_element_dans_la_base_de_donnees($contrat_courant);

                                                                                            //
                                                                                            $smarty = new Smarty();

                                                                                            //
                                                                                            $smarty->assign(array("nature_du_document_PDF_a_generer" => "Le contrat de location"));

                                                                                            //
                                                                                            $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                                                                                        }
                                                                                        //Sinon...
                                                                                        else
                                                                                        {
                                                                                            //
                                                                                            $smarty = new Smarty();

                                                                                            //
                                                                                            $smarty->assign(array("intitule_de_l_erreur" => "La date de naissance du garant du locataire que vous avez renseigné est incohérente",
                                                                                                "description_de_l_erreur" => "La date de naissance du garant du locataire est strictement inférieure à la date de début de son contrat de location."));

                                                                                            //
                                                                                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                                                        }
                                                                                    }
                                                                                    //Sinon...
                                                                                    else
                                                                                    {
                                                                                        //
                                                                                        $smarty = new Smarty();

                                                                                        //
                                                                                        $smarty->assign(array("intitule_de_l_erreur" => "La date de naissance du garant du locataire que vous avez entré n'est pas valide",
                                                                                            "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                                                                        //
                                                                                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                                                    }
                                                                                }
                                                                                //Sinon...
                                                                                else
                                                                                {

                                                                                    //
                                                                                    $smarty = new Smarty();

                                                                                    //
                                                                                    $smarty->assign(array("intitule_de_l_erreur" => "Pour la date de naissance du garant du locataire, ce n'est pas une date que vous avez entré",
                                                                                        "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                                                                    //
                                                                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                                                }
                                                                            }
                                                                            //Sinon...
                                                                            else
                                                                            {
                                                                                //
                                                                                $smarty = new Smarty();

                                                                                //
                                                                                $smarty->assign(array("intitule_de_l_erreur" => "L'adresse postale entrée est invalide",
                                                                                    "description_de_l_erreur" => "L'adresse d'habitation du garant du locataire ne doit contenir que des lettres, des chiffres, des espaces ou des tirets"));

                                                                                //
                                                                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                                            }
                                                                        }
                                                                        //Sinon...
                                                                        else
                                                                        {
                                                                            //
                                                                            $smarty = new Smarty();

                                                                            //
                                                                            $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                                                                                "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                                                                            //
                                                                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                                        }
                                                                    }
                                                                }
                                                                //Sinon...
                                                                else
                                                                {
                                                                    //
                                                                    $smarty = new Smarty();

                                                                    //
                                                                    $smarty->assign(array("intitule_de_l_erreur" => "La saisie du numéro de studio est incorrecte",
                                                                        "description_de_l_erreur" => "Le numéro de studio renseigné n'est pas bon: Soit il n'est pas libre, soit il n'est pas occupé par le locataire"));

                                                                    //
                                                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                                }

                                                            }
                                                            //
                                                            catch(PDOException $exception_concernant_l_enregistrement_du_locataire_dans_la_base)
                                                            {
                                                                //
                                                                $smarty = new Smarty();

                                                                //
                                                                $smarty->assign(array("message_d_erreur_de_connexion_a_la_base_de_donnees" => $exception_concernant_l_enregistrement_du_locataire_dans_la_base->getMessage()));

                                                                //
                                                                $smarty->display("vues/page_d_erreur_PDO_dans_l_application_suiviloc.html");

                                                            }

                                                        }
                                                        //Sinon...
                                                        else
                                                        {

                                                            //
                                                            $smarty = new Smarty();

                                                            //
                                                            $smarty->assign(array("intitule_de_l_erreur" => "Le numéro de téléphone renseigné n'est pas valide",
                                                                "description_de_l_erreur" => "Un numéro de téléphone est entiérement composé de 10 chiffres, commençant par 0 et sans espace"));

                                                            //
                                                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                        }

                                                    }
                                                    //Sinon...
                                                    else
                                                        {

                                                        //
                                                        $smarty = new Smarty();

                                                        //
                                                        $smarty->assign(array("intitule_de_l_erreur" => "Les dates que vous avez renseignés sont incohérentes",
                                                            "description_de_l_erreur" => "La date de naissance du locataire est strictement inférieure à la date de début de son contrat de location.
                                                                                            Sa date d'arrivée dans la résidence est supérieur ou égal à la date de début de son contrat de location.
                                                                                            Et la date de début de son contrat de location est strictement inférieur à la date de début de son contrat de location"));

                                                        //
                                                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                    }

                                                }
                                                //Sinon...
                                                else
                                                    {

                                                    //
                                                    $smarty = new Smarty();

                                                    //
                                                    $smarty->assign(array("intitule_de_l_erreur" => "La date de fin du contrat du locataire que vous avez entré n'est pas valide",
                                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                                    //
                                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                                }

                                            }
                                            //Sinon...
                                            else
                                                {

                                                //
                                                $smarty = new Smarty();

                                                //
                                                $smarty->assign(array("intitule_de_l_erreur" => "Pour la date de fin du contrat du locataire, ce n'est pas une date que vous avez entré",
                                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                                //
                                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                            }

                                        }
                                        //Sinon...
                                        else
                                        {

                                            //
                                            $smarty = new Smarty();

                                            //
                                            $smarty->assign(array("intitule_de_l_erreur" => "La date d'arrivée du locataire que vous avez entré n'est pas valide",
                                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                            //
                                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                        }

                                    }
                                    //Sinon...
                                    else
                                    {

                                        //
                                        $smarty = new Smarty();

                                        //
                                        $smarty->assign(array("intitule_de_l_erreur" => "Pour la date d'arrivée du locataire dans son studio, ce n'est pas une date que vous avez entré",
                                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                        //
                                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                    }

                                }
                                //Sinon...
                                else
                                {

                                    //
                                    $smarty = new Smarty();

                                    //
                                    $smarty->assign(array("intitule_de_l_erreur" => "La date de debut du contrat du locataire que vous avez entré n'est pas valide",
                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                    //
                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                }

                            }
                            //Sinon...
                            else
                            {

                                //
                                $smarty = new Smarty();

                                //
                                $smarty->assign(array("intitule_de_l_erreur" => "Pour la date de debut du contrat du locataire, ce n'est pas une date que vous avez entré",
                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                //
                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                            }

                        }
                        //Sinon...
                        else
                        {

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("intitule_de_l_erreur" => "La date de naissance du locataire que vous avez entré n'est pas valide",
                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                            //
                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                        }

                    }
                    //Sinon...
                    else
                    {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "Pour la date de naissance du locataire, ce n'est pas une date que vous avez entré",
                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }

                }
                //Sinon...
                else {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "L'adresse postale entrée est invalide",
                                        "description_de_l_erreur" => "L'adresse d'habitation du locataire ne doit contenir que des lettres, des chiffres, des espaces ou des tirets"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }

            }
            //Sinon...
            else {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");
            }
        }
        //
        elseif($_POST['type_de_document'] == 'expiration_de_contrat_de_location')
        {

            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = htmlspecialchars($_POST['nom_de_famille_du_locataire']);

            //
            $prenom_du_locataire = htmlspecialchars($_POST['prenom_du_locataire']);

            //
            $date_de_fin_du_contrat_pour_le_locataire = htmlspecialchars($_POST['date_de_fin_du_contrat_de_location']);

            //
            $numero_du_studio_pour_le_locataire = htmlspecialchars($_POST['numero_du_studio_du_locataire']);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_fin_du_contrat_pour_le_locataire);

                //
                $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes['timestamp'];

                //
                $id_d_identification_du_locataire_renseigne = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire);

                //
                if($id_d_identification_du_locataire_renseigne != 0)
                {

                    //
                    $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Contrat.date_de_fin_du_contrat FROM Contrat WHERE Contrat.locataire = :id_du_locataire_concerne");

                    //
                    $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne->bindParam(":id_du_locataire_concerne", $id_d_identification_du_locataire_renseigne);

                    //
                    $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne->execute();

                    //
                    $date_de_fin_du_contrat_pour_le_locataire_concernee_recuperee_depuis_la_base_de_donnees = $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne->fetchAll(PDO::FETCH_BOTH);

                    //
                    $date_de_fin_du_contrat_pour_le_locataire_concernee__recuperee_depuis_la_base_de_donnees_sous_forme_de_DateTime = new DateTime($date_de_fin_du_contrat_pour_le_locataire_concernee_recuperee_depuis_la_base_de_donnees[0][0]);

                    //
                    $date_de_fin_du_contrat_pour_le_locataire_concernee__recuperee_depuis_la_base_de_donnees_sous_forme_de_timestamp = $date_de_fin_du_contrat_pour_le_locataire_concernee__recuperee_depuis_la_base_de_donnees_sous_forme_de_DateTime->getTimestamp();

                    //
                    if($date_de_fin_du_contrat_pour_le_locataire_concernee__recuperee_depuis_la_base_de_donnees_sous_forme_de_timestamp == $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp)
                    {

                        //
                        $resultat_de_la_fonction_de_verification_d_occupation_du_studio_par_le_locataire = verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_d_identification_du_locataire_renseigne, $numero_du_studio_pour_le_locataire);

                        //
                        if($resultat_de_la_fonction_de_verification_d_occupation_du_studio_par_le_locataire == 1)
                        {

                            //
                            setlocale(LC_TIME, "fr_FR");

                            //
                            $date_de_la_fin_du_contrat_du_locataire_au_format_francophone = strftime("%A %d %B %Y", $date_de_fin_du_contrat_pour_le_locataire_concernee__recuperee_depuis_la_base_de_donnees_sous_forme_de_timestamp);

                            //
                            generation_d_un_document_sous_format_PDF("expiration_de_contrat_de_location", array(

                                "prenom_du_locataire" => $prenom_du_locataire,

                                "numero_du_studio" => $numero_du_studio_pour_le_locataire,

                                "date_de_la_fin_du_contrat_du_locataire" => $date_de_la_fin_du_contrat_du_locataire_au_format_francophone

                            ));

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("nature_du_document_PDF_a_generer" => "L'expiration de contrat de location"));

                            //
                            $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                        }
                        //Sinon...
                        else
                        {
                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("intitule_de_l_erreur" => "Les informations que vous avez renseignés sont incohérentes",
                                "description_de_l_erreur" => "Aucun locataire et/ou aucun contrat de location ne correspondent aux informations données: Veuillez les vérifier"));

                            //
                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                        }

                    }
                    //Sinon...
                    else
                    {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "Le locataire en question n'a pas de contrat de location identifié",
                            "description_de_l_erreur" => "Le locataire en question n'a pas de contrat de location identifié, veuillez recommencer la saisie et bien vérifier vos informations"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }
                }
                //Sinon...
                else
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "Le locataire en question n'a pas été trouvé",
                        "description_de_l_erreur" => "Le locataire en question n'a pas été trouvé, veuillez recommencer la saisie"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }
            }
            //
            else
            {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

            }
        }
        //
        elseif($_POST['type_de_document'] == 'attestation')
        {

            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = htmlspecialchars($_POST['nom_de_famille_du_locataire']);

            //
            $prenom_du_locataire = htmlspecialchars($_POST['prenom_du_locataire']);

            //
            $date_d_arrivee_du_locataire_dans_son_studio = htmlspecialchars($_POST['date_d_arrivee_du_locataire_dans_son_studio']);

            //
            $numero_du_studio_pour_le_locataire = htmlspecialchars($_POST['numero_du_studio_pour_a_choisir_pour_location']);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_d_arrivee_du_locataire_dans_son_studio))
                {

                    //
                    if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_d_arrivee_du_locataire_dans_son_studio))
                    {

                        //
                        $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_d_arrivee_du_locataire_dans_son_studio);

                        //
                        $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes['timestamp'];

                        //
                        $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_datetime_SQL = date("Y-m-d H:i:sP", $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                        //
                        if(verification_de_la_pertinance_des_donnees_renseignees_pour_la_generation_de_l_attestation($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire, $numero_du_studio_pour_le_locataire, $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_datetime_SQL))
                        {

                            //
                            setlocale(LC_TIME, "fr_FR");

                            //
                            $date_du_jour = strftime("%A %d %B %Y");

                            //
                            $date_d_arrivee_du_locataire_dans_son_studio_sous_format_francophone = strftime("%A %d %B %Y", $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                            //
                            generation_d_un_document_sous_format_PDF("attestation", array(

                                "nom_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire,

                                "prenom_du_locataire" => $prenom_du_locataire,

                                "numero_du_studio" => $numero_du_studio_pour_le_locataire,

                                "date_du_jour" => $date_du_jour,

                                "date_d_arrivee_dans_la_residence" => $date_d_arrivee_du_locataire_dans_son_studio_sous_format_francophone

                            ));

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("nature_du_document_PDF_a_generer" => "Attestation"));

                            //
                            $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                        }
                        //Sinon...
                        else
                        {

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("intitule_de_l_erreur" => "Les informations que vous avez renseignés sont incohérentes",
                                "description_de_l_erreur" => "Aucun locataire et/ou aucun contrat de location ne correspondent aux informations données: Veuillez les vérifier"));

                            //
                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                        }

                    }
                    //Sinon...
                    else
                    {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "La date d'arrivée du locataire que vous avez entré n'est pas valide",
                            "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }

                }
                //Sinon...
                else
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "Pour la date d'arrivée du locataire dans son studio, ce n'est pas une date que vous avez entré",
                        "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }

            }
            //Sinon...
            else
            {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

            }
        }
        //
        elseif($_POST['type_de_document'] == 'relance_loyer_impaye')
        {

            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = htmlspecialchars($_POST['nom_de_famille_du_locataire']);

            //
            $prenom_du_locataire = htmlspecialchars($_POST['prenom_du_locataire']);

            //
            $numero_du_studio_pour_le_locataire = htmlspecialchars($_POST['numero_du_studio_pour_a_choisir_pour_location']);

            //
            $montant_du_loyer_impaye_pour_le_locataire = htmlspecialchars($_POST['montant_du_loyer_impaye']);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                $id_du_locataire_recupere = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire);

                //
                if($id_du_locataire_recupere != 0)
                {

                    //
                    $resultat_de_la_fonction_de_verification_d_occupation_du_studio_par_le_locataire = verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_du_locataire_recupere, $numero_du_studio_pour_le_locataire);

                    //
                    if($resultat_de_la_fonction_de_verification_d_occupation_du_studio_par_le_locataire == 1)
                    {

                        //
                        setlocale(LC_TIME, "fr_FR");

                        //
                        $date_du_jour = strftime("%A %d %B %Y");

                        //
                        generation_d_un_document_sous_format_PDF("relance_loyer_impaye", array(

                            "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire,

                            "prenom_du_locataire" => $prenom_du_locataire,

                            "numero_du_studio" => $numero_du_studio_pour_le_locataire,

                            "date_du_jour" => $date_du_jour,

                            "montant_a_debiter_pour_le_loyer" => $montant_du_loyer_impaye_pour_le_locataire

                        ));

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("nature_du_document_PDF_a_generer" => "Relance impayé"));

                        //
                        $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                    }
                    //Sinon...
                    else
                    {
                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "Erreur dans la correspondance des données",
                            "description_de_l_erreur" => "Le locataire renseigné n'occupe pas ce logement"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }

                }
                //Sinon...
                else
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "Le locataire en question n'a pas été trouvé",
                        "description_de_l_erreur" => "Le locataire en question n'a pas été trouvé, veuillez recommencer la saisie"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }
            }
            //Sinon...
            else
            {
                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

            }

        }
        //
        elseif($_POST['type_de_document'] == 'etiquette')
        {

            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = htmlspecialchars($_POST['nom_de_famille_du_locataire']);

            //
            $prenom_du_locataire = htmlspecialchars($_POST['prenom_du_locataire']);

            //
            $numero_du_studio_pour_le_locataire = htmlspecialchars($_POST['numero_du_studio_pour_a_choisir_pour_location']);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire);

                //
                $id_du_studio_pour_le_locataire = extraction_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_pour_le_locataire);

                //
                if($id_du_locataire != 0) {

                    //
                    if (verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_du_locataire, $id_du_studio_pour_le_locataire) == True)
                    {

                        //
                        $numero_de_l_etage_du_studio = $numero_du_studio_pour_le_locataire[0];

                        //
                        generation_d_un_document_sous_format_PDF("etiquette", array(

                            "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire,

                            "prenom_du_locataire" => $prenom_du_locataire,

                            "numero_du_studio" => $numero_du_studio_pour_le_locataire,

                            "numero_de_l_etage_du_studio" => $numero_de_l_etage_du_studio

                        ));

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("nature_du_document_PDF_a_generer" => "Relance impayé"));

                        //
                        $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                    } //Sinon...
                    else  {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "Erreur dans la correspondance des données",
                            "description_de_l_erreur" => "Le locataire renseigné n'occupe pas ce logement"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }
                }
                //Sinon...
                else
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "Le locataire en question n'a pas été trouvé",
                        "description_de_l_erreur" => "Le locataire en question n'a pas été trouvé, veuillez recommencer la saisie"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }
            }
            //Sinon...
            else
            {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

            }
        }
        //
        elseif($_POST['type_de_document'] == 'etat_des_lieux_lors_d_un_depart_anticipe')
        {

            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = htmlspecialchars($_POST['nom_de_famille_du_locataire']);

            //
            $prenom_du_locataire = htmlspecialchars($_POST['prenom_du_locataire']);

            //
            $numero_du_studio_pour_le_locataire = htmlspecialchars($_POST['numero_du_studio_pour_a_choisir_pour_location']);

            //
            $date_de_depart_initial_du_locataire_entree_dans_le_formulaire = htmlspecialchars($_POST['date_de_depart_initial_du_locataire']);

            //
            $date_choisie_pour_l_etat_des_lieux = htmlspecialchars($_POST['date_choisie_pour_l_etat_des_lieux']);

            //
            $heure_choisie_pour_l_etat_des_lieux = htmlspecialchars($_POST['heure_choisie_pour_l_etat_des_lieux']);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire);

                //
                $id_du_studio_pour_le_locataire = extraction_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_pour_le_locataire);

                //
                if($id_du_locataire != 0)
                {

                    //
                    if(verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_du_locataire, $id_du_studio_pour_le_locataire) == True)
                    {

                        //
                        if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_de_depart_initial_du_locataire_entree_dans_le_formulaire))
                        {

                            //
                            if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_choisie_pour_l_etat_des_lieux))
                            {

                                //
                                if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_de_depart_initial_du_locataire_entree_dans_le_formulaire))
                                {


                                    //
                                    if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_choisie_pour_l_etat_des_lieux))
                                    {

                                        //
                                        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT date_de_fin_du_contrat FROM Contrat WHERE Contrat.locataire = :id_du_locataire AND Contrat.studio = :id_du_studio");

                                        //
                                        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->bindParam(":id_du_locataire", $id_du_locataire);

                                        //
                                        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->bindParam(":id_du_studio", $id_du_studio_pour_le_locataire);

                                        //
                                        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->execute();

                                        //
                                        $resultat_de_la_requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire = $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->fetchAll(PDO::FETCH_BOTH);

                                        //
                                        $date_de_depart_initial_du_locataire_depuis_la_BDD = $resultat_de_la_requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire[0][0];

                                        //
                                        $date_de_depart_initial_du_locataire_depuis_la_BDD_prete_a_etre_traitee = formatage_date_du_format_de_DateTime_SQL_a_celui_de_calendar_jQuery_Ui($date_de_depart_initial_du_locataire_depuis_la_BDD);

                                        //
                                        $date_de_depart_initial_du_locataire_depuis_la_BDD_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_depart_initial_du_locataire_depuis_la_BDD_prete_a_etre_traitee);

                                        //
                                        $date_de_depart_initial_du_locataire_depuis_la_BDD_sous_forme_de_timestamp = $date_de_depart_initial_du_locataire_depuis_la_BDD_sous_toutes_ses_formes['timestamp'];

                                        //
                                        $date_de_depart_initial_du_locataire_entree_dans_le_formulaire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_depart_initial_du_locataire_entree_dans_le_formulaire);

                                        //
                                        $date_de_depart_initial_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp = $date_de_depart_initial_du_locataire_entree_dans_le_formulaire_sous_toutes_ses_formes['timestamp'];

                                        //
                                        $date_choisie_pour_l_etat_des_lieux_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_choisie_pour_l_etat_des_lieux);

                                        //
                                        $date_choisie_pour_l_etat_des_lieux_sous_forme_de_timestamp = $date_choisie_pour_l_etat_des_lieux_sous_toutes_ses_formes['timestamp'];

                                        //
                                        $requete_de_selection_de_la_date_d_arrivee_du_locataire_dans_la_residence = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT date_d_arrivee FROM Locataire WHERE Locataire.id = :id_du_locataire");

                                        //
                                        $requete_de_selection_de_la_date_d_arrivee_du_locataire_dans_la_residence->bindParam(":id_du_locataire", $id_du_locataire);

                                        //
                                        $requete_de_selection_de_la_date_d_arrivee_du_locataire_dans_la_residence->execute();

                                        //
                                        $resultat_de_la_requete_de_selection_de_la_date_d_arrivee_du_locataire_dans_la_residence = $requete_de_selection_de_la_date_d_arrivee_du_locataire_dans_la_residence->fetchAll(PDO::FETCH_BOTH);

                                        //
                                        $date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD = $resultat_de_la_requete_de_selection_de_la_date_d_arrivee_du_locataire_dans_la_residence[0][0];

                                        //
                                        $date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD_pour_etre_traitee = formatage_date_du_format_de_DateTime_SQL_a_celui_de_calendar_jQuery_Ui($date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD);

                                        //
                                        $date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD_pour_etre_traitee);

                                        //
                                        $date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD_sous_forme_de_timestamp = $date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD_sous_toutes_ses_formes['timestamp'];

                                        //
                                        if($date_de_depart_initial_du_locataire_depuis_la_BDD_sous_forme_de_timestamp == $date_de_depart_initial_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp)
                                        {

                                            //
                                            setlocale(LC_TIME, "fr_FR");

                                            //
                                            $date_de_depart_initial_du_locataire_au_format_francophone = strftime("%A %d %B %Y", $date_de_depart_initial_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp);

                                            //
                                            $date_choisie_pour_l_etat_des_lieux_au_format_francophone = strftime("%A %d %B %Y", $date_choisie_pour_l_etat_des_lieux_sous_forme_de_timestamp);

                                            //
                                            $date_d_arrivee_du_locataire_dans_la_residence_au_format_francophone = strftime("%A %d %B %Y", $date_d_arrivee_du_locataire_dans_la_residence_depuis_la_BDD_sous_forme_de_timestamp);

                                            //
                                            $date_du_jour = strftime("%A %d %B %Y");

                                            //
                                            generation_d_un_document_sous_format_PDF("etat_des_lieux_lors_de_sortie_anticipee", array(

                                                "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire,

                                                "prenom_du_locataire" => $prenom_du_locataire,

                                                "numero_du_studio" => $numero_du_studio_pour_le_locataire,

                                                "date_du_jour" => $date_du_jour,

                                                "civilite_du_locataire" => "Monsieur/Madame",

                                                "date_choisie_pour_l_etat_des_lieux" => $date_choisie_pour_l_etat_des_lieux_au_format_francophone,

                                                "heure_choisie_pour_l_etat_des_lieux" => $heure_choisie_pour_l_etat_des_lieux,

                                                "date_d_arrivee_dans_la_residence" => $date_d_arrivee_du_locataire_dans_la_residence_au_format_francophone,

                                                "date_de_fin" => $date_de_depart_initial_du_locataire_au_format_francophone

                                            ));

                                            //
                                            $smarty = new Smarty();

                                            //
                                            $smarty->assign(array("nature_du_document_PDF_a_generer" => "Etat des lieux lors d'une sortie anticipée"));

                                            //
                                            $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                                        }
                                        //Sinon...
                                        else
                                        {

                                            //
                                            $smarty = new Smarty();

                                            //
                                            $smarty->assign(array("intitule_de_l_erreur" => "Les dates que vous avez renseignés sont incohérentes",
                                                "description_de_l_erreur" => "La date initial de fin de contrat que vous avez entrée n'est pas la même que celle renseignée dans la base"));

                                            //
                                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                        }
                                    }
                                    //Sinon...
                                    else
                                    {

                                        //
                                        $smarty = new Smarty();

                                        //
                                        $smarty->assign(array("intitule_de_l_erreur" => "La date choisie pour l'état des lieux que vous avez entré n'est pas valide",
                                            "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                        //
                                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                    }

                                }
                                //Sinon...
                                else
                                {

                                    //
                                    $smarty = new Smarty();

                                    //
                                    $smarty->assign(array("intitule_de_l_erreur" => "La date de départ initial du locataire que vous avez entré n'est pas valide",
                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                    //
                                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                                }

                            }
                            //Sinon...
                            else
                            {

                                //
                                $smarty = new Smarty();

                                //
                                $smarty->assign(array("intitule_de_l_erreur" => "Pour la date choisie pour l'état des lieux, ce n'est pas une date que vous avez entré",
                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                //
                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                            }

                        }
                        //Sinon...
                        else
                        {

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("intitule_de_l_erreur" => "Pour la date de départ initial du locataire, ce n'est pas une date que vous avez entré",
                                "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                            //
                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                        }

                    }
                    //Sinon...
                    else
                    {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "Erreur dans la correspondance des données",
                            "description_de_l_erreur" => "Le locataire renseigné n'occupe pas ce logement"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }
                }
                //Sinon...
                else
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "Le locataire en question n'a pas été trouvé",
                        "description_de_l_erreur" => "Le locataire en question n'a pas été trouvé, veuillez recommencer la saisie"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }
            }
            //Sinon..
            else
            {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

            }
        }
        //
        elseif($_POST['type_de_document'] == 'preavis')
        {

            //
            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire = $_POST['nom_de_famille_du_locataire'];

            //
            $prenom_du_locataire = $_POST['prenom_du_locataire'];

            //
            $numero_du_studio_pour_le_locataire = $_POST['numero_du_studio_pour_a_choisir_pour_location'];

            //
            $id_du_studio = extraction_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_pour_le_locataire);

            //
            $date_de_depart_du_locataire_entree_dans_le_formulaire = $_POST['date_de_depart_du_locataire'];

            //
            $id_du_studio_pour_le_locataire = extraction_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_pour_le_locataire);

            //
            $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire);

            //
            $id_du_contrat_de_location = recuperation_de_l_id_d_un_contrat_de_location_a_partir_de_l_id_du_locataire_et_de_l_id_du_studio($id_du_locataire, $id_du_studio_pour_le_locataire);

            //
            if(verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire, $prenom_du_locataire))
            {

                //
                if(verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_du_locataire, $id_du_studio_pour_le_locataire) == True)
                {

                    //
                    if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_de_depart_du_locataire_entree_dans_le_formulaire))
                    {

                        //
                        if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_de_depart_du_locataire_entree_dans_le_formulaire))
                        {

                            //
                            $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT date_de_fin_du_contrat FROM Contrat WHERE Contrat.locataire = :id_du_locataire AND Contrat.studio = :id_du_studio");

                            //
                            $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->bindParam(":id_du_locataire", $id_du_locataire);

                            //
                            $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->bindParam(":id_du_studio", $id_du_studio_pour_le_locataire);

                            //
                            $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->execute();

                            //
                            $resultat_de_la_requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire = $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire->fetchAll(PDO::FETCH_BOTH);

                            //
                            $date_de_depart_du_locataire_depuis_la_BDD = $resultat_de_la_requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire[0][0];

                            //
                            $date_de_depart_du_locataire_depuis_la_BDD_prete_a_etre_traitee = formatage_date_du_format_de_DateTime_SQL_a_celui_de_calendar_jQuery_Ui($date_de_depart_du_locataire_depuis_la_BDD);

                            //
                            $date_de_depart_du_locataire_depuis_la_BDD_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_depart_du_locataire_depuis_la_BDD_prete_a_etre_traitee);

                            //
                            $date_de_depart_du_locataire_depuis_la_BDD_sous_forme_de_timestamp = $date_de_depart_du_locataire_depuis_la_BDD_sous_toutes_ses_formes['timestamp'];

                            //
                            $date_de_depart_du_locataire_entree_dans_le_formulaire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_depart_du_locataire_entree_dans_le_formulaire);

                            //
                            $date_de_depart_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp = $date_de_depart_du_locataire_entree_dans_le_formulaire_sous_toutes_ses_formes['timestamp'];

                            //
                            if($date_de_depart_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp == $date_de_depart_du_locataire_depuis_la_BDD_sous_forme_de_timestamp)
                            {

                                //
                                try {

                                    //
                                    setlocale(LC_TIME, "fr_FR");

                                    //
                                    $date_de_depart_du_locataire_au_format_francophone = strftime("%A %d %B %Y", $date_de_depart_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp);

                                    //
                                    $date_du_jour = strftime("%A %d %B %Y");

                                    //
                                    $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF("preavis", array(

                                        "nom_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire,

                                        "prenom_du_locataire" => $prenom_du_locataire,

                                        "numero_du_studio" => $numero_du_studio_pour_le_locataire,

                                        "date_du_jour" => $date_du_jour,

                                        "civilite_du_locataire" => "Monsieur/Madame",

                                        "date_de_depart_du_locataire" => $date_de_depart_du_locataire_au_format_francophone

                                    ));

                                    //
                                    $preavis_courant = new Preavis('2019-03-03', $chemin_du_fichier_genere, $id_du_contrat_de_location);

                                    //
                                    insertion_de_l_element_dans_la_base_de_donnees($preavis_courant);

                                    //
                                    $smarty = new Smarty();

                                    //
                                    $smarty->assign(array("nature_du_document_PDF_a_generer" => "préavis de départ"));

                                    //
                                    $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

                                }
                                catch(Exception $exception)
                                {


                                }
                            }
                            //Sinon...
                            else
                            {

                                //
                                $smarty = new Smarty();

                                //
                                $smarty->assign(array("intitule_de_l_erreur" => "La date de départ que vous avez renseigné n'est pas la bonne",
                                    "description_de_l_erreur" => "La date initial de fin de contrat que vous avez entrée n'est pas la même que celle renseignée dans la base"));

                                //
                                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                            }
                        }
                        //Sinon...
                        else
                        {

                            //
                            $smarty = new Smarty();

                            //
                            $smarty->assign(array("intitule_de_l_erreur" => "La date de départ du locataire que vous avez entré n'est pas valide",
                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                            //
                            $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                        }
                    }
                    //Sinon...
                    else
                    {

                        //
                        $smarty = new Smarty();

                        //
                        $smarty->assign(array("intitule_de_l_erreur" => "Pour la date de départ du locataire, ce n'est pas une date que vous avez entré",
                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                        //
                        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                    }
                }
                //Sinon...
                else
                {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("intitule_de_l_erreur" => "Erreur dans la correspondance des données",
                        "description_de_l_erreur" => "Soit le locataire renseigné n'occupe pas ce logement, soit celui-ci n'existe pas"));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

                }
            }
            //Sinon...
            else
            {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                //
                $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

            }
        }
        //Sinon...
        else
        {

            //
            header("Location: index.php");
            exit;

        }
    }
    //
    else
    {

        //
        header("Location: index.php");
        exit;

    }