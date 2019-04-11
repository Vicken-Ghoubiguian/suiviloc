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
                $adresse_d_habitation_du_locataire[$incrementeur_de_l_adresse_d_habitation_du_locataire] == "-"))
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