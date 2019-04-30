<?php

    //
    require_once('classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php');

    //
    require_once('dompdf/autoload.inc.php');

    //
    require_once('smarty/libs/Smarty.class.php');

    //
    function insertion_du_contrat_de_location_avec_archivage_du_precedent_dans_la_base_de_donnees($contrat_courant)
    {

        //
        $id_du_locataire = $contrat_courant->getIdentifiant_du_locataire();

        //
        $requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT * FROM Contrat WHERE Contrat.locataire = :id_du_locataire");

        //
        $requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat->bindParam(":id_du_locataire", $id_du_locataire);

        //
        $requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat->execute();

        //
        $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat = $requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat->fetchAll(PDO::FETCH_ASSOC);

        //
        $locataire = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['locataire'];

        //
        $studio = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['studio'];

        //
        $garant = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['garant'];

        //
        $type_de_contrat = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['type_de_contrat'];

        //
        $date_de_debut_du_contrat = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['date_de_debut_du_contrat'];

        //
        $date_de_fin_du_contrat = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['date_de_fin_du_contrat'];

        //
        $date_du_jour = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['date_du_jour'];

        //
        $montant_du_loyer = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['montant_du_loyer'];

        //
        $encaissement_du_depot_de_garantie= $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['encaissement_du_depot_de_garantie'];

        //
        $chemin_d_accee = $resultats_de_la_requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat[0]['chemin_d_accee'];

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Archive_des_anciens_contrats_de_location(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, date_du_jour, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(:locataire, :studio, :type_de_contrat, :date_de_debut_du_contrat, :date_du_jour, :montant_du_loyer, :encaissement_du_depot_de_garantie, :chemin_d_accee)");

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":locataire", $locataire);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":studio", $studio);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":garant", $garant);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":type_de_contrat", $type_de_contrat);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":date_de_debut_du_contrat", $date_de_debut_du_contrat);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":date_de_fin_du_contrat", $date_de_fin_du_contrat);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":date_du_jour", $date_du_jour);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":chemin_d_accee", $chemin_d_accee);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":montant_du_loyer", $montant_du_loyer);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->bindParam(":encaissement_du_depot_de_garantie", $encaissement_du_depot_de_garantie);

        //
        $requete_d_insertion_du_contrat_dans_la_table_d_archivage->execute();

        //
        $studio = $contrat_courant->getIdentifiant_du_studio();

        //
        $garant = $contrat_courant->getIdentifiant_du_garant();

        //
        $type_de_contrat = $contrat_courant->getId_du_type_de_contrat();

        //
        $date_de_debut_du_contrat = $contrat_courant->getDate_de_debut();

        //
        $date_de_fin_du_contrat = $contrat_courant->getDate_de_fin();

        //
        $date_du_jour = $contrat_courant->getDate_du_jour();

        //
        $montant_du_loyer = $contrat_courant->getMontant_du_loyer();

        //
        $encaissement_du_depot_de_garantie= $contrat_courant->getEncaissement_du_depot_de_garantie();

        //
        $chemin_d_accee = $contrat_courant->getChemin_du_fichier_genere();

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Contrat SET studio = :studio AND garant = :garant AND type_de_contrat = :type_de_contrat AND date_de_debut_du_contrat = :date_de_debut_du_contrat AND date_de_fin_du_contrat = :date_de_fin_du_contrat AND date_du_jour = :date_du_jour AND montant_du_loyer = :montant_du_loyer AND chemin_d_accee = :chemin_d_accee AND encaissement_du_depot_de_garantie = :encaissement_du_depot_de_garantie WHERE locataire = :id_du_locataire");

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":studio", $studio);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":garant", $garant);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":type_de_contrat", $type_de_contrat);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":montant_du_loyer", $montant_du_loyer);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":chemin_d_accee", $chemin_d_accee);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":date_de_debut", $date_de_debut_du_contrat);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":date_de_fin", $date_de_fin_du_contrat);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->bindParam(":date_du_jour", $date_du_jour);

        //
        $requete_preparee_de_recuperation_de_toutes_les_donnees_relatives_au_precedent_contrat->bindParam(":encaissement_du_depot_de_garantie", $encaissement_du_depot_de_garantie);

        //
        $requete_preparee_d_insertion_du_nouveau_contrat_de_location_du_locataire->execute();

    }

    //
    function survenance_d_une_erreur_de_generation_du_document_PDF($tableau_contenant_les_donnees_de_l_erreur)
    {

        $smarty = new Smarty();

        //
        $smarty->assign($tableau_contenant_les_donnees_de_l_erreur);

        //
        $smarty->display("vues/page_d_erreur_survenue_dans_la_soumission_des_donnees_renseignees_dans_les_formulaires.html");

    }

    //
    function confirmation_de_reussite_de_generation_du_document_PDF($nature_du_document_a_generer)
    {

        //
        $smarty = new Smarty();

        //
        $smarty->assign(array("nature_du_document_PDF_a_generer" => $nature_du_document_a_generer));

        //
        $smarty->display("vues/page_de_confirmation_de_reussite_de_generation_de_document_PDF.html");

    }

    //
    function renvoi_de_la_date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire)
    {

        //
        $requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT date_d_arrivee FROM Locataire WHERE nom = :nom_de_famille_du_locataire AND prenom = :prenom_du_locataire");

        //
        $requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio->bindParam(":nom_de_famille_du_locataire", $nom_de_famille_du_locataire);

        //
        $requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio->bindParam(":prenom_du_locataire", $prenom_du_locataire);

        //
        $requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio = $requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio->fetchAll(PDO::FETCH_BOTH);

        //
        $date_d_arrivee_du_locataire_dans_son_studio = $resultat_de_la_requete_de_recuperation_de_la_date_d_arrivee_du_locataire_dans_son_studio[0][0];

        //
        $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime = new DateTime($date_d_arrivee_du_locataire_dans_son_studio);

        //
        $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp = $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_DateTime->getTimestamp();

        //
        return $date_d_arrivee_du_locataire_dans_son_studio_sous_forme_de_timestamp;

    }

    //
    function renvoi_de_l_id_du_contrat_de_location_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire)
    {

        //
        $requete_de_recuperation_de_l_id_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE nom = :nom_de_famille AND prenom = :prenom");

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":nom_de_famille", $nom_de_famille_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":prenom", $prenom_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire = $requete_de_recuperation_de_l_id_du_locataire->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_locataire = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire[0][0];

        //
        $requete_de_selection_de_l_id_du_contrat_de_location_pour_le_locataire_donne = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Contrat.id FROM Contrat WHERE Contrat.locataire = :id_du_locataire_concerne");

        //
        $requete_de_selection_de_l_id_du_contrat_de_location_pour_le_locataire_donne->bindParam(":id_du_locataire_concerne", $id_du_locataire);

        //
        $requete_de_selection_de_l_id_du_contrat_de_location_pour_le_locataire_donne->execute();

        //
        $resultat_de_la_requete_de_selection_de_l_id_du_contrat_de_location_pour_le_locataire_donne = $requete_de_selection_de_l_id_du_contrat_de_location_pour_le_locataire_donne->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_contrat_de_location = $resultat_de_la_requete_de_selection_de_l_id_du_contrat_de_location_pour_le_locataire_donne[0][0];

        //
        return $id_du_contrat_de_location;

    }

    //
    function renvoi_de_la_date_de_debut_du_contrat_du_locataire_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire)
    {

        //
        $requete_de_recuperation_de_l_id_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE nom = :nom_de_famille AND prenom = :prenom");

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":nom_de_famille", $nom_de_famille_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":prenom", $prenom_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire = $requete_de_recuperation_de_l_id_du_locataire->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_locataire = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire[0][0];

        //
        $requete_de_selection_de_la_date_de_debut_du_contrat_de_location_pour_le_locataire_donne = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Contrat.date_de_debut_du_contrat FROM Contrat WHERE Contrat.locataire = :id_du_locataire_concerne");

        //
        $requete_de_selection_de_la_date_de_debut_du_contrat_de_location_pour_le_locataire_donne->bindParam(":id_du_locataire_concerne", $id_du_locataire);

        //
        $requete_de_selection_de_la_date_de_debut_du_contrat_de_location_pour_le_locataire_donne->execute();

        //
        $date_de_debut_du_contrat_pour_le_locataire_concernee = $requete_de_selection_de_la_date_de_debut_du_contrat_de_location_pour_le_locataire_donne->fetchAll(PDO::FETCH_BOTH);

        //
        $date_de_debut_du_contrat_pour_le_locataire_concernee_sous_forme_de_DateTime = new DateTime($date_de_debut_du_contrat_pour_le_locataire_concernee[0][0]);

        //
        $date_de_debut_du_contrat_pour_le_locataire_concernee_sous_forme_de_timestamp = $date_de_debut_du_contrat_pour_le_locataire_concernee_sous_forme_de_DateTime->getTimestamp();

        //
        return $date_de_debut_du_contrat_pour_le_locataire_concernee_sous_forme_de_timestamp;

    }

    //
    function renvoi_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio)
    {

        //
        $requete_de_recuperation_de_l_id_du_studio_occuppe_par_le_locataire_a_partir_de_son_numero = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Studio WHERE numero_du_studio = :numero_du_studio");

        //
        $requete_de_recuperation_de_l_id_du_studio_occuppe_par_le_locataire_a_partir_de_son_numero->bindParam(":numero_du_studio", $numero_du_studio);

        //
        $requete_de_recuperation_de_l_id_du_studio_occuppe_par_le_locataire_a_partir_de_son_numero->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_occuppe_par_le_locataire_a_partir_de_son_numero = $requete_de_recuperation_de_l_id_du_studio_occuppe_par_le_locataire_a_partir_de_son_numero->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_studio = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_occuppe_par_le_locataire_a_partir_de_son_numero[0][0];

        //
        return $id_du_studio;

    }

    //
    function renvoi_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_sous_forme_de_timestamp($nom_de_famille_du_locataire, $prenom_du_locataire)
    {

        //
        $requete_de_recuperation_de_l_id_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE nom = :nom_de_famille AND prenom = :prenom");

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":nom_de_famille", $nom_de_famille_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":prenom", $prenom_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire = $requete_de_recuperation_de_l_id_du_locataire->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_locataire = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire[0][0];

        //
        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Contrat.date_de_fin_du_contrat FROM Contrat WHERE Contrat.locataire = :id_du_locataire_concerne");

        //
        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne->bindParam(":id_du_locataire_concerne", $id_du_locataire);

        //
        $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne->execute();

        //
        $date_de_fin_du_contrat_pour_le_locataire_concernee = $requete_de_selection_de_la_date_de_fin_du_contrat_de_location_pour_le_locataire_donne->fetchAll(PDO::FETCH_BOTH);

        //
        $date_de_fin_du_contrat_pour_le_locataire_concernee_sous_forme_de_DateTime = new DateTime($date_de_fin_du_contrat_pour_le_locataire_concernee[0][0]);

        //
        $date_de_fin_du_contrat_pour_le_locataire_concernee_sous_forme_de_timestamp = $date_de_fin_du_contrat_pour_le_locataire_concernee_sous_forme_de_DateTime->getTimestamp();

        //
        return $date_de_fin_du_contrat_pour_le_locataire_concernee_sous_forme_de_timestamp;

    }

    //
    function renvoi_du_numero_du_studio_du_locataire($nom_de_famille_du_locataire, $prenom_du_locataire)
    {

        //
        $requete_de_recuperation_de_l_id_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE nom = :nom_de_famille AND prenom = :prenom");

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":nom_de_famille", $nom_de_famille_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->bindParam(":prenom", $prenom_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_locataire->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire = $requete_de_recuperation_de_l_id_du_locataire->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_locataire = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire[0][0];

        //
        $requete_de_recuperation_de_l_id_du_studio_a_partir_de_l_id_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE locataire = :id_du_locataire");

        //
        $requete_de_recuperation_de_l_id_du_studio_a_partir_de_l_id_du_locataire->bindParam(":id_du_locataire", $id_du_locataire);

        //
        $requete_de_recuperation_de_l_id_du_studio_a_partir_de_l_id_du_locataire->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_a_partir_de_l_id_du_locataire = $requete_de_recuperation_de_l_id_du_studio_a_partir_de_l_id_du_locataire->fetchAll(PDO::FETCH_BOTH);

        //
        $id_du_studio = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_a_partir_de_l_id_du_locataire[0][0];

        //
        $requete_de_recuperation_du_numero_de_studio_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

        //
        $requete_de_recuperation_du_numero_de_studio_du_locataire->bindParam(":id_du_studio", $id_du_studio);

        //
        $requete_de_recuperation_du_numero_de_studio_du_locataire->execute();

        //
        $resultat_de_la_requete_de_recuperation_du_numero_de_studio_du_locataire = $requete_de_recuperation_du_numero_de_studio_du_locataire->fetchAll(PDO::FETCH_BOTH);

        //
        $numero_du_studio_du_locataire = $resultat_de_la_requete_de_recuperation_du_numero_de_studio_du_locataire[0][0];

        //
        return $numero_du_studio_du_locataire;

    }

    //
    function renvoi_du_nom_et_du_prenom_de_tous_les_locataires_dans_un_tableau()
    {

        //
        $tableau_de_tous_les_locataires = array();

        //
        $requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom, prenom FROM Locataire");

        //
        $requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires->execute();

        //
        $resultat_de_la_requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires = $requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires->fetchAll(PDO::FETCH_ASSOC);

        //
        $nombre_de_resultats_de_la_requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires = $requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires->rowCount();

        //
        for($incrementeur = 0; $incrementeur < $nombre_de_resultats_de_la_requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires; $incrementeur++)
        {

            //
            $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires[$incrementeur]['nom'];

            //
            $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_de_tous_les_noms_et_prenoms_des_locataires[$incrementeur]['prenom'];

            //
            $locataire_courant = $nom_de_famille_du_locataire . " " . $prenom_du_locataire;

            //
            array_push($tableau_de_tous_les_locataires, $locataire_courant);

        }

        //
        return $tableau_de_tous_les_locataires;

    }

    //
    function mise_a_jour_d_urgence_de_la_table_de_connexion_a_l_application_suiviloc_pour_connection_a_l_application($nom_de_l_uttilisateur_pour_connexion, $mot_de_passe_crypte_de_l_uttilisateur_pour_authentification)
    {

        //
        $requete_de_mise_a_jour_d_urgence_de_la_table_de_connexion_a_l_application_suiviloc_pour_connexion = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET est_connecte = 0 WHERE username = :login AND password = :mot_de_passe_crypte");

        //
        $requete_de_mise_a_jour_d_urgence_de_la_table_de_connexion_a_l_application_suiviloc_pour_connexion->bindParam(":login", $nom_de_l_uttilisateur_pour_connexion);

        //
        $requete_de_mise_a_jour_d_urgence_de_la_table_de_connexion_a_l_application_suiviloc_pour_connexion->bindParam(":password", $mot_de_passe_crypte_de_l_uttilisateur_pour_authentification);

        //
        $requete_de_mise_a_jour_d_urgence_de_la_table_de_connexion_a_l_application_suiviloc_pour_connexion->execute();

    }

    //
    function renvoi_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat($id_du_contrat)
    {

        //
        $requete_de_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire, studio FROM Contrat WHERE id = :id_du_contrat");

        //
        $requete_de_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat->bindParam(":id_du_contrat", $id_du_contrat);

        //
        $requete_de_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat->execute();

        //
        $resultat_de_la_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat = $requete_de_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat->fetchAll(PDO::FETCH_ASSOC);

        //
        $tableau_contenant_le_resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio = array($resultat_de_la_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat[0]['locataire'], $resultat_de_la_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat[0]['studio']);

        //
        return $tableau_contenant_le_resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_et_de_l_id_du_studio;
    }

    //
    function renvoi_du_nom_et_du_prenom_du_locataire_a_partir_de_son_id($id_du_locataire)
    {

        //
        $requete_de_recuperation_du_nom_de_famille_et_du_prenom_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom, prenom FROM Locataire WHERE id = :id_du_locataire");

        //
        $requete_de_recuperation_du_nom_de_famille_et_du_prenom_du_locataire->bindParam(":id_du_locataire",$id_du_locataire);

        //
        $requete_de_recuperation_du_nom_de_famille_et_du_prenom_du_locataire->execute();

        //
        $resultat_de_la_recuperation_du_nom_de_famille_et_du_prenom_du_locataire = $requete_de_recuperation_du_nom_de_famille_et_du_prenom_du_locataire->fetchAll(PDO::FETCH_ASSOC);

        //
        $tableau_contenant_le_resultat_de_la_requete_de_recuperation_du_nom_et_du_prenom_du_locataire = array($resultat_de_la_recuperation_du_nom_de_famille_et_du_prenom_du_locataire[0]['nom'], $resultat_de_la_recuperation_du_nom_de_famille_et_du_prenom_du_locataire[0]['prenom']);

        //
        return $tableau_contenant_le_resultat_de_la_requete_de_recuperation_du_nom_et_du_prenom_du_locataire;
    }

    //
    function extraction_du_numero_du_studio_a_partir_de_son_id($id_du_studio)
    {

        //
        $requete_de_recuperation_du_numero_de_studio = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

        //
        $requete_de_recuperation_du_numero_de_studio->bindParam(":id_du_studio", $id_du_studio);

        //
        $requete_de_recuperation_du_numero_de_studio->execute();

        //
        $resultat_de_la_recuperation_du_numero_de_studio = $requete_de_recuperation_du_numero_de_studio->fetchAll(PDO::FETCH_BOTH);

        //
        return $resultat_de_la_recuperation_du_numero_de_studio[0][0];
    }

    //
    function renvoi_du_libelle_de_la_surface_a_partir_de_son_id($id_de_la_surface)
    {

        //
        $requete_de_recuperation_du_libelle_de_la_surface_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT libelle_de_la_surface FROM Surface WHERE id = :id_de_la_surface");

        //
        $requete_de_recuperation_du_libelle_de_la_surface_a_partir_de_son_id->bindParam(":id_de_la_surface", $id_de_la_surface);

        //
        $requete_de_recuperation_du_libelle_de_la_surface_a_partir_de_son_id->execute();

        //
        $resultat_de_la_requete_de_recuperation_du_libelle_de_la_surface_a_partir_de_son_id = $requete_de_recuperation_du_libelle_de_la_surface_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

        //
        $libelle_de_la_surface = $resultat_de_la_requete_de_recuperation_du_libelle_de_la_surface_a_partir_de_son_id[0][0];

        //
        return $libelle_de_la_surface;

    }

    //
    function comptage_du_nombre_d_etiquettes_generees()
    {
        //
        $requete_de_recuperation_du_nombre_d_etiquettes_generees = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nombre_d_etiquettes_generees FROM Etiquette");

        //
        $requete_de_recuperation_du_nombre_d_etiquettes_generees->execute();

        //
        $resultat_de_la_requete_de_recuperation_du_nombre_d_etiquettes_generees = $requete_de_recuperation_du_nombre_d_etiquettes_generees->fetchAll(PDO::FETCH_BOTH);

        //
        $nombre_d_etiquettes_generees = $resultat_de_la_requete_de_recuperation_du_nombre_d_etiquettes_generees[0][0];

        //
        return $nombre_d_etiquettes_generees;
    }

    //
    function mise_a_jour_du_nombre_d_etiquettes_generees($nombre_d_etiquettes_generees)
    {

        //
        $requete_de_mise_a_jour_du_nombre_d_etiquettes_generees = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Etiquette SET nombre_d_etiquettes_generees = :nombre_d_etiquettes_generees");

        //
        $requete_de_mise_a_jour_du_nombre_d_etiquettes_generees->bindParam(":nombre_d_etiquettes_generees", $nombre_d_etiquettes_generees);

        //
        $requete_de_mise_a_jour_du_nombre_d_etiquettes_generees->execute();
    }

    //
    function renvoi_de_la_date_et_de_l_heure_de_generation_du_document_PDF($chemin_du_document)
    {

        //
        $premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp = explode("_", $chemin_du_document);

        //
        $taille_de_la_premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp = sizeof($premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp);

        //
        $index_du_dernier_element_de_la_premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp = $taille_de_la_premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp - 1;

        //
        $seconde_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp = explode(".", $premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp[$index_du_dernier_element_de_la_premiere_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp]);

        //
        $date_et_heure_de_la_generation_du_document_PDF_sous_forme_de_timestamp = $seconde_casse_du_chemin_du_document_PDF_pour_extraction_du_timestamp[0];

        //
        $date_et_heure_de_generation_du_document_PDF = date("d/m/Y à H:i:s", $date_et_heure_de_la_generation_du_document_PDF_sous_forme_de_timestamp);

        //
        return $date_et_heure_de_generation_du_document_PDF;

    }

    //
    function recuperation_du_chemin_d_accee_des_differents_documents_generes_sous_PDF($type_du_document)
    {

        //
        if($type_du_document == "Attestation")
        {

            //
            $tableau_contenant_les_chemins_d_accee_des_differents_documents = array();

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT chemin_d_accee FROM Attestation");

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->execute();

            //
            $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->fetchAll(PDO::FETCH_ASSOC);

            //
            $nombre_de_resultats_dans_la_requete = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->rowCount();

            //
            for($incrementeur = 0; $incrementeur < $nombre_de_resultats_dans_la_requete; $incrementeur++)
            {

                //
                array_push($tableau_contenant_les_chemins_d_accee_des_differents_documents, $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF[$incrementeur]['chemin_d_accee']);

            }

            //
            return $tableau_contenant_les_chemins_d_accee_des_differents_documents;

        }
        //
        elseif($type_du_document == "Contrat")
        {

            //
            $tableau_contenant_les_chemins_d_accee_des_differents_documents = array();

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT chemin_d_accee FROM Contrat");

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->execute();

            //
            $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->fetchAll(PDO::FETCH_ASSOC);

            //
            $nombre_de_resultats_dans_la_requete = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->rowCount();

            //
            for($incrementeur = 0; $incrementeur < $nombre_de_resultats_dans_la_requete; $incrementeur++)
            {

                //
                array_push($tableau_contenant_les_chemins_d_accee_des_differents_documents, $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF[$incrementeur]['chemin_d_accee']);

            }

            //
            return $tableau_contenant_les_chemins_d_accee_des_differents_documents;

        }
        elseif($type_du_document == "Expiration_de_contrat_de_location")
        {

            //
            $tableau_contenant_les_chemins_d_accee_des_differents_documents = array();

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT chemin_d_accee FROM Expiration_de_contrat_de_location");

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->execute();

            //
            $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->fetchAll(PDO::FETCH_ASSOC);

            //
            $nombre_de_resultats_dans_la_requete = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->rowCount();

            //
            for($incrementeur = 0; $incrementeur < $nombre_de_resultats_dans_la_requete; $incrementeur++)
            {

                //
                array_push($tableau_contenant_les_chemins_d_accee_des_differents_documents, $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF[$incrementeur]['chemin_d_accee']);

            }

            //
            return $tableau_contenant_les_chemins_d_accee_des_differents_documents;

        }
        //
        elseif($type_du_document == "Preavis")
        {

            //
            $tableau_contenant_les_chemins_d_accee_des_differents_documents = array();

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT chemin_d_accee FROM Preavis");

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->execute();

            //
            $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->fetchAll(PDO::FETCH_ASSOC);

            //
            $nombre_de_resultats_dans_la_requete = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->rowCount();

            //
            for($incrementeur = 0; $incrementeur < $nombre_de_resultats_dans_la_requete; $incrementeur++)
            {

                //
                array_push($tableau_contenant_les_chemins_d_accee_des_differents_documents, $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF[$incrementeur]['chemin_d_accee']);

            }

            //
            return $tableau_contenant_les_chemins_d_accee_des_differents_documents;

        }
        //
        elseif($type_du_document == "Relance_loyer_impaye")
        {

            //
            $tableau_contenant_les_chemins_d_accee_des_differents_documents = array();

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT chemin_d_accee FROM Relance_loyer_impaye");

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->execute();

            //
            $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->fetchAll(PDO::FETCH_ASSOC);

            //
            $nombre_de_resultats_dans_la_requete = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->rowCount();

            //
            for($incrementeur = 0; $incrementeur < $nombre_de_resultats_dans_la_requete; $incrementeur++)
            {

                //
                array_push($tableau_contenant_les_chemins_d_accee_des_differents_documents, $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF[$incrementeur]['chemin_d_accee']);

            }

            //
            return $tableau_contenant_les_chemins_d_accee_des_differents_documents;

        }
        //
        elseif($type_du_document == "Etat_des_lieux")
        {

            //
            $tableau_contenant_les_chemins_d_accee_des_differents_documents = array();

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT chemin_d_accee FROM Etat_des_lieux");

            //
            $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->execute();

            //
            $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->fetchAll(PDO::FETCH_ASSOC);

            //
            $nombre_de_resultats_dans_la_requete = $requete_de_recuperation_du_chemin_d_accee_des_documents_PDF->rowCount();

            //
            for($incrementeur = 0; $incrementeur < $nombre_de_resultats_dans_la_requete; $incrementeur++)
            {

                //
                array_push($tableau_contenant_les_chemins_d_accee_des_differents_documents, $resultat_de_la_requete_de_recuperation_du_chemin_d_accee_des_documents_PDF[$incrementeur]['chemin_d_accee']);

            }

            //
            return $tableau_contenant_les_chemins_d_accee_des_differents_documents;

        }
        //
        else
        {

            //
            return 0;

        }

    }

    //
    function renvoi_du_nom_du_document_pour_l_inclure_dans_la_liste_deroulante_a_partir_de_son_chemin($chemin_du_document, $type_du_document)
    {

        //
        if($chemin_du_document != "0")
        {

            //
            if ($type_du_document == "Attestation") {

                //
                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT contrat FROM Attestation WHERE chemin_d_accee = :chemin_d_accee");

                //
                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->bindParam(":chemin_d_accee", $chemin_du_document);

                //
                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->execute();

                //
                $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->fetchAll(PDO::FETCH_BOTH);

                //
                $contrat_de_location_relatif_au_document = $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre[0][0];

                //
                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire FROM Contrat WHERE id = :id_du_contrat");

                //
                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                //
                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->execute();

                //
                $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                //
                $id_du_locataire_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre[0][0];

                //
                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom FROM Locataire WHERE id = :id_du_locataire");

                //
                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                //
                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->execute();

                //
                $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                //
                $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id[0][0];

                //
                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT prenom FROM Locataire WHERE id = :id_du_locataire");

                //
                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                //
                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->execute();

                //
                $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                //
                $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id[0][0];

                //
                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE id = :id_du_contrat");

                //
                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                //
                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->execute();

                //
                $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                //
                $id_du_studio_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location[0][0];

                //
                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

                //
                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->bindParam(":id_du_studio", $id_du_studio_relatif_au_contrat_de_location);

                //
                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->execute();

                //
                $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                //
                $numero_du_studio = $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id[0][0];

                //
                return "Attestation du locataire " . $nom_de_famille_du_locataire . " " . $prenom_du_locataire . " occupant le n°" . $numero_du_studio;

            }
            //
            elseif ($type_du_document == "Contrat")
            {

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Contrat WHERE chemin_d_accee = :chemin_d_accee");

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->bindParam(":chemin_d_accee", $chemin_du_document);

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->fetchAll(PDO::FETCH_BOTH);

                $contrat_de_location_relatif_au_document = $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_locataire_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT prenom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_studio_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location[0][0];

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->bindParam(":id_du_studio", $id_du_studio_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $numero_du_studio = $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id[0][0];

                return "Contrat_de_location du locataire " . $nom_de_famille_du_locataire . " " . $prenom_du_locataire . " occupant le n°" . $numero_du_studio;

            } elseif ($type_du_document == "Expiration_de_contrat_de_location") {

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT contrat FROM Expiration_de_contrat_de_location WHERE chemin_d_accee = :chemin_d_accee");

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->bindParam(":chemin_d_accee", $chemin_du_document);

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->fetchAll(PDO::FETCH_BOTH);

                $contrat_de_location_relatif_au_document = $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_locataire_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT prenom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_studio_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location[0][0];

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->bindParam(":id_du_studio", $id_du_studio_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $numero_du_studio = $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id[0][0];

                return "Expiration_de_contrat_de_location " . $nom_de_famille_du_locataire . " " . $prenom_du_locataire . " occupant le n°" . $numero_du_studio;

            } elseif ($type_du_document == "Preavis") {

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT contrat FROM Preavis WHERE chemin_d_accee = :chemin_d_accee");

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->bindParam(":chemin_d_accee", $chemin_du_document);

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->fetchAll(PDO::FETCH_BOTH);

                $contrat_de_location_relatif_au_document = $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_locataire_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT prenom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_studio_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location[0][0];

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->bindParam(":id_du_studio", $id_du_studio_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $numero_du_studio = $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id[0][0];

                return "Preavis " . $nom_de_famille_du_locataire . " " . $prenom_du_locataire . " occupant le n°" . $numero_du_studio;

            } elseif ($type_du_document == "Relance_loyer_impaye") {

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT contrat FROM Relance_loyer_impaye WHERE chemin_d_accee = :chemin_d_accee");

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->bindParam(":chemin_d_accee", $chemin_du_document);

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->fetchAll(PDO::FETCH_BOTH);

                $contrat_de_location_relatif_au_document = $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_locataire_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT prenom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_studio_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location[0][0];

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->bindParam(":id_du_studio", $id_du_studio_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $numero_du_studio = $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id[0][0];

                return "Relance loyer impayé " . $nom_de_famille_du_locataire . " " . $prenom_du_locataire . " occupant le n°" . $numero_du_studio;

            } elseif ($type_du_document == "Etat_des_lieux") {

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT contrat FROM Etat_des_lieux WHERE chemin_d_accee = :chemin_d_accee");

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->bindParam(":chemin_d_accee", $chemin_du_document);

                $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre->fetchAll(PDO::FETCH_BOTH);

                $contrat_de_location_relatif_au_document = $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT locataire FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre = $requete_de_recuperation_de_l_id_du_locataire_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_locataire_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_locataire_en_fonction_du_chemin_passe_en_parametre[0][0];

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $nom_de_famille_du_locataire = $resultat_de_la_requete_de_recuperation_du_nom_de_famille_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT prenom FROM Locataire WHERE id = :id_du_locataire");

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->bindParam(":id_du_locataire", $id_du_locataire_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id = $requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $prenom_du_locataire = $resultat_de_la_requete_de_recuperation_du_prenom_du_locataire_a_partir_de_son_id[0][0];

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT studio FROM Contrat WHERE id = :id_du_contrat");

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->bindParam(":id_du_contrat", $contrat_de_location_relatif_au_document);

                $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->execute();

                $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location = $requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location->fetchAll(PDO::FETCH_BOTH);

                $id_du_studio_relatif_au_contrat_de_location = $resultat_de_la_requete_de_recuperation_de_l_id_du_studio_relatif_au_contrat_de_location[0][0];

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT numero_du_studio FROM Studio WHERE id = :id_du_studio");

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->bindParam(":id_du_studio", $id_du_studio_relatif_au_contrat_de_location);

                $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->execute();

                $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id = $requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id->fetchAll(PDO::FETCH_BOTH);

                $numero_du_studio = $resultat_de_la_requete_de_recuperation_du_numerç_du_studio_a_partir_de_son_id[0][0];

                return "Etat des lieux " . $nom_de_famille_du_locataire . " " . $prenom_du_locataire . " occupant le n°" . $numero_du_studio;

            }
            else
            {

                return 0;
            }

        }
        else
        {

            return 0;

        }
    }

    //
    function recuperation_de_l_id_d_un_contrat_de_location_a_partir_de_l_id_du_locataire_et_de_l_id_du_studio($id_du_locataire, $id_du_studio)
    {

        $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Contrat WHERE Contrat.locataire = :id_du_locataire AND Contrat.studio = :id_du_studio");

        $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio->bindParam(":id_du_locataire", $id_du_locataire);

        $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio->bindParam(":id_du_studio", $id_du_studio);

        $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio->execute();

        $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio = $requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio->fetchAll(PDO::FETCH_BOTH);

        return $resultat_de_la_requete_de_recuperation_de_l_id_du_contrat_de_location_en_fonction_de_l_id_du_locataire_et_de_l_id_du_studio[0][0];
    }

    //
    function generation_d_un_document_sous_format_PDF($type_de_document_a_generer, $donnees_a_inserer_dans_le_futur_document_PDF)
    {

        //
        if($type_de_document_a_generer == "etiquette")
        {

            //
            $nombre_d_etiquettes_generees = comptage_du_nombre_d_etiquettes_generees();

            //
            $numero_de_l_etiquette = $nombre_d_etiquettes_generees + 1;

            //
            $chemin_de_telechargement_du_document_PDF_genere = "documents_generes_en_PDF/" . $type_de_document_a_generer . "_numero_" . $numero_de_l_etiquette . ".pdf";

            //
            mise_a_jour_du_nombre_d_etiquettes_generees($numero_de_l_etiquette);

        }
        //Sinon...
        else
        {

            //
            $code_genere_pour_l_identification_du_document_PDF = 0;

            //
            for ($incrementeur = 0; $incrementeur < 10; $incrementeur++) {

                //
                $code_genere_pour_l_identification_du_document_PDF .= mt_rand(0, 9);

            }

            //
            $heure_de_generation_du_document_PDF = time();

            //
            $chemin_de_telechargement_du_document_PDF_genere = "documents_generes_en_PDF/" . $type_de_document_a_generer . "_" . $code_genere_pour_l_identification_du_document_PDF . "_" . $heure_de_generation_du_document_PDF . ".pdf";

        }

        //
        $smarty = new Smarty();

        //
        $smarty->assign($donnees_a_inserer_dans_le_futur_document_PDF);

        //
        if($type_de_document_a_generer == "relance_loyer_impaye")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/relance.html");

        }
        //
        elseif($type_de_document_a_generer == "expiration_de_contrat_de_location")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/expiration_de_contrat_de_location.html");

        }
        //
        elseif($type_de_document_a_generer == "attestation")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/attestation.html");

        }
        //
        elseif($type_de_document_a_generer == "contrat_0-3_mois")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/contrat_0-3_mois.html");

        }
        //
        elseif($type_de_document_a_generer == "contrat_12_mois")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/contrat_12_mois.html");

        }
        //
        elseif($type_de_document_a_generer == "etiquette")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/etiquette.html");

        }
        //
        elseif($type_de_document_a_generer == "etat_des_lieux_lors_de_sortie_anticipee")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/etat_des_lieux_lors_de_sortie_anticipee.html");

        }
        //
        elseif($type_de_document_a_generer == "preavis")
        {

            //
            $template_nouvellement_genere = $smarty->fetch("templates_des_documents_PDF/preavis.html");

        }

        //
        $dompdf = new \Dompdf\Dompdf();

        //
        $dompdf->loadHtml($template_nouvellement_genere);

        //
        $dompdf->setPaper('a4', 'portrait');

        //
        $dompdf->render();

        //
        if($type_de_document_a_generer == "etiquette")
        {

            //
            $dompdf->stream($chemin_de_telechargement_du_document_PDF_genere);

        }
        //
        else
        {

            //
            file_put_contents($chemin_de_telechargement_du_document_PDF_genere, $dompdf->output());

            //
            return $chemin_de_telechargement_du_document_PDF_genere;

        }
    }

    //
    function contient_l_element_passe_en_parametre($chaine_de_caractere_dans_lequel_trouver_l_element, $element_a_trouver)
    {

        //
        $variable_de_retour = False;

        //
        for($incrementeur = 0; $incrementeur < strlen($chaine_de_caractere_dans_lequel_trouver_l_element); $incrementeur++)
        {

            //
            if($chaine_de_caractere_dans_lequel_trouver_l_element[$incrementeur] == $element_a_trouver)
            {
                //
                $variable_de_retour = True;
            }
        }

        //
        return $variable_de_retour;

    }

    //
    function formatage_du_prenom_pour_ne_mettre_que_les_premieres_lettres_en_majuscule($prenom_du_locataire)
    {

        //
        $prenom_du_locataire_formate = "";

        //
        if(contient_l_element_passe_en_parametre($prenom_du_locataire, " ") == True)
        {

            //
            $tableau_de_traitement_du_prenom = explode(" ", $prenom_du_locataire);

            //
            $nombre_de_prenoms_composant_celui_du_locataire = count($tableau_de_traitement_du_prenom);

            //
            for($incrementeur_du_tableau = 0; $incrementeur_du_tableau < $nombre_de_prenoms_composant_celui_du_locataire; $incrementeur_du_tableau++)
            {

                //
                if($incrementeur_du_tableau != 0)
                {

                    //
                    $prenom_du_locataire_formate .= " ";

                }

                //
                $prenom_courant_composant_celuis_du_locataire = $tableau_de_traitement_du_prenom[$incrementeur_du_tableau];

                //
                $taille_du_prenom_du_locataire = strlen($prenom_courant_composant_celuis_du_locataire);

                //
                for($incrementeur_du_prenom_composant = 0; $incrementeur_du_prenom_composant < $taille_du_prenom_du_locataire; $incrementeur_du_prenom_composant++)
                {

                    //
                    if($incrementeur_du_prenom_composant == 0)
                    {

                        //
                        $prenom_du_locataire_formate .= strtoupper($prenom_courant_composant_celuis_du_locataire[$incrementeur_du_prenom_composant]);

                    }
                    //Sinon...
                    else
                    {

                        //
                        $prenom_du_locataire_formate .= $prenom_courant_composant_celuis_du_locataire[$incrementeur_du_prenom_composant];

                    }

                }

            }

        }
        //
        elseif(contient_l_element_passe_en_parametre($prenom_du_locataire, "-") == True)
        {

            //
            $tableau_de_traitement_du_prenom = explode("-", $prenom_du_locataire);

            //
            $nombre_de_prenoms_composant_celui_du_locataire = count($tableau_de_traitement_du_prenom);

            //
            for($incrementeur_du_tableau = 0; $incrementeur_du_tableau < $nombre_de_prenoms_composant_celui_du_locataire; $incrementeur_du_tableau++)
            {

                //
                if($incrementeur_du_tableau != 0)
                {

                    //
                    $prenom_du_locataire_formate .= "-";

                }

                //
                $prenom_courant_composant_celuis_du_locataire = $tableau_de_traitement_du_prenom[$incrementeur_du_tableau];

                //
                $taille_du_prenom_du_locataire = strlen($prenom_courant_composant_celuis_du_locataire);

                //
                for($incrementeur_du_prenom_composant = 0; $incrementeur_du_prenom_composant < $taille_du_prenom_du_locataire; $incrementeur_du_prenom_composant++)
                {

                    //
                    if($incrementeur_du_prenom_composant == 0)
                    {

                        //
                        $prenom_du_locataire_formate .= strtoupper($prenom_courant_composant_celuis_du_locataire[$incrementeur_du_prenom_composant]);

                    }
                    //Sinon...
                    else
                    {

                        //
                        $prenom_du_locataire_formate .= $prenom_courant_composant_celuis_du_locataire[$incrementeur_du_prenom_composant];

                    }

                }

            }

        }
        //Sinon...
        else
        {

            //
            $taille_du_prenom_du_locataire = strlen($prenom_du_locataire);

            //
            for($incrementeur = 0; $incrementeur < $taille_du_prenom_du_locataire; $incrementeur++)
            {

                //
                if($incrementeur == 0)
                {

                    //
                    $prenom_du_locataire_formate .= strtoupper($prenom_du_locataire[$incrementeur]);

                }
                //Sinon...
                else
                {

                    //
                    $prenom_du_locataire_formate .= $prenom_du_locataire[$incrementeur];

                }

            }

        }

        //
        return $prenom_du_locataire_formate;

    }

    //
    function renvoi_de_l_id_du_garant_passe_en_parametre($garant_courant)
    {

        if(is_a($garant_courant, "Garant"))
        {

            $nom_du_garant = $garant_courant->getNom_du_garant();

            $prenom_du_garant = $garant_courant->getPrenom_du_garant();

            $date_de_naissance_du_garant = $garant_courant->getDate_de_naissance();

            $adresse_d_habitation_du_garant = $garant_courant->getAdresse_d_habitation();

            $requete_preparee_de_recuperation_de_l_id_du_garant = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Garant WHERE nom = :nom_de_famille_du_garant AND prenom = :prenom_du_garant AND adresse_d_habitation = :adresse_d_habitation_du_garant AND date_de_naissance = :date_de_naissance_du_garant");

            $requete_preparee_de_recuperation_de_l_id_du_garant->bindParam(":nom_de_famille_du_garant", $nom_du_garant);

            $requete_preparee_de_recuperation_de_l_id_du_garant->bindParam(":prenom_du_garant", $prenom_du_garant);

            $requete_preparee_de_recuperation_de_l_id_du_garant->bindParam(":adresse_d_habitation_du_garant", $adresse_d_habitation_du_garant);

            $requete_preparee_de_recuperation_de_l_id_du_garant->bindParam(":date_de_naissance_du_garant", $date_de_naissance_du_garant);

            $requete_preparee_de_recuperation_de_l_id_du_garant->execute();

            $resultat_de_la_requete_preparee_de_recuperation_de_l_id_du_garant = $requete_preparee_de_recuperation_de_l_id_du_garant->fetchAll(PDO::FETCH_BOTH);

            return $resultat_de_la_requete_preparee_de_recuperation_de_l_id_du_garant[0][0];

        }
        else
        {

            return 0;

        }

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

            if(!empty($numero_de_telephone_passe_en_parametre))
            {

                $variable_de_retour = False;

            }

        }

        return $variable_de_retour;
    }

    //
    function verification_de_la_pertinance_des_donnees_renseignees_pour_la_generation_de_l_attestation($nom_de_famille_du_locataire, $prenom_du_locataire, $numero_de_studio_du_locataire, $date_d_arrivee_sous_forme_de_datetime_SQL)
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
        elseif($type_de_contrat_choisi_sous_forme_d_id == 2)
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
function formatage_date_du_format_de_DateTime_SQL_a_celui_de_calendar_jQuery_Ui($date_passee_en_parametre_pour_formatage)
{

    $date_passee_en_parametre_sous_forme_de_tableau = explode("-", $date_passee_en_parametre_pour_formatage);

    return $date_passee_en_parametre_sous_forme_de_tableau[1] . "/" . $date_passee_en_parametre_sous_forme_de_tableau[2] . "/" . $date_passee_en_parametre_sous_forme_de_tableau[0];

}

