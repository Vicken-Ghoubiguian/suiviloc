<?php

    //
    require_once('classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php');

    //
    function contient_l_element_passe_en_parametre($chaine_de_caractere_dans_lequel_trouver_l_element, $element_a_trouver)
    {

        $variable_de_retour = False;

        for($incrementeur = 0; $incrementeur < strlen($chaine_de_caractere_dans_lequel_trouver_l_element); $incrementeur++)
        {
            if($chaine_de_caractere_dans_lequel_trouver_l_element[$incrementeur] == $element_a_trouver)
            {
                $variable_de_retour = True;
            }
        }

        return $variable_de_retour;

    }

    //
    function verification_de_la_validite_du_nom_et_du_prenom($nom_de_famille_passe_en_parametre, $prenom_passe_en_parametre)
    {

        $variable_de_retour = True;

        //On commence par le nom de famille
        for($incrementeur_du_nom_de_famille = 0; $incrementeur_du_nom_de_famille < strlen($nom_de_famille_passe_en_parametre); $incrementeur_du_nom_de_famille++)
        {

            //
            if(!(ctype_alpha($nom_de_famille_passe_en_parametre[$incrementeur_du_nom_de_famille])
                || ctype_space($nom_de_famille_passe_en_parametre[$incrementeur_du_nom_de_famille])
                || ($nom_de_famille_passe_en_parametre[$incrementeur_du_nom_de_famille] == "-")
            )
            )
            {
                $variable_de_retour = False;
            }

        }

        //On termine par le prenom
        for($incrementeur_du_prenom = 0; $incrementeur_du_prenom < strlen($prenom_passe_en_parametre); $incrementeur_du_prenom++)
        {

            //
            if(!(ctype_alpha($prenom_passe_en_parametre[$incrementeur_du_prenom])
                || ctype_space($prenom_passe_en_parametre[$incrementeur_du_prenom])
                || ($prenom_passe_en_parametre[$incrementeur_du_prenom] == '-')
            )
            )
            {
                $variable_de_retour = False;
            }

        }

        return $variable_de_retour;
    }

    //
    function verification_de_la_validite_de_l_adresse($adresse_d_habitation_du_locataire)
    {
        $variable_de_retour = True;

        for($incrementeur_de_l_adresse_d_habitation_du_locataire = 0; $incrementeur_de_l_adresse_d_habitation_du_locataire < strlen($adresse_d_habitation_du_locataire); $incrementeur_de_l_adresse_d_habitation_du_locataire++)
        {

            if(!(ctype_alnum($adresse_d_habitation_du_locataire[$incrementeur_de_l_adresse_d_habitation_du_locataire]) ||
                ctype_space($adresse_d_habitation_du_locataire[$incrementeur_de_l_adresse_d_habitation_du_locataire]) ||
                $adresse_d_habitation_du_locataire[$incrementeur_de_l_adresse_d_habitation_du_locataire] == "'" ||
                $adresse_d_habitation_du_locataire[$incrementeur_de_l_adresse_d_habitation_du_locataire] == "-" ||
                $adresse_d_habitation_du_locataire[$incrementeur_de_l_adresse_d_habitation_du_locataire] == ","))
            {
                $variable_de_retour = False;
            }

        }

        return $variable_de_retour;
    }

    //
    function verification_de_la_validite_de_la_date_sous_l_angle_de_ses_donnees($date_passee_en_parametre)
    {

        $variable_de_retour = True;

        for($incrementeur_pour_la_date = 0; $incrementeur_pour_la_date < strlen($date_passee_en_parametre); $incrementeur_pour_la_date++)
        {
            if(!($date_passee_en_parametre[$incrementeur_pour_la_date] == "/" || ctype_digit($date_passee_en_parametre[$incrementeur_pour_la_date])))
            {

                $variable_de_retour = False;

            }

            if(!contient_l_element_passe_en_parametre($date_passee_en_parametre,"/"))
            {

                $variable_de_retour = False;

            }
        }

        return $variable_de_retour;
    }

    //
    function verification_de_la_validite_d_une_date_sous_l_angle_des_valeurs_renseignees_pour_le_mois_et_le_jour($date_passee_en_parametre)
    {

        $variable_de_retour = True;

        $date_passee_en_parametre_sous_forme_de_tableau = explode("/",$date_passee_en_parametre);

        if(sizeof($date_passee_en_parametre_sous_forme_de_tableau) != 3)
        {
            $variable_de_retour = False;
        }

        if($date_passee_en_parametre_sous_forme_de_tableau[0] > 12 || $date_passee_en_parametre_sous_forme_de_tableau[0] < 1)
        {
            $variable_de_retour = False;
        }

        if($date_passee_en_parametre_sous_forme_de_tableau[1] > 31 || $date_passee_en_parametre_sous_forme_de_tableau[1] < 1)
        {

        }

        return $variable_de_retour;
    }

    //
    function verification_de_la_validite_d_un_numero_de_telephone_portable($numero_de_telephone_passe_en_parametre)
    {

        $variable_de_retour = True;

        if(strlen($numero_de_telephone_passe_en_parametre) == 10)
        {

            for($incrementeur = 0; $incrementeur < 10; $incrementeur++)
            {

                if(!ctype_digit($numero_de_telephone_passe_en_parametre[$incrementeur]))
                {

                    $variable_de_retour = False;

                }

            }

        }
        else
        {

            $variable_de_retour = False;

        }

        return $variable_de_retour;
    }

    //
    function verification_de_la_pertinance_des_donnees_renseignees($nom_de_famille_du_locataire, $prenom_du_locataire, $numero_de_studio_du_locataire, $date_d_arrivee_sous_forme_de_datetime_SQL)
    {

        $variable_de_retour = True;

        $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Locataire.id FROM Locataire WHERE Locataire.nom = :nom_de_famille_du_locataire AND Locataire.prenom = :prenom_du_locataire AND Locataire.date_d_arrivee = :date_d_arrivee");

        $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom->bindParam(":nom_de_famille_du_locataire", $nom_de_famille_du_locataire);

        $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom->bindParam(":prenom_du_locataire", $prenom_du_locataire);

        $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom->bindParam(":date_d_arrivee", $date_d_arrivee_sous_forme_de_datetime_SQL);

        $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom->execute();

        $nombre_de_resultats_concernant_la_requete = $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom->rowCount();

        $resultat_de_la_requete_de_selection_de_l_id_du_locataire = $requete_de_selection_de_l_id_du_locataire_a_partir_de_son_nom_de_famille_et_de_son_prenom->fetchAll(PDO::FETCH_BOTH);

        if($nombre_de_resultats_concernant_la_requete != 1)
        {

            $variable_de_retour = False;
        }
        else
        {

            $id_du_locataire = $resultat_de_la_requete_de_selection_de_l_id_du_locataire[0][0];

            $requete_de_selection_du_contrat_de_location_correspondant_aux_informations_donnees = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Contrat.id FROM Contrat WHERE Contrat.studio = :numero_de_studio_du_locataire AND Contrat.locataire = :id_du_locataire");

            $requete_de_selection_du_contrat_de_location_correspondant_aux_informations_donnees->bindParam(":numero_de_studio_du_locataire", $numero_de_studio_du_locataire);

            $requete_de_selection_du_contrat_de_location_correspondant_aux_informations_donnees->bindParam(":id_du_locataire", $id_du_locataire);

            $requete_de_selection_du_contrat_de_location_correspondant_aux_informations_donnees->execute();

            $nombre_de_resultats_concernant_la_requete = $requete_de_selection_du_contrat_de_location_correspondant_aux_informations_donnees->rowCount();

            if($nombre_de_resultats_concernant_la_requete != 1)
            {

                $variable_de_retour = False;

            }

        }

        return $variable_de_retour;

    }

    //
    function recuperation_du_libelle_du_type_du_contrat_de_location_a_partir_des_donnees_renseignees_dans_le_formulaire($type_de_contrat_choisi_sous_forme_d_id, $ensemble_des_conditions_choisies_pour_le_contrat_de_location)
    {

        $libelle_du_type_de_contrat = "";

        if($type_de_contrat_choisi_sous_forme_d_id == 1)
        {
            $libelle_du_type_de_contrat .= "0-3 mois ";

            if($ensemble_des_conditions_choisies_pour_le_contrat_de_location == 1)
            {
                $libelle_du_type_de_contrat .= "avec EDF";

            }
            elseif($ensemble_des_conditions_choisies_pour_le_contrat_de_location == 2)
            {
                $libelle_du_type_de_contrat .= "sans EDF";

            }
        }
        elseif($ensemble_des_conditions_choisies_pour_le_contrat_de_location == 2)
        {
            $libelle_du_type_de_contrat .= "A l'année";

        }

        return $libelle_du_type_de_contrat;
    }

    //
    function recuperation_de_l_id_de_type_de_contrat_a_partir_de_son_libelle($libelle_du_type_de_contrat)
    {

        $requete_re_recuperation_de_l_id_de_type_de_contrat = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Type_de_contrat WHERE Type_de_contrat.libelle_du_type_de_contrat = :libelle_du_type_de_contrat");

        $requete_re_recuperation_de_l_id_de_type_de_contrat->bindParam(":libelle_du_type_de_contrat", $libelle_du_type_de_contrat);

        $requete_re_recuperation_de_l_id_de_type_de_contrat->execute();

        $resultat_de_la_requete_re_recuperation_de_l_id_de_type_de_contrat = $requete_re_recuperation_de_l_id_de_type_de_contrat->fetchAll(PDO::FETCH_BOTH);

        return $resultat_de_la_requete_re_recuperation_de_l_id_de_type_de_contrat[0][0];
    }

