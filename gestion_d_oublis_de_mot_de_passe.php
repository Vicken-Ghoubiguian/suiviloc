<?php

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //
    require_once("PHPMailer/src/PHPMailer.php");

    //
    require_once("PHPMailer/src/SMTP.php");

    //
    require_once("PHPMailer/src/Exception.php");

    //
    require_once("smarty/libs/Smarty.class.php");

    //
    if(isset($_POST['soumission_du_formulaire_d_oublis_de_mot_de_passe']))
    {

        //
        try {

            //
            $requete_de_recuperation_de_l_username_et_de_l_adresse_mail = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT username, adresse_mail FROM Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE username = :nom_d_uttilisateur AND adresse_mail = :adresse_mail");

            //
            $identifiant_renseignee = htmlspecialchars($_POST["champ_texte_pour_identifiant_en_cas_d_oublis_de_mot_de_passe"]);

            //
            $requete_de_recuperation_de_l_username_et_de_l_adresse_mail->bindParam(":nom_d_uttilisateur", $identifiant_renseignee);

            //
            $adresse_mail_renseignee = htmlspecialchars($_POST["adresse_mail_en_cas_d_oublis_de_mot_de_passe"]);

            //
            $requete_de_recuperation_de_l_username_et_de_l_adresse_mail->bindParam("adresse_mail", $adresse_mail_renseignee);

            //
            $requete_de_recuperation_de_l_username_et_de_l_adresse_mail->execute();

            //
            $nombre_total_du_resultat_de_la_requete = $requete_de_recuperation_de_l_username_et_de_l_adresse_mail->rowCount();

            //
            if ($nombre_total_du_resultat_de_la_requete == 1) {

                //
                $code_genere_pour_la_recuperation_du_mot_de_passe = "";

                //
                for ($incrementeur = 0; $incrementeur < 10; $incrementeur++) {
                    //
                    $code_genere_pour_la_recuperation_du_mot_de_passe .= mt_rand(0, 9);
                }

                //
                $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE username = :nom_d_uttilisateur AND adresse_mail = :adresse_mail");

                //
                $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->bindParam(":nom_d_uttilisateur", $identifiant_renseignee);

                //
                $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->bindParam(":adresse_mail", $adresse_mail_renseignee);

                //
                $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->execute();

                //
                $resultat_de_la_requete_de_recuperation_de_l_id_de_l_utilisateur_demandant_a_recuperer_son_mot_de_passe = $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->fetch(PDO::FETCH_ASSOC);

                //
                $id_de_l_utilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($resultat_de_la_requete_de_recuperation_de_l_id_de_l_utilisateur_demandant_a_recuperer_son_mot_de_passe["id"]);

                //
                $temps_limite_de_validite_du_code_de_recuperation_du_mot_de_passe_sous_forme_de_timestamp = time() + 3600;

                //
                $date_et_heure_limite_de_validite_du_code_de_recuperation_du_mot_de_passe = date("Y-m-d H:i:iP", $temps_limite_de_validite_du_code_de_recuperation_du_mot_de_passe_sous_forme_de_timestamp);

                //
                $requete_de_mise_a_jour_de_la_ligne_correspondant_a_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Recuperation_du_mot_de_passe SET code_de_recuperation_du_mot_de_passe = :code_de_recuperation_du_mot_de_passe, temps_limite_pour_la_validite_du_code_de_recuperation = :temps_limite_pour_la_validite_du_code_de_recuperation WHERE utilisateur = :id_de_l_uttilisateur_voulant_recuperer_son_mot_de_passe");

                //
                $requete_de_mise_a_jour_de_la_ligne_correspondant_a_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->bindParam(":code_de_recuperation_du_mot_de_passe", $code_genere_pour_la_recuperation_du_mot_de_passe);

                //
                $requete_de_mise_a_jour_de_la_ligne_correspondant_a_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->bindParam(":id_de_l_uttilisateur_voulant_recuperer_son_mot_de_passe", $id_de_l_utilisateur_demandant_a_recuperer_son_mot_de_passe);

                //
                $requete_de_mise_a_jour_de_la_ligne_correspondant_a_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->bindParam(":temps_limite_pour_la_validite_du_code_de_recuperation", $date_et_heure_limite_de_validite_du_code_de_recuperation_du_mot_de_passe);

                //
                $requete_de_mise_a_jour_de_la_ligne_correspondant_a_l_uttilisateur_demandant_de_recuperer_son_mot_de_passe->execute();

                //
                $requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom, prenom, username, adresse_mail FROM Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE id = :id_de_l_uttilisateur_voulant_recuperer_son_mot_de_passe");

                //
                $requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->bindParam(":id_de_l_uttilisateur_voulant_recuperer_son_mot_de_passe", $id_de_l_utilisateur_demandant_a_recuperer_son_mot_de_passe);

                //
                $requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->execute();

                //
                $resultat_de_la_requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->fetch(PDO::FETCH_ASSOC);

                //
                $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($resultat_de_la_requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe["nom"]);

                //
                $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($resultat_de_la_requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe["prenom"]);

                //
                $adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($resultat_de_la_requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe["adresse_mail"]);

                //
                $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($resultat_de_la_requete_de_recuperation_du_nom_du_prenom_et_de_l_adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe["username"]);

                //
                $titre_du_mail_de_recuperation_de_mot_de_passe = "Pour " . $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . " " . $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . " (" . $identifiant_renseignee . "): mail de récupération de mot de passe";

                //
                $mail_de_recuperation_de_mot_de_passe = new \PHPMailer\PHPMailer\PHPMailer(true);

                //
                $mail_de_recuperation_de_mot_de_passe->isSMTP();

                //
                $mail_de_recuperation_de_mot_de_passe->Host = "hote_de_l_adresse_mail_uttilisee_par_l_application";

                //
                $mail_de_recuperation_de_mot_de_passe->SMTPSecure = "tls";

                //
                $mail_de_recuperation_de_mot_de_passe->Port = 587;

                //
                $mail_de_recuperation_de_mot_de_passe->SMTPAuth = true;

                //
                $mail_de_recuperation_de_mot_de_passe->CharSet = "UTF-8";

                //
                $mail_de_recuperation_de_mot_de_passe->Username = "nom_de_l_application_nom_de_la_residence_locative@nom_de_domaine.com";

                //
                $mail_de_recuperation_de_mot_de_passe->Password = "mot_de_passe_du_compte_de_l_application";

                //
                $mail_de_recuperation_de_mot_de_passe->setFrom("nom_de_l_application_nom_de_la_residence_locative@nom_de_domaine.com", "nom_de_l_application");

                //
                $mail_de_recuperation_de_mot_de_passe->addAddress($adresse_mail_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                //
                $mail_de_recuperation_de_mot_de_passe->isHTML(true);

                //
                $mail_de_recuperation_de_mot_de_passe->Subject = $titre_du_mail_de_recuperation_de_mot_de_passe;

                //
                $lien_de_reconfiguration_et_de_recuperation_du_mot_de_passe = "http://localhost/suiviloc/recuperation_du_mot_de_passe.php?nom=" . $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "&prenom=" . $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "&login=" . $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "&code_de_recuperation=" . $code_genere_pour_la_recuperation_du_mot_de_passe . "";

                //
                $mail_de_recuperation_de_mot_de_passe->Body = "
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <title>" . $titre_du_mail_de_recuperation_de_mot_de_passe . "</title>
                    <style>
                        .paragraphe_principal
                        {
                            text-align: left;
                        }
                    </style>
                    </head>
                    <body>
                    <div class='paragraphe_principal'>
                        <p>Bonjour <b>" . $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "</b> <b>" . $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "</b> (<b>" . $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "</b>),</p>
                        <p>Suiviloc a eu connaissance de votre oublis de mot de passe, mais pas de panique.</p>
                        <p>Cliquez <a href='" . $lien_de_reconfiguration_et_de_recuperation_du_mot_de_passe . "'>ici</a> pour reconfigurer votre mot de passe.</p>
                        <p>Attention: Ce lien URL sera définitivement désactivé dans une heure.</p>
                        <p>De plus ceci est un mail automatique, merci de ne pas répondre.</p>
                    </div>
                    <p>Bien à vous,</p>
                    <p>Suiviloc</p>
                    <p><img src='./images/logo_residence_locative.png' alt='Nom de la résidence locative'></p>
                    </body>
                    </html>";

                //
                $mail_de_recuperation_de_mot_de_passe->AltBody = "
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <title>" . $titre_du_mail_de_recuperation_de_mot_de_passe . "</title>
                    <style>
                        .paragraphe_principal
                        {
                            text-align: left;
                        }
                    </style>
                    </head>
                    <body>
                    <div class='paragraphe_principal'>
                        <p>Bonjour <b>" . $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "</b> <b>" . $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "</b> (<b>" . $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "</b>),</p>
                        <p>Suiviloc a eu connaissance de votre oublis de mot de passe, mais pas de panique.</p>
                        <p>Cliquez <a href='" . $lien_de_reconfiguration_et_de_recuperation_du_mot_de_passe . "'>ici</a> pour reconfigurer votre mot de passe.</p>
                        <p>Attention: Ce lien URL sera définitivement désactivé dans une heure.</p>
                        <p>De plus ceci est un mail automatique, merci de ne pas répondre.</p>
                    </div>
                    <p>Bien à vous,</p>
                    <p>Suiviloc</p>
                    <p><img src='./images/logo_residence_locative.png' alt='Nom de la résidence locative'></p>
                    </body>
                    </html>";

                //
                try {
                    //
                    $mail_de_recuperation_de_mot_de_passe->send();

                    //
                    require("vues/page_d_affichage_de_la_confirmation_de_l_envois_du_lien_de_reconfiguration_du_mot_de_passe_par_mail.html");
                } //Sinon...
                catch (\PHPMailer\PHPMailer\Exception $exception_generee_lors_de_l_envoi_du_mail) {

                    //
                    $smarty = new Smarty();

                    //
                    $smarty->assign(array("exception_generee_lors_de_l_envoi_du_mail" => $exception_generee_lors_de_l_envoi_du_mail->getMessage()));

                    //
                    $smarty->display("vues/page_d_erreur_survenue_lors_de_la_levee_d_une_exception_lors_de_l_envois_du_mail_de_reconfiguration.html");
                }

            } //Sinon...
            else {

                //
                $smarty = new Smarty();

                //
                $smarty->assign(array(
                    "identifiant_renseignee" => $identifiant_renseignee,
                    "adresse_mail_renseignee" => $adresse_mail_renseignee
                ));

                //
                $smarty->display("vues/page_d_erreur_causee_par_un_login_et_ou_une_adresse_mail_introuvables.html");
            }

        }
        //
        catch (Exception $exception_de_connexion)
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
        header("Location: index.php");
    }