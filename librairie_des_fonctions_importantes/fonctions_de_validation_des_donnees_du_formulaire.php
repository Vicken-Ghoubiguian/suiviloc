<?php

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