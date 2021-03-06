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
    require_once("classes_du_modele/Attestation.php");

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
                                                    $date_de_naissance_du_locataire_sous_forme_de_String = $date_de_naissance_du_locataire_sous_toutes_ses_formes['chaine_de_caracteres'];

                                                    //
                                                    $date_de_naissance_du_locataire_sous_forme_de_timestamp = $date_de_naissance_du_locataire_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_debut_du_contrat_pour_le_locataire);

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_DateTime = $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_String = $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes['chaine_de_caracteres'];

                                                    //
                                                    $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp = $date_de_debut_du_contrat_pour_le_locataire_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_d_arrivee_du_locataire_dans_son_studio);

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime = $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_String = $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes['chaine_de_caracteres'];

                                                    //
                                                    $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp = $date_d_arrivee_du_locataire_dans_son_studio_sous_toutes_ses_formes['timestamp'];

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_de_fin_du_contrat_pour_le_locataire);

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_DateTime = $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes['datetime'];

                                                    //
                                                    $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_String = $date_de_fin_du_contrat_pour_le_locataire_sous_toutes_ses_formes['chaine_de_caracteres'];

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
                                                            $nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule = strtoupper($nom_de_famille_du_locataire_renseigne_dans_le_formulaire);

                                                            //
                                                            $prenom_du_locataire_formate = formatage_du_prenom_pour_ne_mettre_que_les_premieres_lettres_en_majuscule($prenom_du_locataire);

                                                            //
                                                            $locataire_courant = new Locataire($nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_locataire_formate, $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_String, $adresse_email_du_locataire, $date_de_naissance_du_locataire_sous_forme_de_String, $adresse_d_habitation_du_locataire, $type_de_public_choisi_pour_le_locataire, $numero_de_telephone_du_locataire);

                                                            //
                                                            try
                                                            {
                                                                //
                                                                $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_locataire_formate);

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
                                                                if((verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_du_locataire, $id_du_studio_selectionne) == True) || (verification_que_le_studio_est_libre($id_du_studio_selectionne) == True))
                                                                {

                                                                    //
                                                                    $chemin_du_fichier_genere = 0;

                                                                    //
                                                                    $chemin_du_fichier_genere = strval($chemin_du_fichier_genere);

                                                                    //
                                                                    if($type_de_contrat_choisi_pour_le_locataire == 1)
                                                                    {

                                                                        //
                                                                        if(est_element_present_dans_la_base($locataire_courant) == False)
                                                                        {

                                                                            //
                                                                            $surface_du_studio_pour_le_locataire = renvoi_du_libelle_de_la_surface_d_un_studio($numero_du_studio_pour_le_locataire);

                                                                            //
                                                                            $montant_du_loyer_en_lettres = conversion_de_chiffres_a_lettres_des_montants_passes_en_parametres($montant_de_la_location_pour_le_locataire);

                                                                            //
                                                                            $montant_du_depot_de_garanti_pour_le_locataire_en_lettres = conversion_de_chiffres_a_lettres_des_montants_passes_en_parametres($montant_du_depot_de_garanti_pour_le_locataire);

                                                                            //
                                                                            setlocale(LC_TIME, "fr_FR.utf8", "fra");

                                                                            //
                                                                            $date_du_jour = strftime("%A %d %B %Y", time());

                                                                            //
                                                                            $date_de_debut_du_contrat_de_location = strftime("%A %d %B %Y", $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                                                                            //
                                                                            $date_de_fin_du_contrat_de_location = strftime("%A %d %B %Y", $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                                                                            //
                                                                            if($choix_d_encaissement_du_depot_de_garanti_pour_le_locataire == true)
                                                                            {

                                                                                //
                                                                                $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire_formate_pour_inclusion_dans_le_contrat_PDF = "Oui";

                                                                            }
                                                                            //
                                                                            else
                                                                            {

                                                                                //
                                                                                $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire_formate_pour_inclusion_dans_le_contrat_PDF = "Non";

                                                                            }

                                                                            //
                                                                            if($inclusion_EDF == 1)
                                                                            {

                                                                                //
                                                                                $inclusion_EDF_formate_pour_inclusion_dans_le_contrat_PDF = "Oui";

                                                                            }
                                                                            //
                                                                            else
                                                                            {

                                                                                //
                                                                                $inclusion_EDF_formate_pour_inclusion_dans_le_contrat_PDF = "Non";

                                                                            }

                                                                            //
                                                                            $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF('contrat_0-3_mois', array(

                                                                                "type_de_contrat" => "de 0 à 3 mois",
                                                                                "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule,
                                                                                "prenom_du_locataire" => $prenom_du_locataire_formate,
                                                                                "numero_du_studio" => $numero_du_studio_pour_le_locataire,
                                                                                "adresse_d_habitation_du_locataire" => $adresse_d_habitation_du_locataire,
                                                                                "surface_du_studio" => $surface_du_studio_pour_le_locataire,
                                                                                "date_de_debut_du_contrat_de_location" => $date_de_debut_du_contrat_de_location,
                                                                                "date_de_fin_du_contrat_de_location" => $date_de_fin_du_contrat_de_location,
                                                                                "date_du_jour" => $date_du_jour,
                                                                                "montant_du_loyer_en_chiffres" => $montant_de_la_location_pour_le_locataire,
                                                                                "montant_du_depot_de_garantie_en_chiffre" => $montant_du_depot_de_garanti_pour_le_locataire,
                                                                                "montant_du_loyer_en_lettres" => $montant_du_loyer_en_lettres,
                                                                                "montant_du_depot_de_garantie_en_lettres" => $montant_du_depot_de_garanti_pour_le_locataire_en_lettres,
                                                                                "encaissement_du_depot_de_garantie" => $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire_formate_pour_inclusion_dans_le_contrat_PDF,
                                                                                "inclusion_d_EDF_dans_le_contrat" => $inclusion_EDF_formate_pour_inclusion_dans_le_contrat_PDF

                                                                            ));

                                                                            //
                                                                            insertion_de_l_element_dans_la_base_de_donnees($locataire_courant);

                                                                            //
                                                                            $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_locataire_formate);

                                                                            //
                                                                            $date_du_jour_pour_insertion_dans_le_contrat_courant = date('Y-m-d');

                                                                            //
                                                                            $contrat_courant = new Contrat($id_du_type_de_contrat, $libelle_du_type_de_contrat_choisi, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_String, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_String, $date_du_jour_pour_insertion_dans_le_contrat_courant, $montant_de_la_location_pour_le_locataire, $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble, $chemin_du_fichier_genere, $id_du_locataire, $id_du_studio_selectionne, NULL);

                                                                            //
                                                                            insertion_de_l_element_dans_la_base_de_donnees($contrat_courant);

                                                                        }
                                                                        //Sinon...
                                                                        else
                                                                        {

                                                                            //
                                                                            $surface_du_studio_pour_le_locataire = renvoi_du_libelle_de_la_surface_d_un_studio($numero_du_studio_pour_le_locataire);

                                                                            //
                                                                            $montant_du_loyer_en_lettres = conversion_de_chiffres_a_lettres_des_montants_passes_en_parametres($montant_de_la_location_pour_le_locataire);

                                                                            //
                                                                            $montant_du_depot_de_garanti_pour_le_locataire_en_lettres = conversion_de_chiffres_a_lettres_des_montants_passes_en_parametres($montant_du_depot_de_garanti_pour_le_locataire);

                                                                            //
                                                                            setlocale(LC_TIME, "fr_FR.utf8", "fra");

                                                                            //
                                                                            $date_du_jour = strftime("%A %d %B %Y", time());

                                                                            //
                                                                            $date_de_debut_du_contrat_de_location = strftime("%A %d %B %Y", $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                                                                            //
                                                                            $date_de_fin_du_contrat_de_location = strftime("%A %d %B %Y", $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                                                                            //
                                                                            if($choix_d_encaissement_du_depot_de_garanti_pour_le_locataire == true)
                                                                            {

                                                                                //
                                                                                $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire_formate_pour_inclusion_dans_le_contrat_PDF = "montant encaissé";

                                                                            }
                                                                            //
                                                                            else
                                                                            {

                                                                                //
                                                                                $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire_formate_pour_inclusion_dans_le_contrat_PDF = "montant non encaissé";

                                                                            }

                                                                            //
                                                                            if($inclusion_EDF == 1)
                                                                            {

                                                                                //
                                                                                $inclusion_EDF_formate_pour_inclusion_dans_le_contrat_PDF = "Oui";

                                                                            }
                                                                            //
                                                                            else
                                                                            {

                                                                                //
                                                                                $inclusion_EDF_formate_pour_inclusion_dans_le_contrat_PDF = "Non";

                                                                            }

                                                                            //
                                                                            $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF('contrat_0-3_mois', array(

                                                                                "type_de_contrat" => "de 0 à 3 mois",
                                                                                "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule,
                                                                                "prenom_du_locataire" => $prenom_du_locataire_formate,
                                                                                "adresse_d_habitation_du_locataire" => $adresse_d_habitation_du_locataire,
                                                                                "numero_du_studio" => $numero_du_studio_pour_le_locataire,
                                                                                "surface_du_studio" => $surface_du_studio_pour_le_locataire,
                                                                                "date_de_debut_du_contrat_de_location" => $date_de_debut_du_contrat_de_location,
                                                                                "date_de_fin_du_contrat_de_location" => $date_de_fin_du_contrat_de_location,
                                                                                "date_du_jour" => $date_du_jour,
                                                                                "montant_du_loyer_en_chiffres" => $montant_de_la_location_pour_le_locataire,
                                                                                "montant_du_depot_de_garantie_en_chiffre" => $montant_du_depot_de_garanti_pour_le_locataire,
                                                                                "montant_du_loyer_en_lettres" => $montant_du_loyer_en_lettres,
                                                                                "montant_du_depot_de_garantie_en_lettres" => $montant_du_depot_de_garanti_pour_le_locataire_en_lettres,
                                                                                "encaissement_du_depot_de_garantie" => $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire_formate_pour_inclusion_dans_le_contrat_PDF,
                                                                                "inclusion_d_EDF_dans_le_contrat" => $inclusion_EDF_formate_pour_inclusion_dans_le_contrat_PDF

                                                                            ));

                                                                            //
                                                                            $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_locataire_formate);

                                                                            //
                                                                            $date_du_jour_pour_insertion_dans_le_contrat_courant = date('Y-m-d');

                                                                            //
                                                                            $contrat_courant = new Contrat($id_du_type_de_contrat, $libelle_du_type_de_contrat_choisi, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_String, $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_String, $date_du_jour_pour_insertion_dans_le_contrat_courant, $montant_de_la_location_pour_le_locataire, $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble, $chemin_du_fichier_genere, $id_du_locataire, $id_du_studio_selectionne, NULL);

                                                                            //
                                                                            insertion_du_contrat_de_location_avec_archivage_du_precedent_dans_la_base_de_donnees($contrat_courant, $locataire_courant);

                                                                        }

                                                                        //
                                                                        confirmation_de_reussite_de_generation_du_document_PDF("Le contrat de location");

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
                                                                                        $date_de_naissance_du_garant_sous_forme_de_String = $date_de_naissance_du_garant_sous_toutes_ses_formes['chaine_de_caracteres'];

                                                                                        //
                                                                                        $date_de_naissance_du_garant_sous_forme_de_timestamp = $date_de_naissance_du_garant_sous_toutes_ses_formes['timestamp'];

                                                                                        //
                                                                                        if($date_de_naissance_du_garant_sous_forme_de_timestamp < $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp)
                                                                                        {

                                                                                            //
                                                                                            $nom_de_famille_du_garant_renseigne_dans_le_formulaire_et_mis_en_majuscule = strtoupper($nom_de_famille_du_garant_renseigne_dans_le_formulaire);

                                                                                            //
                                                                                            $prenom_du_garant_formate = formatage_du_prenom_pour_ne_mettre_que_les_premieres_lettres_en_majuscule($prenom_du_garant);

                                                                                            //
                                                                                            $garant_courant = new Garant($nom_de_famille_du_garant_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_garant_formate, $date_de_naissance_du_garant_sous_forme_de_String, $adresse_d_habitation_du_garant);

                                                                                            //
                                                                                            if(est_element_present_dans_la_base($locataire_courant) == False)
                                                                                            {

                                                                                                //
                                                                                                $surface_du_studio_pour_le_locataire = renvoi_du_libelle_de_la_surface_d_un_studio($numero_du_studio_pour_le_locataire);


                                                                                                //
                                                                                                insertion_de_l_element_dans_la_base_de_donnees($locataire_courant);

                                                                                                //
                                                                                                if(est_element_present_dans_la_base($garant_courant) == False)
                                                                                                {

                                                                                                    //
                                                                                                    insertion_de_l_element_dans_la_base_de_donnees($garant_courant);

                                                                                                }

                                                                                                //
                                                                                                setlocale(LC_TIME, "fr_FR.utf8", "fra");

                                                                                                //
                                                                                                $date_du_jour = strftime("%A %d %B %Y", time());

                                                                                                //
                                                                                                $date_de_debut_du_contrat_de_location = strftime("%A %d %B %Y", $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                                                                                                //
                                                                                                $date_de_naissance_du_garant_a_inserer_dans_le_contrat = strftime("%A %d %B %Y", $date_de_naissance_du_garant_sous_forme_de_timestamp);

                                                                                                //
                                                                                                $date_de_naissance_du_locataire_a_inserer_dans_le_contrat = strftime("%A %d %B %Y", $date_de_naissance_du_locataire_sous_forme_de_timestamp);

                                                                                                //
                                                                                                if (strlen($numero_du_studio_pour_le_locataire) == 3) {

                                                                                                    //
                                                                                                    $numero_de_l_etage_du_studio = $numero_du_studio_pour_le_locataire[0];

                                                                                                } //Sinon...
                                                                                                else {

                                                                                                    //
                                                                                                    $numero_de_l_etage_du_studio = "rez-de-chaussée";

                                                                                                }

                                                                                                //
                                                                                                $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF('contrat_12_mois', array(

                                                                                                    "type_de_contrat" => "de 12 mois",
                                                                                                    "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule,
                                                                                                    "adresse_mail_du_locataire" => $adresse_email_du_locataire,
                                                                                                    "prenom_du_locataire" => $prenom_du_locataire_formate,
                                                                                                    "nom_de_famille_du_garant" => $nom_de_famille_du_garant_renseigne_dans_le_formulaire_et_mis_en_majuscule,
                                                                                                    "prenom_du_garant" => $prenom_du_garant_formate,
                                                                                                    "date_de_naissance_du_garant" => $date_de_naissance_du_garant_a_inserer_dans_le_contrat,
                                                                                                    "date_de_naissance_du_locataire" => $date_de_naissance_du_locataire_a_inserer_dans_le_contrat,
                                                                                                    "numero_de_l_etage" => $numero_de_l_etage_du_studio,
                                                                                                    "adresse_du_garant" => $adresse_d_habitation_du_garant,
                                                                                                    "numero_du_studio" => $numero_du_studio_pour_le_locataire,
                                                                                                    "surface_du_studio" => $surface_du_studio_pour_le_locataire,
                                                                                                    "date_debut_de_contrat" => $date_de_debut_du_contrat_de_location,
                                                                                                    "date_du_jour" => $date_du_jour,
                                                                                                    "date_de_la_reception_des_documents" => $date_du_jour,
                                                                                                    "montant_du_loyer" => $montant_de_la_location_pour_le_locataire,
                                                                                                    "montant_du_depot_de_garanti" => $montant_du_depot_de_garanti_pour_le_locataire

                                                                                                ));

                                                                                                //
                                                                                                $id_du_garant = renvoi_de_l_id_du_garant_a_partir_de_son_nom_et_prenom($nom_de_famille_du_garant_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_garant_formate);

                                                                                                //
                                                                                                $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_locataire_formate);

                                                                                                //
                                                                                                $date_du_jour_pour_insertion_dans_le_contrat_courant = date('Y-m-d');

                                                                                                //
                                                                                                $contrat_courant = new Contrat($id_du_type_de_contrat, $libelle_du_type_de_contrat_choisi, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_String, $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_String, $date_du_jour_pour_insertion_dans_le_contrat_courant, $montant_de_la_location_pour_le_locataire, $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble, $chemin_du_fichier_genere, $id_du_locataire, $id_du_studio_selectionne, $id_du_garant);

                                                                                                //
                                                                                                insertion_de_l_element_dans_la_base_de_donnees($contrat_courant);

                                                                                            }
                                                                                            //Sinon...
                                                                                            else
                                                                                            {

                                                                                                //
                                                                                                $surface_du_studio_pour_le_locataire = renvoi_du_libelle_de_la_surface_d_un_studio($numero_du_studio_pour_le_locataire);

                                                                                                //
                                                                                                if(est_element_present_dans_la_base($garant_courant) == False)
                                                                                                {

                                                                                                    //
                                                                                                    insertion_de_l_element_dans_la_base_de_donnees($garant_courant);

                                                                                                }

                                                                                                //
                                                                                                setlocale(LC_TIME, "fr_FR.utf8", "fra");

                                                                                                //
                                                                                                $date_du_jour = strftime("%A %d %B %Y", time());

                                                                                                //
                                                                                                $date_de_debut_du_contrat_de_location = strftime("%A %d %B %Y", $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                                                                                                //
                                                                                                $date_de_naissance_du_garant_a_inserer_dans_le_contrat = strftime("%A %d %B %Y", $date_de_naissance_du_garant_sous_forme_de_timestamp);

                                                                                                //
                                                                                                $date_de_naissance_du_locataire_a_inserer_dans_le_contrat = strftime("%A %d %B %Y", $date_de_naissance_du_locataire_sous_forme_de_timestamp);

                                                                                                //
                                                                                                if (strlen($numero_du_studio_pour_le_locataire) == 3) {

                                                                                                    //
                                                                                                    $numero_de_l_etage_du_studio = $numero_du_studio_pour_le_locataire[0];

                                                                                                } //Sinon...
                                                                                                else {

                                                                                                    //
                                                                                                    $numero_de_l_etage_du_studio = "rez-de-chaussée";

                                                                                                }

                                                                                                //
                                                                                                $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF('contrat_12_mois', array(

                                                                                                    "type_de_contrat" => "de 12 mois",
                                                                                                    "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule,
                                                                                                    "adresse_mail_du_locataire" => $adresse_email_du_locataire,
                                                                                                    "prenom_du_locataire" => $prenom_du_locataire_formate,
                                                                                                    "nom_de_famille_du_garant" => $nom_de_famille_du_garant_renseigne_dans_le_formulaire_et_mis_en_majuscule,
                                                                                                    "prenom_du_garant" => $prenom_du_garant_formate,
                                                                                                    "date_de_naissance_du_garant" => $date_de_naissance_du_garant_a_inserer_dans_le_contrat,
                                                                                                    "date_de_naissance_du_locataire" => $date_de_naissance_du_locataire_a_inserer_dans_le_contrat,
                                                                                                    "numero_de_l_etage" => $numero_de_l_etage_du_studio,
                                                                                                    "adresse_du_garant" => $adresse_d_habitation_du_garant,
                                                                                                    "numero_du_studio" => $numero_du_studio_pour_le_locataire,
                                                                                                    "surface_du_studio" => $surface_du_studio_pour_le_locataire,
                                                                                                    "date_debut_de_contrat" => $date_de_debut_du_contrat_de_location,
                                                                                                    "date_du_jour" => $date_du_jour,
                                                                                                    "date_de_la_reception_des_documents" => $date_du_jour,
                                                                                                    "montant_du_loyer" => $montant_de_la_location_pour_le_locataire,
                                                                                                    "montant_du_depot_de_garanti" => $montant_du_depot_de_garanti_pour_le_locataire

                                                                                                ));

                                                                                                //
                                                                                                $id_du_garant = renvoi_de_l_id_du_garant_a_partir_de_son_nom_et_prenom($nom_de_famille_du_garant_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_garant_formate);

                                                                                                //
                                                                                                $id_du_locataire = renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire_renseigne_dans_le_formulaire_et_mis_en_majuscule, $prenom_du_locataire_formate);

                                                                                                //
                                                                                                $date_du_jour_pour_insertion_dans_le_contrat_courant = date('Y-m-d');

                                                                                                //
                                                                                                $contrat_courant = new Contrat($id_du_type_de_contrat, $libelle_du_type_de_contrat_choisi, $date_de_debut_du_contrat_pour_le_locataire_sous_forme_de_String, $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_String, $date_du_jour_pour_insertion_dans_le_contrat_courant, $montant_de_la_location_pour_le_locataire, $choix_d_encaissement_du_depot_de_garanti_pour_le_locataire, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble, $chemin_du_fichier_genere, $id_du_locataire, $id_du_studio_selectionne, $id_du_garant);

                                                                                                //
                                                                                                //insertion_du_contrat_de_location_avec_archivage_du_precedent_dans_la_base_de_donnees($contrat_courant);
                                                                                                insertion_de_l_element_dans_la_base_de_donnees($contrat_courant);

                                                                                            }

                                                                                            //
                                                                                            confirmation_de_reussite_de_generation_du_document_PDF("Le contrat de location");

                                                                                        }
                                                                                        //Sinon...
                                                                                        else
                                                                                        {
                                                                                            //
                                                                                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La date de naissance du garant du locataire que vous avez renseigné est incohérente",
                                                                                                "description_de_l_erreur" => "La date de naissance du garant du locataire est strictement inférieure à la date de début de son contrat de location."));

                                                                                        }
                                                                                    }
                                                                                    //Sinon...
                                                                                    else
                                                                                    {
                                                                                        //
                                                                                        survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La date de naissance du garant du locataire que vous avez entré n'est pas valide",
                                                                                            "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                                                                    }
                                                                                }
                                                                                //Sinon...
                                                                                else
                                                                                {

                                                                                    //
                                                                                    survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date de naissance du garant du locataire, ce n'est pas une date que vous avez entré",
                                                                                        "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                                                                }
                                                                            }
                                                                            //Sinon...
                                                                            else
                                                                            {
                                                                                //
                                                                                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "L'adresse postale entrée est invalide",
                                                                                    "description_de_l_erreur" => "L'adresse d'habitation du garant du locataire ne doit contenir que des lettres, des chiffres, des espaces ou des tirets"));

                                                                            }
                                                                        }
                                                                        //Sinon...
                                                                        else
                                                                        {
                                                                            //
                                                                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                                                                                "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres, des espaces ou des tirets"));

                                                                        }
                                                                    }
                                                                }
                                                                //Sinon...
                                                                else
                                                                {
                                                                    //
                                                                    survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La saisie du numéro de studio est incorrecte",
                                                                        "description_de_l_erreur" => "Le numéro de studio renseigné n'est pas bon: Soit il n'est pas libre, soit il n'est pas occupé par le locataire"));

                                                                }

                                                            }
                                                            //
                                                            catch(PDOException $exception_concernant_l_enregistrement_du_locataire_dans_la_base)
                                                            {
                                                                //
                                                                survenance_d_une_erreur_de_generation_du_document_PDF(array("message_d_erreur_de_connexion_a_la_base_de_donnees" => $exception_concernant_l_enregistrement_du_locataire_dans_la_base->getMessage()));

                                                            }

                                                        }
                                                        //Sinon...
                                                        else
                                                        {

                                                            //
                                                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Le numéro de téléphone renseigné n'est pas valide",
                                                                "description_de_l_erreur" => "Un numéro de téléphone est entiérement composé de 10 chiffres, commençant par 0 et sans espace"));

                                                        }

                                                    }
                                                    //Sinon...
                                                    else
                                                        {

                                                        //
                                                        survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Les dates que vous avez renseignés sont incohérentes",
                                                            "description_de_l_erreur" => "La date de naissance du locataire est strictement inférieure à la date de début de son contrat de location.
                                                                                            Sa date d'arrivée dans la résidence est supérieur ou égal à la date de début de son contrat de location.
                                                                                            Et la date de début de son contrat de location est strictement inférieur à la date de début de son contrat de location"));

                                                    }

                                                }
                                                //Sinon...
                                                else
                                                    {

                                                    //
                                                    survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La date de fin du contrat du locataire que vous avez entré n'est pas valide",
                                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                                }

                                            }
                                            //Sinon...
                                            else
                                                {

                                                //
                                                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date de fin du contrat du locataire, ce n'est pas une date que vous avez entré",
                                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                            }

                                        }
                                        //Sinon...
                                        else
                                        {

                                            //
                                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La date d'arrivée du locataire que vous avez entré n'est pas valide",
                                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                        }

                                    }
                                    //Sinon...
                                    else
                                    {

                                        //
                                        survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date d'arrivée du locataire dans son studio, ce n'est pas une date que vous avez entré",
                                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                                    }

                                }
                                //Sinon...
                                else
                                {

                                    //
                                    survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La date de debut du contrat du locataire que vous avez entré n'est pas valide",
                                        "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                                }

                            }
                            //Sinon...
                            else
                            {

                                //
                                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date de debut du contrat du locataire, ce n'est pas une date que vous avez entré",
                                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                            }

                        }
                        //Sinon...
                        else
                        {

                            //
                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "La date de naissance du locataire que vous avez entré n'est pas valide",
                                "description_de_l_erreur" => "La date entrée doit être au format suivant: mois/jour/année"));

                        }

                    }
                    //Sinon...
                    else
                    {

                        //
                        survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date de naissance du locataire, ce n'est pas une date que vous avez entré",
                            "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                    }

                }
                //Sinon...
                else {

                    //
                    survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "L'adresse postale entrée est invalide",
                        "description_de_l_erreur" => "L'adresse d'habitation du locataire ne doit contenir que des lettres, des chiffres, des espaces ou des tirets"));

                }

            }
            //Sinon...
            else {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Le nom et/ou le prenom renseignés sont invalides",
                    "description_de_l_erreur" => "Le nom et le prenom ne doivent contenir que des lettres sans accents, des espaces ou des tirets"));

            }
        }
        //
        elseif($_POST['type_de_document'] == 'expiration_de_contrat_de_location')
        {

            //
            try {

                //
                $nom_et_prenom_du_locataire_sous_forme_de_valeur = htmlspecialchars($_POST['locataire_a_chosir']);

                //
                $nom_et_prenom_du_locataire_sous_forme_de_tableau = explode(" ", $nom_et_prenom_du_locataire_sous_forme_de_valeur);

                //
                $nom_de_famille_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[0];

                //
                $prenom_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[1];

                //
                $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp = renvoi_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                setlocale(LC_TIME, "fr_FR.utf8", "fra");

                //
                $date_de_la_fin_du_contrat_du_locataire_au_format_francophone = strftime("%A %d %B %Y", $date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                //
                $prenom_du_locataire_formate = formatage_du_prenom_pour_ne_mettre_que_les_premieres_lettres_en_majuscule($prenom_du_locataire);

                //
                $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF("expiration_de_contrat_de_location", array(

                    "prenom_du_locataire" => $prenom_du_locataire_formate,

                    "numero_du_studio" => $numero_du_studio_occuppe_par_le_locataire,

                    "date_de_la_fin_du_contrat_du_locataire" => $date_de_la_fin_du_contrat_du_locataire_au_format_francophone

                ));

                //
                $id_du_contrat_de_location = renvoi_de_l_id_du_contrat_de_location_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $id_du_studio_occuppe_par_le_locataire = renvoi_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_occuppe_par_le_locataire);

                //
                $date_de_conversion_de_la_date_de_fin_de_contrat_de_Timestamp_a_DateTime = new DateTime();

                //
                $date_de_conversion_de_la_date_de_fin_de_contrat_de_Timestamp_a_DateTime->setTimestamp($date_de_fin_du_contrat_pour_le_locataire_sous_forme_de_timestamp);

                //
                $date_de_fin_du_contrat_du_locataire_sous_forme_de_DateTime = $date_de_conversion_de_la_date_de_fin_de_contrat_de_Timestamp_a_DateTime->format("Y-m-d H:i:s");

                //
                $date_et_heure_du_jour_sous_forme_de_timestamp = time();

                //
                $date_du_jour = date("Y-m-d");

                //
                $expiration_courante_de_contrat_de_location = new Expiration_de_contrat_de_location($nom_de_famille_du_locataire, $prenom_du_locataire, $id_du_studio_occuppe_par_le_locataire, $date_de_fin_du_contrat_du_locataire_sous_forme_de_DateTime, $chemin_du_fichier_genere, $date_du_jour, $id_du_contrat_de_location);

                //
                insertion_de_l_element_dans_la_base_de_donnees($expiration_courante_de_contrat_de_location);

                //
                confirmation_de_reussite_de_generation_du_document_PDF("L'expiration de contrat de location");

            }
            //
            catch(PDOException $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur concernant les opérations sur la base de données",
                    "description_de_l_erreur" => "Une erreur concernant les opérations sur la base de données est survenue, la voici: " . $exception->getMessage() ));

            }
            //
            catch(Exception $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Exception",
                    "description_de_l_erreur" => "Une exception s'est produite, voici son message: " . $exception->getMessage() ));

            }
            //
            catch(Error $error)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur",
                    "description_de_l_erreur" => "Une erreur s'est produite, voici son message: " . $error->getMessage() ));

            }
        }
        //
        elseif($_POST['type_de_document'] == 'attestation')
        {

            //
            try {

                //
                $nom_et_prenom_du_locataire_sous_forme_de_valeur = htmlspecialchars($_POST['locataire_a_chosir']);

                //
                $nom_et_prenom_du_locataire_sous_forme_de_tableau = explode(" ", $nom_et_prenom_du_locataire_sous_forme_de_valeur);

                //
                $nom_de_famille_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[0];

                //
                $prenom_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[1];

                //
                $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp = renvoi_de_la_date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $date_et_heure_du_jour_sous_forme_de_timestamp = time();

                //
                setlocale(LC_TIME, "fr_FR.utf8", "fra");

                //
                $date_du_jour_pour_insertion_dans_le_document_PDF = strftime("%A %d %B %Y");

                //
                $date_d_arrivee_du_locataire_dans_son_studio_sous_format_francophone = strftime("%A %d %B %Y", $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp);

                //
                $date_du_jour = date("Y-m-d");

                //
                $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF("attestation", array(

                    "nom_du_locataire" => $nom_de_famille_du_locataire,

                    "prenom_du_locataire" => $prenom_du_locataire,

                    "numero_du_studio" => $numero_du_studio_occuppe_par_le_locataire,

                    "date_du_jour" => $date_du_jour_pour_insertion_dans_le_document_PDF,

                    "date_d_arrivee_dans_la_residence" => $date_d_arrivee_du_locataire_dans_son_studio_sous_format_francophone

                ));

                //
                $id_du_contrat_de_location = renvoi_de_l_id_du_contrat_de_location_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $attestation_courante = new Attestation($date_du_jour, $chemin_du_fichier_genere, $id_du_contrat_de_location);

                //
                insertion_de_l_element_dans_la_base_de_donnees($attestation_courante);

                //
                confirmation_de_reussite_de_generation_du_document_PDF("Attestation");

            }
            //
            catch(PDOException $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur concernant les opérations sur la base de données",
                    "description_de_l_erreur" => "Une erreur concernant les opérations sur la base de données est survenue, la voici: " . $exception->getMessage() ));

            }
                //
            catch(Exception $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Exception",
                    "description_de_l_erreur" => "Une exception s'est produite, voici son message: " . $exception->getMessage() ));

            }
                //
            catch(Error $error)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur",
                    "description_de_l_erreur" => "Une erreur s'est produite, voici son message: " . $error->getMessage() ));

            }
        }
        //
        elseif($_POST['type_de_document'] == 'relance_loyer_impaye')
        {

            //
            try {

                //
                $nom_et_prenom_du_locataire_sous_forme_de_valeur = htmlspecialchars($_POST['locataire_a_chosir']);

                //
                $nom_et_prenom_du_locataire_sous_forme_de_tableau = explode(" ", $nom_et_prenom_du_locataire_sous_forme_de_valeur);

                //
                $nom_de_famille_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[0];

                //
                $prenom_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[1];

                //
                $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $montant_du_loyer_impaye_pour_le_locataire = htmlspecialchars($_POST['montant_du_loyer_impaye']);

                //
                setlocale(LC_TIME, "fr_FR.utf8", "fra");

                //
                $date_du_jour = strftime("%A %d %B %Y");

                //
                $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF("relance_loyer_impaye", array(

                    "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire,

                    "prenom_du_locataire" => $prenom_du_locataire,

                    "numero_du_studio" => $numero_du_studio_occuppe_par_le_locataire,

                    "date_du_jour" => $date_du_jour,

                    "montant_a_debiter_pour_le_loyer" => $montant_du_loyer_impaye_pour_le_locataire

                ));

                //
                $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $id_du_studio_occuppe_par_le_locataire = renvoi_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_occuppe_par_le_locataire);

                //
                $id_du_contrat_de_location = renvoi_de_l_id_du_contrat_de_location_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $relance_courante_pour_le_loyer_impaye = new Relance_loyer_impaye($nom_de_famille_du_locataire, $prenom_du_locataire, $id_du_studio_occuppe_par_le_locataire, $date_du_jour, $montant_du_loyer_impaye_pour_le_locataire, $chemin_du_fichier_genere, $id_du_contrat_de_location);

                //
                insertion_de_l_element_dans_la_base_de_donnees($relance_courante_pour_le_loyer_impaye);

                //
                confirmation_de_reussite_de_generation_du_document_PDF("Relance impayé");

            }
            //
            catch(PDOException $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur concernant les opérations sur la base de données",
                    "description_de_l_erreur" => "Une erreur concernant les opérations sur la base de données est survenue, la voici: " . $exception->getMessage() ));

            }
                //
            catch(Exception $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Exception",
                    "description_de_l_erreur" => "Une exception s'est produite, voici son message: " . $exception->getMessage() ));

            }
                //
            catch(Error $error)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur",
                    "description_de_l_erreur" => "Une erreur s'est produite, voici son message: " . $error->getMessage() ));

            }
        }
        //
        elseif($_POST['type_de_document'] == 'etiquette')
        {

            //
            try {

                //
                $nom_et_prenom_du_locataire_sous_forme_de_valeur = htmlspecialchars($_POST['locataire_a_chosir']);

                //
                $nom_et_prenom_du_locataire_sous_forme_de_tableau = explode(" ", $nom_et_prenom_du_locataire_sous_forme_de_valeur);

                //
                $nom_de_famille_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[0];

                //
                $prenom_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[1];

                //
                $premiere_lettre_du_prenom_du_locataire = $prenom_du_locataire[0];

                //
                $premiere_lettre_du_prenom_du_locataire_en_majuscule = strtoupper($premiere_lettre_du_prenom_du_locataire);

                //
                $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                if (strlen($numero_du_studio_occuppe_par_le_locataire) == 3) {

                    //
                    $numero_de_l_etage_du_studio = $numero_du_studio_occuppe_par_le_locataire[0];

                } //Sinon...
                else {

                    //
                    $numero_de_l_etage_du_studio = "rez-de-chaussée";

                }

                //
                generation_d_un_document_sous_format_PDF("etiquette", array(

                    "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire,

                    "lettre_prenom" => $premiere_lettre_du_prenom_du_locataire_en_majuscule . ".",

                    "numero_du_studio" => $numero_du_studio_occuppe_par_le_locataire,

                    "numero_de_l_etage_du_studio" => $numero_de_l_etage_du_studio

                ));
            }
            //
            catch(PDOException $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur concernant les opérations sur la base de données",
                    "description_de_l_erreur" => "Une erreur concernant les opérations sur la base de données est survenue, la voici: " . $exception->getMessage() ));

            }
                //
            catch(Exception $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Exception",
                    "description_de_l_erreur" => "Une exception s'est produite, voici son message: " . $exception->getMessage() ));

            }
                //
            catch(Error $error)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur",
                    "description_de_l_erreur" => "Une erreur s'est produite, voici son message: " . $error->getMessage() ));

            }
        }
        //
        elseif($_POST['type_de_document'] == 'etat_des_lieux_lors_d_un_depart_anticipe')
        {

            //
            $nom_et_prenom_du_locataire_sous_forme_de_valeur = htmlspecialchars($_POST['locataire_a_chosir']);

            //
            $nom_et_prenom_du_locataire_sous_forme_de_tableau = explode(" ", $nom_et_prenom_du_locataire_sous_forme_de_valeur);

            //
            $nom_de_famille_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[0];

            //
            $prenom_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[1];

            //
            $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

            //
            $id_du_contrat_de_location = renvoi_de_l_id_du_contrat_de_location_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire);

            //
            $date_choisie_pour_l_etat_des_lieux = htmlspecialchars($_POST['date_choisie_pour_l_etat_des_lieux']);

            //
            $heure_choisie_pour_l_etat_des_lieux = htmlspecialchars($_POST['heure_choisie_pour_l_etat_des_lieux']);

            //
            if(verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_choisie_pour_l_etat_des_lieux))
            {

                //
                if(verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_choisie_pour_l_etat_des_lieux))
                {

                        //
                        try {

                            //
                            $date_choisie_pour_l_etat_des_lieux_sous_toutes_ses_formes = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_choisie_pour_l_etat_des_lieux);

                            //
                            $date_choisie_pour_l_etat_des_lieux_sous_forme_de_timestamp = $date_choisie_pour_l_etat_des_lieux_sous_toutes_ses_formes['timestamp'];

                            //
                            //
                            $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp = renvoi_de_la_date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire);

                            //
                            $date_de_depart_du_locataire_sous_forme_de_timestamp = renvoi_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire);

                            //
                            setlocale(LC_TIME, "fr_FR.utf8", "fra");

                            //
                            $date_d_arrivee_du_locataire_dans_son_studio_sous_format_francophone = strftime("%A %d %B %Y", $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp);

                            //
                            $date_de_depart_initial_du_locataire_au_format_francophone = strftime("%A %d %B %Y", $date_de_depart_du_locataire_sous_forme_de_timestamp);

                            //
                            $date_choisie_pour_l_etat_des_lieux_au_format_francophone = strftime("%A %d %B %Y", $date_choisie_pour_l_etat_des_lieux_sous_forme_de_timestamp);

                            //
                            $date_du_jour = strftime("%A %d %B %Y");

                            //
                            $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF("etat_des_lieux_lors_de_sortie_anticipee", array(

                                "nom_de_famille_du_locataire" => $nom_de_famille_du_locataire,

                                "prenom_du_locataire" => $prenom_du_locataire,

                                "numero_du_studio" => $numero_du_studio_occuppe_par_le_locataire,

                                "date_du_jour" => $date_du_jour,

                                "civilite_du_locataire" => "Monsieur/Madame",

                                "date_choisie_pour_l_etat_des_lieux" => $date_choisie_pour_l_etat_des_lieux_au_format_francophone,

                                "heure_choisie_pour_l_etat_des_lieux" => $heure_choisie_pour_l_etat_des_lieux,

                                "date_d_arrivee_dans_la_residence" => $date_d_arrivee_du_locataire_dans_son_studio_sous_format_francophone,

                                "date_de_fin" => $date_de_depart_initial_du_locataire_au_format_francophone

                            ));

                            //
                            $date_programee_sous_forme_de_chaine_de_caractere = renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_choisie_pour_l_etat_des_lieux);

                            //
                            $date_et_heure_programees_sous_forme_de_timestamp = strtotime($date_programee_sous_forme_de_chaine_de_caractere['chaine_de_caracteres'] . " " . $heure_choisie_pour_l_etat_des_lieux);

                            //
                            $date_et_heure_programees = strftime("%G-%m-%d %H:%M:%S", $date_et_heure_programees_sous_forme_de_timestamp);

                            //
                            $date_et_heure_du_jour_sous_forme_de_timestamp = time();

                            //
                            $date_du_jour = date("Y-m-d");

                            //
                            $etat_des_lieux_courant = new Etat_des_lieux($date_du_jour, $chemin_du_fichier_genere, $id_du_contrat_de_location, $date_et_heure_programees);

                            //
                            insertion_de_l_element_dans_la_base_de_donnees($etat_des_lieux_courant);

                            //
                            confirmation_de_reussite_de_generation_du_document_PDF("Etat des lieux lors d'une sortie anticipée");

                        }
                        //
                        catch(PDOException $exception)
                        {

                            //
                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur concernant les opérations sur la base de données",
                                "description_de_l_erreur" => "Une erreur concernant les opérations sur la base de données est survenue, la voici: " . $exception->getMessage() ));

                        }
                            //
                        catch(Exception $exception)
                        {

                            //
                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Exception",
                                "description_de_l_erreur" => "Une exception s'est produite, voici son message: " . $exception->getMessage() ));

                        }
                            //
                        catch(Error $error)
                        {

                            //
                            survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur",
                                "description_de_l_erreur" => "Une erreur s'est produite, voici son message: " . $error->getMessage() ));

                        }
                }
                //Sinon...
                else
                {

                    //
                    survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date choisie pour l'état des lieux, ce n'est pas une date que vous avez entré",
                        "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

                }

            }
            //Sinon...
            else
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Pour la date choisie pour l'état des lieux, ce n'est pas une date que vous avez entré",
                    "description_de_l_erreur" => "Une date ne peut être autre chose que 3 nombres séparés les uns des autres par un slash"));

            }

        }
        //
        elseif($_POST['type_de_document'] == 'preavis')
        {

            //
            try {

                //
                $nom_et_prenom_du_locataire_sous_forme_de_valeur = htmlspecialchars($_POST['locataire_a_chosir']);

                //
                $nom_et_prenom_du_locataire_sous_forme_de_tableau = explode(" ", $nom_et_prenom_du_locataire_sous_forme_de_valeur);

                //
                $nom_de_famille_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[0];

                //
                $prenom_du_locataire = $nom_et_prenom_du_locataire_sous_forme_de_tableau[1];

                //
                $id_du_contrat_de_location = renvoi_de_l_id_du_contrat_de_location_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $numero_du_studio_occuppe_par_le_locataire = renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                $date_de_depart_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp = renvoi_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire);

                //
                setlocale(LC_TIME, "fr_FR.utf8", "fra");

                //
                $date_du_jour_pour_insertion_dans_le_document_PDF = strftime("%A %d %B %Y");

                //
                $date_de_depart_du_locataire_au_format_francophone = strftime("%A %d %B %Y", $date_de_depart_du_locataire_entree_dans_le_formulaire_sous_forme_de_timestamp);

                //
                $chemin_du_fichier_genere = generation_d_un_document_sous_format_PDF("preavis", array(

                    "nom_du_locataire" => $nom_de_famille_du_locataire,

                    "prenom_du_locataire" => $prenom_du_locataire,

                    "numero_du_studio" => $numero_du_studio_occuppe_par_le_locataire,

                    "date_du_jour" => $date_du_jour_pour_insertion_dans_le_document_PDF,

                    "civilite_du_locataire" => "Monsieur/Madame",

                    "date_de_depart_du_locataire" => $date_de_depart_du_locataire_au_format_francophone

                ));

                //
                $preavis_courant = new Preavis($date_du_jour_pour_insertion_dans_le_document_PDF, $chemin_du_fichier_genere, $id_du_contrat_de_location);

                //
                insertion_de_l_element_dans_la_base_de_donnees($preavis_courant);

                //
                confirmation_de_reussite_de_generation_du_document_PDF("préavis de départ");

            }
            //
            catch(PDOException $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur concernant les opérations sur la base de données",
                    "description_de_l_erreur" => "Une erreur concernant les opérations sur la base de données est survenue, la voici: " . $exception->getMessage() ));

            }
                //
            catch(Exception $exception)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Exception",
                    "description_de_l_erreur" => "Une exception s'est produite, voici son message: " . $exception->getMessage() ));

            }
                //
            catch(Error $error)
            {

                //
                survenance_d_une_erreur_de_generation_du_document_PDF(array("intitule_de_l_erreur" => "Erreur",
                    "description_de_l_erreur" => "Une erreur s'est produite, voici son message: " . $error->getMessage() ));

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