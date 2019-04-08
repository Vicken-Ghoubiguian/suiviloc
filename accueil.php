<?php

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //Cette fonction permet de démarrer une session
    session_start();

    //
    if(isset($_SESSION) && !empty($_SESSION)) {

        //
        $date_et_heure_au_moment_du_chargement_de_la_page = time();

        //
        $date_et_heure_de_derniere_connexion = new DateTime($_SESSION["date_et_heure_de_derniere_connexion"]);

        //
        $date_et_heure_de_derniere_connexion_sous_forme_de_timestamp = $date_et_heure_de_derniere_connexion->getTimestamp();

        //
        if($_SESSION["date_et_heure_d_expiration_de_la_session"] > $date_et_heure_au_moment_du_chargement_de_la_page) {

                //
                require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

                //
                $corps_de_la_page_html = "<body><div id='tabs_des_fonctionnalites'>
                                        <ul>
                                            <li><a href='#bienvenue'>Bienvenue</a></li>
                                            <li><a href='#gestion_du_parc_locatif'>Gestion du parc locatif</a></li>
                                            <li><a href='#contrat_de_location'>Contrat de location</a></li>
                                            <li><a href='#attestation'>Attestation</a></li>
                                            <li><a href='#relance_impayee'>Relance impayée</a></li>
                                            <li><a href='#expiration_de_contrat_de_location'>Expiration de contrat de location</a></li>
                                            <li><a href='#accuses_de_reception'>Accusés de réception</a></li>
                                        </ul>
                                        <div id='bienvenue'>
                                            <h1>Bienvenue sur Suiviloc</h1>
                                            <br>
                                            <p>Logiciel de gestion de parc locatif</p>
                                            <br>
                                            <ul>
                                                <li>Gérez le parc locatif</li>
                                                <li>Gérez les locations</li>
                                                <li>Voyez les locations à venir</li>
                                                <li>Générez des contrats de location</li>
                                                <li>Générez des attestations</li>
                                                <li>Gérez les expirations des contrats de location</li>
                                                <li>Générez des relances d'impayées</li>
                                                <li>Générez des lettres d'expiration de contrat de location</li>
                                                <li>Générez des accusés de réception quand des gens envoient leurs préavis de départ</li>
                                            </ul>
                                            <br>
                                            <button class='ui-button ui-corner-all ui-widget' id='bouton_de_deconnexion'>Déconnectez-vous</button>
                                            </div>
                                            <div id='gestion_du_parc_locatif'>
                                                
                                            </div>
                                            <div id='contrat_de_location'>
                                                <h3 class='sous-menu'>Consulter les contrats de location</h3>
                                                <h3 class='sous-menu'>Generer des contrats de location</h3>
                                                <h3 class='sous-menu'>Lire les contrats de location</h3>
                                                <h3 class='sous-menu'>Envoyer des contrats de location</h3>
                                            </div>
                                            <div id='attestation'>
                                                <h3 class='sous-menu'>Consulter les attestations</h3>
                                                <h3 class='sous-menu'>Generer des attestations</h3>
                                                <h3 class='sous-menu'>Lire les attestations</h3>
                                                <h3 class='sous-menu'>Envoyer des attestations</h3>
                                            </div>
                                            <div id='relance_impayee'>
                                                <h3 class='sous-menu'>Consulter les relances impayées</h3>
                                                <h3 class='sous-menu'>Generer des relances impayées</h3>
                                                <h3 class='sous-menu'>Lire les relances impayées</h3>
                                                <h3 class='sous-menu'>Envoyer des relances impayées</h3>
                                            </div>
                                            <div id='expiration_de_contrat_de_location'>
                                                
                                            </div>
                                            <div id='accuses_de_reception'>
                                                <h3 class='sous-menu'>Consulter les accusés de récéption</h3>
                                                <h3 class='sous-menu'>Generer des accusés de récéption</h3>
                                                <h3 class='sous-menu'>Lire les accusés de récéption</h3>
                                                <h3 class='sous-menu'>Envoyer des accusés de récéption</h3>
                                            </div>
                                            <div>
                                                Connecté en tant que " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . " (" . $_SESSION['username'] . ") - connecté depuis le " . date('d/m/Y à H:i:s', $_SESSION['date_et_heure_de_creation_de_la_session']) . " - connecté jusqu'au " . date('d/m/Y à H:i:s', $_SESSION["date_et_heure_d_expiration_de_la_session"]) . " - derniére connexion le ". date('d/m/Y à H:i:s', $date_et_heure_de_derniere_connexion_sous_forme_de_timestamp) . ".
                                            </div>
                                        </div>
                                        <div id='fenetre_de_deconnexion' title='Déconnexion'>
                                            <p>Voulez-vous vous déconnecter de l'application ?</p>
                                        </div>";

            //
            $pied_de_la_page_html = "<footer>
                                        &copy; 2019 residence locative - adresse de la résidence locative
                                    </footer>
                                </body>
                            </html>";

            //La page d'accueil, comprenant toutes les fonctionnalités de l'application, est affichée
            echo $corps_de_la_page_html.$pied_de_la_page_html;

        }
        //Sinon...
        else
        {

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
            $nouvelle_date_et_heure_de_derniere_connexion = new DateTime("now");

            //
            $nouvelle_date_et_heure_de_derniere_connexion = $nouvelle_date_et_heure_de_derniere_connexion->format("Y-m-d H:i:sP");

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