//
function renvoi_d_une_date_passee_en_parametre_sous_forme_de_DateTime_et_de_Timestamp($date_passee_en_parametre)
{

    $date_passee_en_parametre_sous_forme_de_tableau = explode("/", $date_passee_en_parametre);

    $date_passee_en_parametre_sous_format_francophone = $date_passee_en_parametre_sous_forme_de_tableau[1] . "/" . $date_passee_en_parametre_sous_forme_de_tableau[0] . "/" . $date_passee_en_parametre_sous_forme_de_tableau[2];

    $date_passee_en_parametre_sous_forme_de_DateTime = new DateTime($date_passee_en_parametre_sous_forme_de_tableau[2] . "-" . $date_passee_en_parametre_sous_forme_de_tableau[0] . "-" . $date_passee_en_parametre_sous_forme_de_tableau[1]);

    $date_passee_en_parametre_sous_forme_de_chaine_de_caracteres = $date_passee_en_parametre_sous_forme_de_tableau[2] . "-" . $date_passee_en_parametre_sous_forme_de_tableau[0] . "-" . $date_passee_en_parametre_sous_forme_de_tableau[1];

    $date_passee_en_parametre_sous_forme_de_timestamp = $date_passee_en_parametre_sous_forme_de_DateTime->getTimestamp();

    $renvoi_de_la_date = array(
        "datetime" => $date_passee_en_parametre_sous_forme_de_DateTime,
        "timestamp" => $date_passee_en_parametre_sous_forme_de_timestamp,
        "francophone" => $date_passee_en_parametre_sous_format_francophone,
        "chaine_de_caracteres" => $date_passee_en_parametre_sous_forme_de_chaine_de_caracteres
    );

    return $renvoi_de_la_date;

}

