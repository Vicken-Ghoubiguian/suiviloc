<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/03/19
 * Time: 14:10
 */

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //
    require_once("smarty/libs/Smarty.class.php");

    //
    if(isset($_POST['soumission_du_formulaire_d_authentification']))
    {

        //
        try
        {

            //Préparation de la requete de
            $requete_preparee_pour_identification_de_l_uttilisateur = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT username, password, est_connecte FROM gestion_de_parc_locatif.Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE username = :uttilisateur and password = :mot_de_passe");

            //
            $nom_de_l_uttilisateur_pour_authentification = htmlspecialchars($_POST["champ_texte_pour_identifiant_pour_authentification"]);

            //
            $mot_de_passe_passe_par_l_uttilisateur_pour_authentification = htmlspecialchars($_POST["champ_password_pour_mot_de_passe_pour_authentification"]);

            //
            $mot_de_passe_crypte_de_l_uttilisateur_pour_authentification = sha1($mot_de_passe_passe_par_l_uttilisateur_pour_authentification);

            //
            $requete_preparee_pour_identification_de_l_uttilisateur->bindParam(":uttilisateur", $nom_de_l_uttilisateur_pour_authentification);

            //
            $requete_preparee_pour_identification_de_l_uttilisateur->bindParam(":mot_de_passe", $mot_de_passe_crypte_de_l_uttilisateur_pour_authentification);

            //Execution de la requete préparée
            $requete_preparee_pour_identification_de_l_uttilisateur->execute();

            //Le nombre de résultats
            $nombre_de_resultats_de_la_requete = $requete_preparee_pour_identification_de_l_uttilisateur->rowCount();

            //
            $resultat_de_la_requete_preparee_pour_identification_de_l_uttilisateur = $requete_preparee_pour_identification_de_l_uttilisateur->fetch(PDO::FETCH_ASSOC);

            //
            if($nombre_de_resultats_de_la_requete == 1 && $resultat_de_la_requete_preparee_pour_identification_de_l_uttilisateur["est_connecte"] == 0)
            {
                //
                $requete_preparee_pour_identification_de_l_uttilisateur = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT username, nom, prenom, date_et_heure_de_derniere_connexion FROM gestion_de_parc_locatif.Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE username = :uttilisateur and password = :mot_de_passe");

                //
                $requete_preparee_pour_identification_de_l_uttilisateur->bindParam(":uttilisateur", $nom_de_l_uttilisateur_pour_authentification);

                //
                $requete_preparee_pour_identification_de_l_uttilisateur->bindParam(":mot_de_passe", $mot_de_passe_crypte_de_l_uttilisateur_pour_authentification);

                //Execution de la requete préparée
                $requete_preparee_pour_identification_de_l_uttilisateur->execute();

                //
                $resultat_de_la_requete = $requete_preparee_pour_identification_de_l_uttilisateur->fetch(PDO::FETCH_ASSOC);

                //
                $identifiant_de_l_uttilisateur = htmlspecialchars($resultat_de_la_requete["username"]);

                //
                $nom_de_l_uttilisateur = htmlspecialchars($resultat_de_la_requete["nom"]);

                //
                $prenom_de_l_uttilisateur = htmlspecialchars($resultat_de_la_requete["prenom"]);

                //
                $date_et_heure_de_derniere_connexion = $resultat_de_la_requete["date_et_heure_de_derniere_connexion"];

                //
                $duree_de_vie_de_la_session_en_nbr_de_secondes = (int)ini_get("session.gc_maxlifetime");

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_connecte = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET est_connecte = 1 WHERE username = :uttilisateur and nom = :nom and prenom = :prenom");

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_connecte->bindParam(":uttilisateur", $identifiant_de_l_uttilisateur);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_connecte->bindParam(":nom", $nom_de_l_uttilisateur);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_connecte->bindParam(":prenom", $prenom_de_l_uttilisateur);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_connecte->execute();

                //La fonction session_start permet de démarrer une session
                session_start();

                //Dans la variable globale $_SESSION (identifiant la session en cours), le nom d'uttilisateur de l'uttilisateur (ou username) de l'uttilisateur est renseigné
                $_SESSION["username"] = $identifiant_de_l_uttilisateur;

                //Dans la variable globale $_SESSION (identifiant la session en cours), le nom de famille de l'uttilisateur est renseigné
                $_SESSION["nom"] = $nom_de_l_uttilisateur;

                //Dans la variable globale $_SESSION (identifiant la session en cours), le prenom de l'uttilisateur est renseigné
                $_SESSION["prenom"] = $prenom_de_l_uttilisateur;

                //
                $_SESSION["date_et_heure_de_derniere_connexion"] = $date_et_heure_de_derniere_connexion;

                //Dans la variable globale $_SESSION (identifiant la session en cours), la date et l'heure de création de la session (sous forme de timestamp) sont renseignées
                $_SESSION["date_et_heure_de_creation_de_la_session"] = time();

                //
                $_SESSION["date_et_heure_d_expiration_de_la_session"] = time() + $duree_de_vie_de_la_session_en_nbr_de_secondes;

                //Finalement, l'uttilisateur est redirigé vers la page d'index de l'application
                header("Location: index.php");

                //
                exit;
            }
            //
            elseif($nombre_de_resultats_de_la_requete == 1 && $resultat_de_la_requete_preparee_pour_identification_de_l_uttilisateur["est_connecte"] == 1)
            {

                //
                require("vues/page_d_authentification_en_cas_de_connection_refusee_pour_cause_d_uttilisateur_deja_connecte.html");

            }
            //
            else
            {

                //
                require("vues/page_d_authentification_en_cas_de_connexion_refusee_pour_cause_de_mauvais_mot_de_passe.html");
            }
        }
        catch(Exception $exception_de_connexion)
        {

            //
            $smarty = new Smarty();

            //
            $smarty->assign(array("message_d_erreur_de_connexion_a_la_base_de_donnees" => $exception_de_connexion->getMessage()));

            //
            $smarty->display("vues/page_d_authentification_en_cas_d_erreur_PDO.html");
        }
    }
    else
    {

        //
        require("vues/page_d_authentification.html");
    }