//
function mise_en_evidence_de_l_ensemble_des_conditions_du_contrat_de_location($ensemble_des_conditions_choisies_pour_le_contrat_du_locataire)
{
    $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif = array(
        'inclusion_edf' => 0,
        'inclusion_eau' => 0,
        'inclusion_internet' => 0,
        'inclusion_assurance_locative' => 0,
        'inclusion_charges_immeuble' => 0,
        'tom_en_sus' => 0
    );

    if($ensemble_des_conditions_choisies_pour_le_contrat_du_locataire == 1)
    {
        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_edf'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_eau'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_internet'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_assurance_locative'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_charges_immeuble'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['tom_en_sus'] = 1;

    }
    elseif($ensemble_des_conditions_choisies_pour_le_contrat_du_locataire == 2)
    {

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_eau'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_internet'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_assurance_locative'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_charges_immeuble'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['tom_en_sus'] = 1;

    }
    elseif($ensemble_des_conditions_choisies_pour_le_contrat_du_locataire == 3)
    {
        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_eau'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_internet'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['inclusion_charges_immeuble'] = 1;

        $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif['tom_en_sus'] = 1;

    }

    return $ensemble_des_conditions_du_contrat_de_location_sous_forme_de_tableau_associatif;
}

    //
    function recuperation_de_l_id_d_un_element_passe_en_parametre($element_dont_on_veut_trouver_son_id)
    {

        $id_de_l_element_en_question = 0;

        if(is_a($element_dont_on_veut_trouver_son_id,'Locataire'))
        {

            $nom_de_famille_du_locataire = $element_dont_on_veut_trouver_son_id->getNom_du_locataire();

            $prenom_du_locataire = $element_dont_on_veut_trouver_son_id->getPrenom_du_locataire();

            $date_d_arriver_du_locataire = $element_dont_on_veut_trouver_son_id->getDate_d_arriver();

            $date_de_naissance_du_locataire = $element_dont_on_veut_trouver_son_id->getDate_de_naissance();

            $adresse_d_habitation_du_locataire = $element_dont_on_veut_trouver_son_id->getAdresse_d_habitation();

            $type_de_public_du_locataire = $element_dont_on_veut_trouver_son_id->getType_de_public();

            $numero_de_telephone_du_locataire = $element_dont_on_veut_trouver_son_id->getNumero_de_telephone();

            $date_d_arriver_du_locataire_sous_forme_de_String = $date_d_arriver_du_locataire->format("Y-m-d");

            $date_de_naissance_du_locataire_sous_forme_de_String = $date_de_naissance_du_locataire->format("Y-m-d");

            $requete_preparee_pour_la_recuperation_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE Locataire.nom = :nom_de_famille_du_locataire AND Locataire.prenom = :prenom_du_locataire AND Locataire.adresse_d_habitation = :adresse_d_habitation_du_locataire AND Locataire.type_de_public = :type_de_public_du_locataire AND Locataire.date_d_arrivee = :date_d_arrivee_du_locataire AND Locataire.date_de_naissance = :date_de_naissance_du_locataire AND Locataire.numero_de_telephone = :numero_de_telephone_du_locataire");

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":nom_de_famille_du_locataire", $nom_de_famille_du_locataire);

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":prenom_du_locataire", $prenom_du_locataire);

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":adresse_d_habitation_du_locataire", $adresse_d_habitation_du_locataire);

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":type_de_public_du_locataire", $type_de_public_du_locataire);

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":date_d_arrivee_du_locataire", $date_d_arriver_du_locataire_sous_forme_de_String);

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":date_de_naissance_du_locataire", $date_de_naissance_du_locataire_sous_forme_de_String);

            $requete_preparee_pour_la_recuperation_du_locataire->bindParam(":numero_de_telephone_du_locataire", $numero_de_telephone_du_locataire);

            $requete_preparee_pour_la_recuperation_du_locataire->execute();

            $nombre_de_resultats_compris_dans_la_requete = $requete_preparee_pour_la_recuperation_du_locataire->rowCount();

            if($nombre_de_resultats_compris_dans_la_requete == 1)
            {
                $resultat_de_la_requete_preparee_pour_la_recuperation_du_locataire = $requete_preparee_pour_la_recuperation_du_locataire->fetchAll(PDO::FETCH_BOTH);

                $id_de_l_element_en_question = $resultat_de_la_requete_preparee_pour_la_recuperation_du_locataire[0][0];

            }

        }
        elseif(is_a($element_dont_on_veut_trouver_son_id, 'Contrat'))
        {

            $libelle_du_type_de_contrat = $element_dont_on_veut_trouver_son_id->getLibelle_du_type_de_contrat();

            $date_de_debut_du_contrat = $element_dont_on_veut_trouver_son_id->getDate_de_debut();

            $date_de_fin_du_contrat = $element_dont_on_veut_trouver_son_id->getDate_de_fin();

            $montant_du_loyer = $element_dont_on_veut_trouver_son_id->getMontant_du_loyer();

            $encaissement_du_depot_de_garantie = $element_dont_on_veut_trouver_son_id->getEncaissement_du_depot_de_garantie();

            $inclusion_EDF = $element_dont_on_veut_trouver_son_id->getInclusion_EDF();

            $inclusion_eau = $element_dont_on_veut_trouver_son_id->getInclusion_eau();

            $inclusion_internet = $element_dont_on_veut_trouver_son_id->getInclusion_internet();

            $inclusion_assurance_locative = $element_dont_on_veut_trouver_son_id->getInclusion_assurance_locative();

            $inclusion_charges_immeuble = $element_dont_on_veut_trouver_son_id->getInclusion_charges_immeuble();

            $chemin_du_fichier_genere = $element_dont_on_veut_trouver_son_id->getChemin_du_fichier_genere();

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Ensemble_des_conditions_du_contrat WHERE Ensemble_des_conditions_du_contrat.inclusion_edf = :inclusion_edf AND Ensemble_des_conditions_du_contrat.inclusion_eau = :inclusion_eau AND Ensemble_des_conditions_du_contrat.inclusion_internet = :inclusion_internet AND Ensemble_des_conditions_du_contrat.inclusion_assurance_locative = :inclusion_assurance_locative AND Ensemble_des_conditions_du_contrat.inclusion_charges_immeuble = :inclusion_charges_immeuble");

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_edf", $inclusion_EDF);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_eau", $inclusion_eau);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_internet", $inclusion_internet);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_assurance_locative", $inclusion_assurance_locative);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_charges_immeuble", $inclusion_charges_immeuble);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->execute();

            $nombre_de_resultats_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat = $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->rowCount();

            if($nombre_de_resultats_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat == 1)
            {

                $resultat_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat = $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->fetchAll(PDO::FETCH_BOTH);

                $id_de_l_ensemble_des_conditions_du_contrat = $resultat_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat[0][0];

                $requete_preparee_pour_la_recuperation_de_l_id_du_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("");

            }

        }
        elseif(is_a($element_dont_on_veut_trouver_son_id,'Garant'))
        {

        }
        elseif(is_a($element_dont_on_veut_trouver_son_id,'Studio'))
        {

        }
        else
        {
            $id_de_l_element_en_question = 0;

        }

        return $id_de_l_element_en_question;
    }

    //
    function est_element_present_dans_la_base($element_qu_on_cherche_dans_la_base)
    {

        $variable_de_retour = False;

        if(is_a($element_qu_on_cherche_dans_la_base,'Locataire'))
        {

            $nom_de_famille_du_locataire = $element_qu_on_cherche_dans_la_base->getNom_du_locataire();

            $prenom_du_locataire = $element_qu_on_cherche_dans_la_base->getPrenom_du_locataire();

            $date_d_arriver_du_locataire = $element_qu_on_cherche_dans_la_base->getDate_d_arriver();

            $date_de_naissance_du_locataire = $element_qu_on_cherche_dans_la_base->getDate_de_naissance();

            $adresse_d_habitation_du_locataire = $element_qu_on_cherche_dans_la_base->getAdresse_d_habitation();

            $type_de_public_du_locataire = $element_qu_on_cherche_dans_la_base->getType_de_public();

            $numero_de_telephone_du_locataire = $element_qu_on_cherche_dans_la_base->getNumero_de_telephone();

            $date_d_arriver_du_locataire_sous_forme_de_String = $date_d_arriver_du_locataire->format("Y-m-d");

            $date_de_naissance_du_locataire_sous_forme_de_String = $date_de_naissance_du_locataire->format("Y-m-d");

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE Locataire.nom = :nom_de_famille_du_locataire AND Locataire.prenom = :prenom_du_locataire AND Locataire.adresse_d_habitation = :adresse_d_habitation_du_locataire AND Locataire.type_de_public = :type_de_public_du_locataire AND Locataire.date_d_arrivee = :date_d_arrivee_du_locataire AND Locataire.date_de_naissance = :date_de_naissance_du_locataire AND Locataire.numero_de_telephone = :numero_de_telephone_du_locataire");

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":nom_de_famille_du_locataire", $nom_de_famille_du_locataire);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":prenom_du_locataire", $prenom_du_locataire);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":adresse_d_habitation_du_locataire", $adresse_d_habitation_du_locataire);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":type_de_public_du_locataire", $type_de_public_du_locataire);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":date_d_arrivee_du_locataire", $date_d_arriver_du_locataire_sous_forme_de_String);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":date_de_naissance_du_locataire", $date_de_naissance_du_locataire_sous_forme_de_String);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->bindParam(":numero_de_telephone_du_locataire", $numero_de_telephone_du_locataire);

            $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->execute();

            $nombre_de_resultats_compris_dans_la_requete = $requete_preparee_pour_la_verification_de_l_existence_du_locataire_dans_la_base->rowCount();

            if($nombre_de_resultats_compris_dans_la_requete == 1)
            {

                $variable_de_retour = True;

            }

        }
        elseif(is_a($element_qu_on_cherche_dans_la_base, 'Contrat'))
        {

            $libelle_du_type_de_contrat = $element_qu_on_cherche_dans_la_base->getLibelle_du_type_de_contrat();

            $date_de_debut_du_contrat = $element_qu_on_cherche_dans_la_base->getDate_de_debut();

            $date_de_fin_du_contrat = $element_qu_on_cherche_dans_la_base->getDate_de_fin();

            $montant_du_loyer = $element_qu_on_cherche_dans_la_base->getMontant_du_loyer();

            $encaissement_du_depot_de_garantie = $element_qu_on_cherche_dans_la_base->getEncaissement_du_depot_de_garantie();

            $inclusion_EDF = $element_qu_on_cherche_dans_la_base->getInclusion_EDF();

            $inclusion_eau = $element_qu_on_cherche_dans_la_base->getInclusion_eau();

            $inclusion_internet = $element_qu_on_cherche_dans_la_base->getInclusion_internet();

            $inclusion_assurance_locative = $element_qu_on_cherche_dans_la_base->getInclusion_assurance_locative();

            $inclusion_charges_immeuble = $element_qu_on_cherche_dans_la_base->getInclusion_charges_immeuble();

            $chemin_du_fichier_genere = $element_qu_on_cherche_dans_la_base->getChemin_du_fichier_genere();

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Ensemble_des_conditions_du_contrat WHERE Ensemble_des_conditions_du_contrat.inclusion_edf = :inclusion_edf AND Ensemble_des_conditions_du_contrat.inclusion_eau = :inclusion_eau AND Ensemble_des_conditions_du_contrat.inclusion_internet = :inclusion_internet AND Ensemble_des_conditions_du_contrat.inclusion_assurance_locative = :inclusion_assurance_locative AND Ensemble_des_conditions_du_contrat.inclusion_charges_immeuble = :inclusion_charges_immeuble");

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_edf", $inclusion_EDF);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_eau", $inclusion_eau);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_internet", $inclusion_internet);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_assurance_locative", $inclusion_assurance_locative);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->bindParam(":inclusion_charges_immeuble", $inclusion_charges_immeuble);

            $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->execute();

            $nombre_de_resultats_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat = $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->rowCount();

            if($nombre_de_resultats_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat == 1)
            {

                $resultat_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat = $requete_preparee_pour_la_recuperation_de_l_id_des_conditions->fetchAll(PDO::FETCH_BOTH);

                $id_de_l_ensemble_des_conditions_du_contrat = $resultat_de_la_requete_de_recuperation_de_l_id_de_l_ensemble_des_conditions_du_contrat[0][0];

                $requete_preparee_pour_la_recuperation_de_l_id_du_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("");

            }

        }
        elseif(is_a($element_qu_on_cherche_dans_la_base,'Garant'))
        {

        }
        elseif(is_a($element_qu_on_cherche_dans_la_base,'Studio'))
        {

        }
        else
        {

            $variable_de_retour = False;

        }

        return $variable_de_retour;
    }

    //
    function insertion_de_l_element_dans_la_base_de_donnees($element_a_inserer_dans_la_base_de_donnees)
    {

        if(is_a($element_a_inserer_dans_la_base_de_donnees, "Locataire"))
        {

            $nom_de_famille_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getNom_du_locataire();

            $prenom_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getPrenom_du_locataire();

            $date_d_arriver_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getDate_d_arriver();

            $date_de_naissance_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getDate_de_naissance();

            $adresse_d_habitation_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getAdresse_d_habitation();

            $adresse_mail_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getAdresse_mail();

            $type_de_public_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getType_de_public();

            $numero_de_telephone_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getNumero_de_telephone();

            $date_d_arriver_du_locataire_sous_forme_de_String = $date_d_arriver_du_locataire->format("Y-m-d");

            $date_de_naissance_du_locataire_sous_forme_de_String = $date_de_naissance_du_locataire->format("Y-m-d");

            $requete_preparee_d_insertion_du_locataire_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES(:nom_de_famille_du_locataire, :prenom_du_locataire, :adresse_d_habitation_du_locataire, :type_de_public_du_locataire, :date_d_arriver_du_locataire, :adresse_mail_du_locataire, :date_de_naissance_du_locataire, :numero_de_telephone_du_locataire)");

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":nom_de_famille_du_locataire", $nom_de_famille_du_locataire);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":prenom_du_locataire", $prenom_du_locataire);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":adresse_d_habitation_du_locataire", $adresse_d_habitation_du_locataire);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":type_de_public_du_locataire", $type_de_public_du_locataire);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":adresse_mail_du_locataire", $adresse_mail_du_locataire);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":date_de_naissance_du_locataire", $date_de_naissance_du_locataire_sous_forme_de_String);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":date_d_arriver_du_locataire", $date_d_arriver_du_locataire_sous_forme_de_String);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->bindParam(":numero_de_telephone_du_locataire", $numero_de_telephone_du_locataire);

            $requete_preparee_d_insertion_du_locataire_dans_la_base->execute();

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Contrat"))
        {

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Garant"))
        {

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Studio"))
        {

        }
        else
        {
            throw new PDOException("L'élément passé en paramétre n'est pas une instance d'une des classes métiers");
        }
    }