//
function extraction_de_l_id_du_studio_a_partir_de_son_numero($numero_du_studio_concerne)
{
    $requete_de_renvoi_de_l_id_du_studio_a_partir_de_son_numero = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Studio WHERE Studio.numero_du_studio = :numero_du_studio_concerne");

    $requete_de_renvoi_de_l_id_du_studio_a_partir_de_son_numero->bindParam(":numero_du_studio_concerne", $numero_du_studio_concerne);

    $requete_de_renvoi_de_l_id_du_studio_a_partir_de_son_numero->execute();

    $resultat_de_la_requete_de_renvoi_de_l_id_du_studio_a_partir_de_son_numero = $requete_de_renvoi_de_l_id_du_studio_a_partir_de_son_numero->fetchAll(PDO::FETCH_BOTH);

    $id_du_studio = $resultat_de_la_requete_de_renvoi_de_l_id_du_studio_a_partir_de_son_numero[0][0];

    return $id_du_studio;

}

//
function verification_que_le_locataire_occupe_bel_et_bien_le_studio($id_du_locataire_concerne, $id_du_studio_concerne)
{
    $variable_de_retour = False;

    $requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Contrat WHERE Contrat.studio = :id_du_studio AND Contrat.locataire = :id_du_locataire");

    $requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne->bindParam(":id_du_studio", $id_du_studio_concerne);

    $requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne->bindParam(":id_du_locataire", $id_du_locataire_concerne);

    $requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne->execute();

    $nombre_de_resultats_de_la_requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne = $requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne->rowCount();

    if($nombre_de_resultats_de_la_requete_de_verification_de_l_occupation_du_studio_par_le_locataire_concerne == 1)
    {

        $variable_de_retour = True;

    }

    return $variable_de_retour;
}

