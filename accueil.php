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
                $corps_de_la_page_html = "<body class='corps_de_la_page_d_authentification'><div id='tabs_des_fonctionnalites' class='bloc_des_fonctionnalites'>
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
                                            <h1 class='titre_de_bienvenue'>Bienvenue sur Suiviloc</h1>
                                            <br>
                                            <p class='sous-titre_de_bienvenue'>Logiciel de gestion de parc locatif</p>
                                            <br>
                                            <div class='enumeration_des_fonctionnalites'>
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
                                            </div>
                                            <br>
                                            <div class='bouton_pour_deconnexion_de_l_application_suiviloc'>
                                                <button class='ui-button ui-corner-all ui-widget' id='bouton_de_deconnexion'>Déconnectez-vous</button>
                                            </div>
                                        </div>
                                            <div id='gestion_du_parc_locatif'>
                                                
                                            </div>
                                            <div id='contrat_de_location'>
                                                <div class='menu_en_accordeon'>
                                                    <h3>Consulter les contrats de location</h3>
                                                    <div>
                                                        <p>ddd</p>
                                                    </div>
                                                    <h3>Générer des contrats de location</h3>
                                                    <div>
                                                        <p>
                                                            <form action='generation_d_un_document_PDF.php' method='post'>
                                                                <input type='hidden' name='type_de_document' value='contrat_de_location'>
                                                                <p>Bonjour,</p>
                                                                <p>Le prochain contrat de location concerne <input type='text' name='nom_de_famille_du_locataire' class='ui-corner-all text-warning'> <input type='text' name='prenom_du_locataire' class='ui-corner-all text-warning'>, né le <input type='text' name='date_de_naissance_du_locataire' class='text-warning calendrier_pour_faire_un_choix_de_date ui-corner-all' required></p>
                                                                <p>Celui-ci réside à cette adresse postale: <input type='text' name='adresse_postale_de_residence_du_locataire' class='ui-corner-all text-warning' size='73'>.</p>
                                                                <p>Le locataire est joignable au <input type='text' maxlength='10' name='numero_de_telephone_du_locataire' class='ui-corner-all text-warning' required>, et un email peut lui être écrit à l'adresse suivante: <input type='email' name='adresse_email_du_locataire' class='ui-corner-all text-warning' required>.</p>
                                                                <p>Celui-ci arrivera le <input type='text' name='date_d_arrivee_du_locataire_dans_son_studio' class='text-warning calendrier_pour_faire_un_choix_de_date ui-corner-all' required>.</p>
                                                                <p>Le client occupera le studio n°<select name='numero_du_studio_pour_a_choisir_pour_location' class='text-warning ui-corner-all' id='numero_du_studio_pour_a_choisir_pour_location' required>";

                                                                    //
                                                                    for($incrementeur_des_surfaces = 1; $incrementeur_des_surfaces < 3; $incrementeur_des_surfaces++) {

                                                                        //
                                                                        if($incrementeur_des_surfaces == 1)
                                                                        {

                                                                            $corps_de_la_page_html .= "<optgroup label='15m2'>";

                                                                        }
                                                                        else
                                                                        {

                                                                            $corps_de_la_page_html .= "<optgroup label='18m2'>";

                                                                        }

                                                                        //
                                                                        //$requete_preparee_pour_afficher_pour_selection_les_studios_disponibles = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Studio.numero_du_studio FROM Studio INNER JOIN Contrat ON Contrat.studio WHERE Contrat.studio != Studio.id AND Studio.surface = :id_de_la_surface");

                                                                        //
                                                                        $requete_preparee_pour_afficher_pour_selection_les_studios_disponibles = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Studio.numero_du_studio FROM Studio WHERE Studio.surface = :id_de_la_surface");

                                                                        //
                                                                        $requete_preparee_pour_afficher_pour_selection_les_studios_disponibles->bindParam(":id_de_la_surface", $incrementeur_des_surfaces);

                                                                        //
                                                                        $requete_preparee_pour_afficher_pour_selection_les_studios_disponibles->execute();

                                                                        //
                                                                        $resultat_de_la_requete = $requete_preparee_pour_afficher_pour_selection_les_studios_disponibles->fetchAll(PDO::FETCH_BOTH);

                                                                        //
                                                                        $nombre_de_resultats_dans_la_requete = $requete_preparee_pour_afficher_pour_selection_les_studios_disponibles->rowCount();

                                                                        //
                                                                        for ($i = 0; $i < $nombre_de_resultats_dans_la_requete; $i++) {

                                                                            //
                                                                            $corps_de_la_page_html .= "<option value='".$resultat_de_la_requete[$i][0]."'>".$resultat_de_la_requete[$i][0]."</option>";

                                                                        }

                                                                        //
                                                                        $corps_de_la_page_html .= "</optgroup>";

                                                                    }

                $corps_de_la_page_html .= "</select>.</p>
                                                                <p>Et il sera accueilli sous le type de public
                                                                    <select class='text-warning ui-corner-all' name='type_de_public_choisi' id='type_de_public_choisi' required>
                                                                        <option value='1'>SOCIAL (337.00€)</option>
                                                                        <option value='2'>MLJ (378.00€)</option>
                                                                        <option value='3'>ETUDIANTS (395.00€ si plus de 3 mois, 449.00€ si moins de 3 mois)</option>
                                                                        <option value='4'>AUTRES (395.00€ si plus de 3 mois, 449.00€ si moins de 3 mois)</option>    
                                                                    </select>.
                                                                </p>
                                                                <p>Son contrat de location débuttera le <input type='text' name='date_de_debut_du_contrat_de_location' class='text-warning calendrier_pour_faire_un_choix_de_date ui-corner-all' required> et se terminera le <input type='text' name='date_de_fin_du_contrat_de_location' class='text-warning calendrier_pour_faire_un_choix_de_date ui-corner-all' required>.</p>
                                                                 <p>Le contrat de location choisi sera un 
                                                                    <select class='text-warning ui-corner-all' name='type_de_contrat_choisi' id='type_de_contrat_choisi' required>
                                                                        <option value='1'>contrat 0 - 3 mois</option>
                                                                        <option value='2'>contrat à l'année</option>
                                                                    </select>.
                                                                </p>
                                                                <p>Celui-ci comporte les conditions suivantes:
                                                                <select class='text-warning ui-corner-all' name='ensemble_des_conditions_du_contrat_de_location' id='ensemble_des_conditions_du_contrat_de_location' required>
                                                                    <option value='1'>Avec EDF inclus (+eau, internet, assurance locative, charges immeuble) TOM en sus (+5.00€)</option>
                                                                    <option value='2'>Sans EDF inclus (+eau, internet, assurance locative, charges immeuble) TOM en sus (+5.00€)</option>
                                                                </select>.</p>
                                                                <p>Le montant de la location se chiffre à <input type='number' name='montant_de_la_location' class='text-warning ui-corner-all' step='0.001' min='0' required> euros toutes charges comprises.</p>
                                                                <p>Le montant du dépot de garantie se chiffre à <input type='number' name='montant_du_depot_de_garanti' class='text-warning ui-corner-all' step='0.001' min='0' required> euros. Sera-t'il encaissé ?
                                                                    <select class='text-warning ui-corner-all' name='choix_d_encaissement_du_depot_de_garanti'>
                                                                        <option value='1'>Oui</option>
                                                                        <option value='2'>Non</option>
                                                                    </select>.
                                                                </p>
                                                                <p>Si vous êtes d'accord, <input type='submit' class='text-warning ui-button ui-corner-all ui-widget' name='soumission_du_formulaire_de_generation_de_PDF' value='cliquez ici'></p>
                                                                <p>Bonne journée,</p>
                                                                <p>Suiviloc</p>
                                                            </form>
                                                        </p>
                                                    </div>
                                                    <h3>Lire les contrats de location</h3>
                                                    <div>
                                                        <p>ddddd</p>
                                                    </div>
                                                    <h3>Envoyer des contrats de location</h3>
                                                    <div>
                                                        <p>45545</p>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div id='attestation'>
                                                <div class='menu_en_accordeon'>
                                                    <h3>Consulter les attestations</h3>
                                                    <div>
                                                        <p>ddd</p>
                                                    </div>
                                                    <h3>Generer des attestations</h3>
                                                    <div>
                                                        <p>44554</p>
                                                    </div>
                                                    <h3>Lire les attestations</h3>
                                                    <div>
                                                        <p>ddddd</p>
                                                    </div>
                                                    <h3>Envoyer des attestations</h3>
                                                    <div>
                                                        <p>45545</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id='relance_impayee'>
                                                <div class='menu_en_accordeon'>
                                                    <h3>Consulter les relances impayées</h3>
                                                    <div>
                                                        <p>ddd</p>
                                                    </div>
                                                    <h3>Generer des relances impayées</h3>
                                                    <div>
                                                        <p>44554</p>
                                                    </div>
                                                    <h3>Lire les relances impayées</h3>
                                                    <div>
                                                        <p>ddddd</p>
                                                    </div>
                                                    <h3>Envoyer des relances impayées</h3>
                                                    <div>
                                                        <p>45545</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id='expiration_de_contrat_de_location'>
                                                
                                            </div>
                                            <div id='accuses_de_reception'>
                                                <div class='menu_en_accordeon'>
                                                    <h3>Consulter les accusés de récéption</h3>
                                                    <div>
                                                        <p>ddd</p>
                                                    </div>
                                                    <h3>Generer des accusés de récéption</h3>
                                                    <div>
                                                        <p>445dsqfqdsfsdfdsqfdsqfsdqf
                                                        sdfdsqfdsqfdsfdsq
                                                        dsqfdsqfdsqfdsqfdsq
                                                        qsfsdqfdsqfdsqfdsq
                                                        qsfddsqfdsqfdsqfdsq
                                                        qfdsqdqsfdqsfsdq54</p>
                                                    </div>
                                                    <h3>Lire les accusés de récéption</h3>
                                                    <div>
                                                        <p>ddddd</p>
                                                    </div>
                                                    <h3>Envoyer des accusés de récéption</h3>
                                                    <div>
                                                        <p>45545</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class='pied_de_div_des_informations_de_connexion'>
                                                Connecté en tant que " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . " (" . $_SESSION['username'] . ") - connecté depuis le " . date('d/m/Y à H:i:s', $_SESSION['date_et_heure_de_creation_de_la_session']) . " - connecté jusqu'au " . date('d/m/Y à H:i:s', $_SESSION["date_et_heure_d_expiration_de_la_session"]) . " - derniére connexion le ". date('d/m/Y à H:i:s', $date_et_heure_de_derniere_connexion_sous_forme_de_timestamp) . ".
                                            </p>
                                            <div class='pied_de_div_des_fonctionnalites'>
                                                &copy; 2019 residence locative - adresse de la résidence locative
                                            </div>
                                        </div>
                                        <div id='fenetre_de_deconnexion' title='Déconnexion'>
                                            <p>Voulez-vous vous déconnecter de l'application ?</p>
                                        </div>";

            //
            $pied_de_la_page_html = "<footer>
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
            //
            catch(Exception $exception_de_connexion)
            {

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