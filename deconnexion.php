<?php

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //
    require_once("smarty/libs/Smarty.class.php");

    //
    session_start();

    //
    if(isset($_SESSION) && !empty($_SESSION)) {

        //
        $date_et_heure_au_moment_du_chargement_de_la_page = time();

        //
        if ($_SESSION["date_et_heure_d_expiration_de_la_session"] > $date_et_heure_au_moment_du_chargement_de_la_page) {

            //
            $nom_de_l_uttilisateur_courant = $_SESSION["nom"];

            //
            $prenom_de_l_uttilisateur_courant = $_SESSION["prenom"];

            //
            $username_de_l_uttilisateur_courant = $_SESSION["username"];

            //
            session_destroy();

            //
            session_unset();

            //
            try {

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET est_connecte = 0 WHERE username = :uttilisateur and nom = :nom and prenom = :prenom");

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->bindParam(":uttilisateur", $username_de_l_uttilisateur_courant);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->bindParam(":nom", $nom_de_l_uttilisateur_courant);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->bindParam(":prenom", $prenom_de_l_uttilisateur_courant);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->execute();

                //
                $nouvelle_date_et_heure_de_derniere_connexion = date("Y-m-d H:i:sP", $_SESSION["date_et_heure_de_creation_de_la_session"]);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET date_et_heure_de_derniere_connexion = :date_et_heure_de_derniere_connexion WHERE username = :uttilisateur and nom = :nom and prenom = :prenom");

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam(":uttilisateur", $username_de_l_uttilisateur_courant);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam(":nom", $nom_de_l_uttilisateur_courant);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam(":prenom", $prenom_de_l_uttilisateur_courant);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam("date_et_heure_de_derniere_connexion", $nouvelle_date_et_heure_de_derniere_connexion);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->execute();

                //
                require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

                //
                $corps_de_la_page_html = "<body class='corps_de_la_page_d_authentification'>
                                                    <div id='message_d_indication_de_deconnexion' title='déconnexion pour " . $nom_de_l_uttilisateur_courant . " " . $prenom_de_l_uttilisateur_courant . " (" . $username_de_l_uttilisateur_courant . ")'>
                                                        <p>Vous vous êtes déconnectés avec succès.</p>
                                                        <p>Si vous voulez vous authentifier de nouveau, cliquez sur le bouton 'Se réauthentifier'.</p>
                                                        <p>Si vous voulez quitter l'application, cliquez sur le bouton 'Quitter l'application'.</p>
                                                    </div>";

                //
                $pied_de_la_page_html = "</body>
                                           </html>";

                //La page d'accueil, comprenant toutes les fonctionnalités de l'application, est affichée
                echo $corps_de_la_page_html . $pied_de_la_page_html;

            } //
            catch (Exception $exception_de_connexion) {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("message_d_erreur_de_connexion_a_la_base_de_donnees" => $exception_de_connexion->getMessage()));

                //
                $smarty->display("vues/page_d_erreur_PDO_dans_l_application_suiviloc.html");
            }
        } //Sinon...
        else {

            //
            $nom_de_l_uttilisateur_courant = $_SESSION["nom"];

            //
            $prenom_de_l_uttilisateur_courant = $_SESSION["prenom"];

            //
            $username_de_l_uttilisateur_courant = $_SESSION["username"];

            //
            session_destroy();

            //
            session_unset();

            //
            try {

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET est_connecte = 0 WHERE username = :uttilisateur and nom = :nom and prenom = :prenom");

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->bindParam(":uttilisateur", $username_de_l_uttilisateur_courant);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->bindParam(":nom", $nom_de_l_uttilisateur_courant);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->bindParam(":prenom", $prenom_de_l_uttilisateur_courant);

                //
                $requete_preparee_pour_indiquer_dans_la_base_que_l_uttilisateur_est_deconnecte->execute();

                //
                $nouvelle_date_et_heure_de_derniere_connexion = date("Y-m-d H:i:sP", $_SESSION["date_et_heure_de_creation_de_la_session"]);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET date_et_heure_de_derniere_connexion = :date_et_heure_de_derniere_connexion WHERE username = :uttilisateur and nom = :nom and prenom = :prenom");

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam(":uttilisateur", $username_de_l_uttilisateur_courant);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam(":nom", $nom_de_l_uttilisateur_courant);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam(":prenom", $prenom_de_l_uttilisateur_courant);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->bindParam("date_et_heure_de_derniere_connexion", $nouvelle_date_et_heure_de_derniere_connexion);

                //
                $requete_preparee_de_mise_a_jour_de_la_derniere_connexion_de_l_uttilisateur->execute();

                //
                require("vues/page_de_deconnexion_suite_au_depassement_du_temps_d_expiration.html");
            } //
            catch (Exception $exception_de_connexion) {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array("message_d_erreur_de_connexion_a_la_base_de_donnees" => $exception_de_connexion->getMessage()));

                //
                $smarty->display("vues/page_d_erreur_PDO_dans_l_application_suiviloc.html");
            }

        }

    }
    //Sinon...
    else
    {

        //L'uttilisateur est redirigé vers la page d'accueil
        header("Location: index.php");

        //
        exit;
    }