//
function renvoi_de_l_id_du_locataire_a_partir_de_son_nom_et_prenom($nom_de_famille_du_locataire, $prenom_du_locataire)
{

    $requete_de_renvoi_de_l_id_du_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Locataire WHERE Locataire.prenom = :prenom_du_locataire AND Locataire.nom = :nom_de_famille_du_locataire");

    $requete_de_renvoi_de_l_id_du_locataire->bindParam(":prenom_du_locataire", $prenom_du_locataire);

    $requete_de_renvoi_de_l_id_du_locataire->bindParam(":nom_de_famille_du_locataire", $nom_de_famille_du_locataire);

    $requete_de_renvoi_de_l_id_du_locataire->execute();

    $nombre_de_resultats_de_la_requete = $requete_de_renvoi_de_l_id_du_locataire->rowCount();

    if($nombre_de_resultats_de_la_requete == 1)
    {

        $resultat_de_la_requete = $requete_de_renvoi_de_l_id_du_locataire->fetchAll(PDO::FETCH_BOTH);

        return $resultat_de_la_requete[0][0];

    }
    else
    {

        return 0;

    }
}

//
function renvoi_de_l_id_du_garant_a_partir_de_son_nom_et_prenom($nom_de_famille_du_garant, $prenom_du_garant)
{

    $requete_de_renvoi_de_l_id_du_garant = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Garant WHERE Garant.prenom = :prenom_du_garant AND Garant.nom = :nom_de_famille_du_garant");

    $requete_de_renvoi_de_l_id_du_garant->bindParam(":prenom_du_garant", $prenom_du_garant);

    $requete_de_renvoi_de_l_id_du_garant->bindParam(":nom_de_famille_du_garant", $nom_de_famille_du_garant);

    $requete_de_renvoi_de_l_id_du_garant->execute();

    $nombre_de_resultats_de_la_requete = $requete_de_renvoi_de_l_id_du_garant->rowCount();

    if($nombre_de_resultats_de_la_requete == 1)
    {

        $resultat_de_la_requete = $requete_de_renvoi_de_l_id_du_garant->fetchAll(PDO::FETCH_BOTH);

        return $resultat_de_la_requete[0][0];

    }
    else
    {

        return 0;

    }
}

//
function verification_que_le_studio_est_libre($id_du_studio_concerne)
{

    $variable_de_retour = False;

    $requete_de_verification_de_l_occupation_du_studio_par_un_locataire = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Contrat WHERE Contrat.studio = :id_du_studio");

    $requete_de_verification_de_l_occupation_du_studio_par_un_locataire->bindParam(":id_du_studio", $id_du_studio_concerne);

    $requete_de_verification_de_l_occupation_du_studio_par_un_locataire->execute();

    $nombre_de_resultats_de_la_requete_de_verification_de_l_occupation_du_studio_par_un_locataire = $requete_de_verification_de_l_occupation_du_studio_par_un_locataire->rowCount();

    if($nombre_de_resultats_de_la_requete_de_verification_de_l_occupation_du_studio_par_un_locataire == 0)
    {

        $variable_de_retour = True;

    }

    return $variable_de_retour;
}

//
function renvoi_de_toutes_les_donnees_relatives_a_la_gestion_du_parc_locatif()
{

    //
    $tableau_de_recuperation_des_differentes_donnees_relatives_au_parc_locatif = array();

    //
    $requete_de_selection_de_tous_les_studios = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id, numero_du_studio, surface FROM Studio");

    //
    $requete_de_selection_de_tous_les_studios->execute();

    //
    $nombre_de_resultats_de_la_requete_de_selection_de_tous_les_studios = $requete_de_selection_de_tous_les_studios->rowCount();

    //
    $resultats_de_la_requete_de_selection_de_tous_les_studios = $requete_de_selection_de_tous_les_studios->fetchAll(PDO::FETCH_ASSOC);

    //
    for($incrementeur = 0; $incrementeur < $nombre_de_resultats_de_la_requete_de_selection_de_tous_les_studios; $incrementeur++)
    {

        //
        $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante = "";

        //
        $id_du_studio_concerne = $resultats_de_la_requete_de_selection_de_tous_les_studios[$incrementeur]['id'];

        //
        $numero_du_studio_courant = $resultats_de_la_requete_de_selection_de_tous_les_studios[$incrementeur]['numero_du_studio'];

        //
        $identifiant_de_la_surface_du_studio_courant = $resultats_de_la_requete_de_selection_de_tous_les_studios[$incrementeur]['surface'];

        //
        $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante .= $numero_du_studio_courant;

        //
        if(strlen($numero_du_studio_courant) == 3)
        {

            //
            $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante .= "_" . $numero_du_studio_courant[0];

        }
        //Sinon...
        else
        {

            //
            $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante .= "_" . "rez-de-chaussée";

        }

        //
        $libelle_de_la_surface = renvoi_du_libelle_de_la_surface_a_partir_de_son_id($identifiant_de_la_surface_du_studio_courant);

        //
        $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante .= "_" . $libelle_de_la_surface . "m²";

        //
        $variable_de_verification_que_le_studio_est_libre = verification_que_le_studio_est_libre($id_du_studio_concerne);

        //
        if($variable_de_verification_que_le_studio_est_libre == True)
        {

            //
            $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante .= "_Non";

        }
        //Sinon...
        else
        {

            //
            $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante .= "_Oui";

        }

        //
        array_push($tableau_de_recuperation_des_differentes_donnees_relatives_au_parc_locatif, $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante);

    }

    //
    return $tableau_de_recuperation_des_differentes_donnees_relatives_au_parc_locatif;
}

//
function renvoi_des_donnees_relatives_a_la_gestion_des_relances_d_impayes()
{

    //
    $tableau_de_recuperation_des_donnees_relatives_aux_relances_d_impayes = array();

    //
    $requete_de_selection_de_toutes_les_relances_d_impayes = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT date_du_jour, montant_du, contrat FROM Relance_loyer_impaye");

    //
    $requete_de_selection_de_toutes_les_relances_d_impayes->execute();

    //
    $nombre_de_resultats_de_la_requete_de_selection_de_toutes_les_relances_d_impayes = $requete_de_selection_de_toutes_les_relances_d_impayes->rowCount();

    //
    $resutats_de_la_requete_de_selection_de_toutes_les_relances_d_impayes = $requete_de_selection_de_toutes_les_relances_d_impayes->fetchAll(PDO::FETCH_ASSOC);

    //
    for($incrementeur = 0; $incrementeur < $nombre_de_resultats_de_la_requete_de_selection_de_toutes_les_relances_d_impayes; $incrementeur++)
    {

        //
        $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante = "";

        //
        $date_de_la_relance_sous_forme_de_DateTime = $resutats_de_la_requete_de_selection_de_toutes_les_relances_d_impayes[$incrementeur]['date_du_jour'];

        //
        $date_de_la_relance_sous_forme_de_tableau = explode("-", $date_de_la_relance_sous_forme_de_DateTime);

        //
        $date_de_la_relance = $date_de_la_relance_sous_forme_de_tableau[2] . "/" . $date_de_la_relance_sous_forme_de_tableau[1] . "/" . $date_de_la_relance_sous_forme_de_tableau[0];

        //
        $montant_du = $resutats_de_la_requete_de_selection_de_toutes_les_relances_d_impayes[$incrementeur]['montant_du'];

        //
        $id_du_contrat = $resutats_de_la_requete_de_selection_de_toutes_les_relances_d_impayes[$incrementeur]['contrat'];

        //
        $tableau_contenant_l_id_du_locataire_et_l_id_du_studio = renvoi_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat($id_du_contrat);

        //
        $id_du_locataire = $tableau_contenant_l_id_du_locataire_et_l_id_du_studio[0];

        //
        $id_du_studio = $tableau_contenant_l_id_du_locataire_et_l_id_du_studio[1];

        //
        $tableau_contenant_le_nom_et_le_prenom_du_locataire_a_partir_de_son_id = renvoi_du_nom_et_du_prenom_du_locataire_a_partir_de_son_id($id_du_locataire);

        //
        $nom_de_famille_du_locataire = $tableau_contenant_le_nom_et_le_prenom_du_locataire_a_partir_de_son_id[0];

        //
        $prenom_du_locataire = $tableau_contenant_le_nom_et_le_prenom_du_locataire_a_partir_de_son_id[1];

        //
        $numero_du_studio_occupe_par_le_locataire = extraction_du_numero_du_studio_a_partir_de_son_id($id_du_studio);

        //
        $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante = $nom_de_famille_du_locataire . "_" . $prenom_du_locataire . "_" .$numero_du_studio_occupe_par_le_locataire . "_" . $date_de_la_relance . "_" . $montant_du;

        //
        array_push($tableau_de_recuperation_des_donnees_relatives_aux_relances_d_impayes, $chaine_de_caracteres_contenant_les_donnees_de_la_ligne_courante);

    }

    //
    return $tableau_de_recuperation_des_donnees_relatives_aux_relances_d_impayes;

}

function renvoi_de_toutes_les_donnees_relatives_aux_documents_d_expiration_de_contrat_de_location()
{

    //
    $tableau_de_recuperation_des_donnees_relatives_aux_documents_d_expiration_de_contrat_de_location = array();

    //
    $requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT date_du_jour, contrat FROM Expiration_de_contrat_de_location");

    //
    $requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location->execute();

    //
    $nombre_de_resultats_de_la_requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location = $requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location->rowCount();

    //
    $resultats_de_la_requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location = $requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location->fetchAll(PDO::FETCH_ASSOC);

    //
    for($incrementeur = 0; $incrementeur < $nombre_de_resultats_de_la_requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location; $incrementeur++)
    {

        //
        $chaine_de_caracteres_contenant_les_donnees_du_document_d_expiration_de_contrat_de_location_courant = "";

        //
        $id_du_contrat = $resultats_de_la_requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location[$incrementeur]['contrat'];

        //
        $date_de_generation_de_document_d_expiration_de_contrat_de_location_sous_forme_de_DateTime = $resultats_de_la_requete_de_selection_de_tous_les_documents_d_expiration_de_contrat_de_location[$incrementeur]['date_du_jour'];

        //
        $date_de_generation_de_document_d_expiration_de_contrat_de_location_sous_forme_de_tableau = explode("-", $date_de_generation_de_document_d_expiration_de_contrat_de_location_sous_forme_de_DateTime);

        //
        $date_de_generation_de_document_d_expiration_de_contrat_de_location = $date_de_generation_de_document_d_expiration_de_contrat_de_location_sous_forme_de_tableau[2] . "/" . $date_de_generation_de_document_d_expiration_de_contrat_de_location_sous_forme_de_tableau[1] . "/" . $date_de_generation_de_document_d_expiration_de_contrat_de_location_sous_forme_de_tableau[0];

        //
        $tableau_contenant_l_id_du_locataire_et_l_id_du_studio = renvoi_de_l_id_du_locataire_et_de_l_id_du_studio_a_partir_de_l_id_du_contrat($id_du_contrat);

        //
        $id_du_locataire = $tableau_contenant_l_id_du_locataire_et_l_id_du_studio[0];

        //
        $id_du_studio = $tableau_contenant_l_id_du_locataire_et_l_id_du_studio[1];

        //
        $tableau_contenant_le_nom_et_le_prenom_du_locataire_a_partir_de_son_id = renvoi_du_nom_et_du_prenom_du_locataire_a_partir_de_son_id($id_du_locataire);

        //
        $nom_de_famille_du_locataire = $tableau_contenant_le_nom_et_le_prenom_du_locataire_a_partir_de_son_id[0];

        //
        $prenom_du_locataire = $tableau_contenant_le_nom_et_le_prenom_du_locataire_a_partir_de_son_id[1];

        //
        $numero_du_studio_occupe_par_le_locataire = extraction_du_numero_du_studio_a_partir_de_son_id($id_du_studio);

        //
        $chaine_de_caracteres_contenant_les_donnees_du_document_d_expiration_de_contrat_de_location_courant .= $nom_de_famille_du_locataire . "_" . $prenom_du_locataire . "_" . $numero_du_studio_occupe_par_le_locataire . "_" . $date_de_generation_de_document_d_expiration_de_contrat_de_location;

        //
        array_push($tableau_de_recuperation_des_donnees_relatives_aux_documents_d_expiration_de_contrat_de_location, $chaine_de_caracteres_contenant_les_donnees_du_document_d_expiration_de_contrat_de_location_courant);

    }

    //
    return $tableau_de_recuperation_des_donnees_relatives_aux_documents_d_expiration_de_contrat_de_location;

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

            $identifiant_du_locataire = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_locataire();

            $identifiant_du_studio = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_studio();

            $identifiant_du_garant = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_garant();

            $identifiant_du_type_de_contrat = $element_a_inserer_dans_la_base_de_donnees->getId_du_type_de_contrat();

            $date_du_jour_de_generation_du_contrat_de_location_PDF = $element_a_inserer_dans_la_base_de_donnees->getDate_du_jour();

            $date_de_debut_du_contrat_de_location_PDF = $element_a_inserer_dans_la_base_de_donnees->getDate_de_debut();

            $date_de_fin_du_contrat_de_location_PDF = $element_a_inserer_dans_la_base_de_donnees->getDate_de_fin();

            $encaissement_du_depot_de_garantie = $element_a_inserer_dans_la_base_de_donnees->getEncaissement_du_depot_de_garantie();

            $montant_du_loyer = $element_a_inserer_dans_la_base_de_donnees->getMontant_du_loyer();

            $chemin_du_fichier_genere = $element_a_inserer_dans_la_base_de_donnees->getChemin_du_fichier_genere();

            $date_de_debut = $date_de_debut_du_contrat_de_location_PDF->format("Y-m-d");

            $date_de_fin = $date_de_fin_du_contrat_de_location_PDF->format("Y-m-d");

            $date_du_jour = $date_du_jour_de_generation_du_contrat_de_location_PDF->format("Y-m-d");

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, date_du_jour, montant_du_loyer, encaissement_du_depot_de_garantie) VALUES(:locataire, :studio, :garant, :type_de_contrat, :date_de_debut_de_contrat, :date_de_fin_du_contrat, :date_du_jour, :montant_du_loyer, :encaissement_du_depot_de_garantie, :chemin_d_accee)");

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':locataire', $identifiant_du_locataire);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':studio', $identifiant_du_studio);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':garant', $identifiant_du_garant);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':type_de_contrat', $identifiant_du_type_de_contrat);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':date_de_debut_du_contrat', $date_de_debut);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':date_de_fin_du_contrat', $date_de_fin);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':date_du_jour', $date_du_jour);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':montant_du_loyer', $montant_du_loyer);

            $requete_preparee_d_insertion_du_contrat_de_location_dans_la_base->bindParam(':chemin_d_accee', $chemin_du_fichier_genere);

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Garant"))
        {

            $nom_de_famille_du_garant = $element_a_inserer_dans_la_base_de_donnees->getNom_du_garant();

            $prenom_du_garant = $element_a_inserer_dans_la_base_de_donnees->getPrenom_du_garant();

            $adresse_d_habitation_du_garant = $element_a_inserer_dans_la_base_de_donnees->getAdresse_d_habitation();

            $date_de_naissance_du_garant = $element_a_inserer_dans_la_base_de_donnees->getDate_de_naissance();

            $date_de_naissance_du_garant_sous_forme_de_String = $date_de_naissance_du_garant->format("Y-m-d");

            $requete_preparee_d_insertion_du_garant_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES(:nom_de_famille_du_garant, :prenom_du_garant, :date_de_naissance_du_garant, :adresse_d_habitation_du_garant)");

            $requete_preparee_d_insertion_du_garant_dans_la_base->bindParam(":nom_de_famille_du_garant", $nom_de_famille_du_garant);

            $requete_preparee_d_insertion_du_garant_dans_la_base->bindParam(":prenom_du_garant", $prenom_du_garant);

            $requete_preparee_d_insertion_du_garant_dans_la_base->bindParam(":adresse_d_habitation_du_garant", $adresse_d_habitation_du_garant);

            $requete_preparee_d_insertion_du_garant_dans_la_base->bindParam(":date_de_naissance_du_garant", $date_de_naissance_du_garant_sous_forme_de_String);

            $requete_preparee_d_insertion_du_garant_dans_la_base->execute();

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Studio"))
        {

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Attestation"))
        {
            $chemin_du_fichier_genere = $element_a_inserer_dans_la_base_de_donnees->getChemin_du_fichier_genere();

            $date_du_jour = $element_a_inserer_dans_la_base_de_donnees->getDate_du_jour();

            $contrat_de_location = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_contrat_de_location();

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Attestation(date_du_jour, chemin_d_accee, contrat) VALUES(:date_du_jour, :chemin_d_accee, :contrat_de_location)");

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":date_du_jour", $date_du_jour);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":chemin_d_accee", $chemin_du_fichier_genere);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":contrat_de_location", $contrat_de_location);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->execute();

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Preavis"))
        {
            $chemin_du_fichier_genere = $element_a_inserer_dans_la_base_de_donnees->getChemin_du_fichier_genere();

            $date_du_jour = $element_a_inserer_dans_la_base_de_donnees->getDate_du_jour();

            $contrat_de_location = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_contrat_de_location();

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Preavis(date_du_jour, chemin_d_accee, contrat) VALUES(:date_du_jour, :chemin_d_accee, :contrat_de_location)");

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":date_du_jour", $date_du_jour);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":chemin_d_accee", $chemin_du_fichier_genere);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":contrat_de_location", $contrat_de_location);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->execute();

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Expiration_de_contrat_de_location"))
        {

            $chemin_du_fichier_genere = $element_a_inserer_dans_la_base_de_donnees->getChemin_du_fichier_genere();

            $date_du_jour = $element_a_inserer_dans_la_base_de_donnees->getDate_du_jour();

            $contrat_de_location = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_contrat_de_location();

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Expiration_de_contrat_de_location(date_du_jour, chemin_d_accee, contrat) VALUES(:date_du_jour, :chemin_d_accee, :contrat_de_location)");

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":date_du_jour", $date_du_jour);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":chemin_d_accee", $chemin_du_fichier_genere);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->bindParam(":contrat_de_location", $contrat_de_location);

            $requete_preparee_d_insertion_de_l_attestation_dans_la_base->execute();

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Etat_des_lieux"))
        {

            $chemin_du_fichier_genere = $element_a_inserer_dans_la_base_de_donnees->getChemin_du_fichier_genere();

            $date_du_jour = $element_a_inserer_dans_la_base_de_donnees->getDate_du_jour();

            $contrat_de_location = $element_a_inserer_dans_la_base_de_donnees->getIdentifiant_du_contrat_de_location();

            $date_et_heure_programmees = $element_a_inserer_dans_la_base_de_donnees->getDate_et_heure_programmees();

            $requete_preparee_d_insertion_de_l_etat_des_lieux_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Etat_des_lieux(date_du_jour, chemin_d_accee, contrat, date_et_heure_programmees) VALUES(:date_du_jour, :chemin_d_accee, :contrat_de_location, :date_et_heure_programmees)");

            $requete_preparee_d_insertion_de_l_etat_des_lieux_dans_la_base->bindParam(":date_du_jour", $date_du_jour);

            $requete_preparee_d_insertion_de_l_etat_des_lieux_dans_la_base->bindParam(":chemin_d_accee", $chemin_du_fichier_genere);

            $requete_preparee_d_insertion_de_l_etat_des_lieux_dans_la_base->bindParam(":contrat_de_location", $contrat_de_location);

            $requete_preparee_d_insertion_de_l_etat_des_lieux_dans_la_base->bindParam(":date_et_heure_programmees", $date_et_heure_programmees);

            $requete_preparee_d_insertion_de_l_etat_des_lieux_dans_la_base->execute();

        }
        elseif(is_a($element_a_inserer_dans_la_base_de_donnees, "Relance_loyer_impaye"))
        {

            $date_du_jour = $element_a_inserer_dans_la_base_de_donnees->getDate_du_jour();

            $montant_du = $element_a_inserer_dans_la_base_de_donnees->getMontant_du();

            $chemin_du_fichier_genere = $element_a_inserer_dans_la_base_de_donnees->getChemin_du_fichier_genere();

            $contrat_de_location = $element_a_inserer_dans_la_base_de_donnees->getId_du_contrat();

            $requete_preparee_d_insertion_de_la_relance_loyer_impaye_dans_la_base = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("INSERT INTO Relance_loyer_impaye(date_du_jour, chemin_d_accee, montant_du, contrat) VALUES(:date_du_jour, :chemin_d_accee, :montant_du, :contrat_de_location)");

            $requete_preparee_d_insertion_de_la_relance_loyer_impaye_dans_la_base->bindParam(":date_du_jour", $date_du_jour);

            $requete_preparee_d_insertion_de_la_relance_loyer_impaye_dans_la_base->bindParam(":montant_du", $montant_du);

            $requete_preparee_d_insertion_de_la_relance_loyer_impaye_dans_la_base->bindParam(":chemin_d_accee", $chemin_du_fichier_genere);

            $requete_preparee_d_insertion_de_la_relance_loyer_impaye_dans_la_base->bindParam(":contrat_de_location", $contrat_de_location);

            $requete_preparee_d_insertion_de_la_relance_loyer_impaye_dans_la_base->execute();

        }
        else
        {
            throw new PDOException("L'élément passé en paramétre n'est pas une instance d'une des classes métiers");
        }
    }