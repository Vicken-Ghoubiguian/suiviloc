<?php

    //
    require_once("classes_du_modele/connexion_a_la_base_de_donnees_via_PDO.php");

    //
    require_once("smarty/libs/Smarty.class.php");

    //
    session_start();

    //Dans le cas où une session est ouverte...
    if(isset($_SESSION) && !empty($_SESSION))
    {
        //
        header("Location: index.php");
        exit;
    }
    //Sinon...
    else {

        //
        if (isset($_POST["soumission_du_formulaire_de_changement_de_mot_de_passe"]))
        {

            //
            $valeur_du_champs_de_la_premiere_saisie_du_nouveau_mot_de_passe = htmlspecialchars($_POST["mot_de_passe_premiere_saisie"]);

            //
            $valeur_du_champs_de_la_seconde_saisie_du_nouveau_mot_de_passe = htmlspecialchars($_POST["mot_de_passe_seconde_saisie"]);

            //
            $identifiant_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe = $_POST["identifiant_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe"];

            //Si les valeurs des deux champs de saisie du nouveau mot de passe sont identiques, alors...
            if($valeur_du_champs_de_la_premiere_saisie_du_nouveau_mot_de_passe == $valeur_du_champs_de_la_seconde_saisie_du_nouveau_mot_de_passe)
            {

                //
                try {

                    //
                    $requete_de_reconfiguration_du_mot_de_passe_de_l_uttilisateur = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif SET password = :nouveau_mot_de_passe WHERE id = :id_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe");

                    //
                    $valeur_du_mot_de_passe_prete_a_etre_mise_a_jour = sha1($valeur_du_champs_de_la_premiere_saisie_du_nouveau_mot_de_passe);

                    //
                    $requete_de_reconfiguration_du_mot_de_passe_de_l_uttilisateur->bindParam(':nouveau_mot_de_passe', $valeur_du_mot_de_passe_prete_a_etre_mise_a_jour);

                    //
                    $requete_de_reconfiguration_du_mot_de_passe_de_l_uttilisateur->bindParam(':id_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe', $identifiant_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe);

                    //
                    $requete_de_reconfiguration_du_mot_de_passe_de_l_uttilisateur->execute();

                    //
                    $requete_de_remise_a_plat_du_code_de_recuperation_du_mot_de_passe_et_de_sa_validite_pour_l_uttilisateur = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("UPDATE Recuperation_du_mot_de_passe SET code_de_recuperation_du_mot_de_passe = NULL AND temps_limite_pour_la_validite_du_code_de_recuperation = NULL WHERE id = :id_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe");

                    //
                    $requete_de_remise_a_plat_du_code_de_recuperation_du_mot_de_passe_et_de_sa_validite_pour_l_uttilisateur->bindParam(':id_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe', $identifiant_de_l_uttilisateur_demandant_a_reconfigurer_son_mot_de_passe);

                    //
                    $requete_de_remise_a_plat_du_code_de_recuperation_du_mot_de_passe_et_de_sa_validite_pour_l_uttilisateur->execute();

                    //
                    require("vues/page_de_confirmation_de_reussite_du_changement_de_mot_de_passe.html");

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
            //Sinon...
            else
            {

                //
                $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $_POST['nom_de_l_uttilisateur'];

                //
                $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $_POST['prenom_de_l_uttilisateur'];

                //
                $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $_POST['login_de_l_uttilisateur'];

                //
                $code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $_POST['code_de_recuperation_de_l_uttilisateur'];

                //
                unset($_POST);

                //
                $lien_de_reconfiguration_et_de_recuperation_du_mot_de_passe = "http://localhost/suiviloc/recuperation_du_mot_de_passe.php?nom=".$nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe."&prenom=".$prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe."&login=".$username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe."&code_de_recuperation=".$code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe."";

                //
                $en_tete_de_la_page_html = "<!DOCTYPE html>
                                        <html lang='en'>
                                            <head>
                                                <meta charset='UTF-8'>
                                                <title>Suiviloc</title>
                                                <link rel='icon' type='image/png' href='images/logo_residence_locative.png' />
                                                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                                                <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css'>
                                                <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
                                                <link rel='stylesheet' href='css/jquery-ui.theme.min.css'>
                                                <link rel='stylesheet' href='css/jquery-ui.structure.min.css'>
                                                <link rel='stylesheet' href='css/jquery-ui.min.css'>
                                                <link href='css/feuille_de_style_principale_de_l_application_suiviloc.css' rel='stylesheet' type='text/css'>
                                                <script>
                                                    $( function() {
                                                        $('#information_de_refus_de_changement_de_mot_de_passe').dialog({
                                                            close: function(event, ui){
                                                            
                                                                //
                                                                $(this).dialog('close');
                                                                
                                                                //
                                                                document.location.href = 'https://www.google.com/';
                                                            },
                                                            width: 600,
                                                            modal: true,
                                                            resizable: false,
                                                            buttons:{
                                                                'Retenter une nouvelle saisie': function(){
                                                                    $(this).dialog('close');
                                                                    document.location.href = '".$lien_de_reconfiguration_et_de_recuperation_du_mot_de_passe."';
                                                                },
                                                                'Quitter l\'application': function(){
                                                                    $(this).dialog('close');
                                                                    document.location.href = 'https://www.google.com/';
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </head>";

                //
                $corps_de_la_page_html = "<body class='corps_de_la_page_d_authentification'>
                                                <div id='information_de_refus_de_changement_de_mot_de_passe' title='Changement de mot de passe refusé'>
                                                    <p>Le changement de mot de passe vous a été refusé</p>
                                                    <p>La raison est que la premiére saisie du mot de passe est différente de la seconde.</p>
                                                    <p>Si vous voulez toujours reconfigurer votre mot de passe, cliquez sur 'Retenter une nouvelle saisie'</p>
                                                    <p>Sinon, cliquez sur 'Quitter l'application'</p>
                                                </div>";

                //
                $pied_de_la_page_html = "</body></html>";

                //
                echo $en_tete_de_la_page_html . $corps_de_la_page_html . $pied_de_la_page_html;

            }
        }
        else{

            //
            if (isset($_GET) && !empty($_GET)) {

                //
                $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($_GET["nom"]);

                //
                $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($_GET["prenom"]);

                //
                $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($_GET["login"]);

                //
                $code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = htmlspecialchars($_GET["code_de_recuperation"]);

                //
                try {

                    //
                    $requete_de_verification_de_l_existence_de_l_uttilisateur_dans_la_base_de_donnees = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT nom, prenom, username FROM Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE nom = :nom AND prenom = :prenom AND username = :username");

                    //
                    $requete_de_verification_de_l_existence_de_l_uttilisateur_dans_la_base_de_donnees->bindParam(":nom", $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                    //
                    $requete_de_verification_de_l_existence_de_l_uttilisateur_dans_la_base_de_donnees->bindParam(":prenom", $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                    //
                    $requete_de_verification_de_l_existence_de_l_uttilisateur_dans_la_base_de_donnees->bindParam(":username", $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                    //
                    $requete_de_verification_de_l_existence_de_l_uttilisateur_dans_la_base_de_donnees->execute();

                    //
                    $nombre_total_du_resultat_de_la_requete = $requete_de_verification_de_l_existence_de_l_uttilisateur_dans_la_base_de_donnees->rowCount();

                    //
                    if ($nombre_total_du_resultat_de_la_requete == 1) {

                        //
                        $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT id FROM Table_de_connexion_a_la_base_de_gestion_de_parc_locatif WHERE nom = :nom AND prenom = :prenom AND username = :username");

                        //
                        $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->bindParam(":nom", $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                        //
                        $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->bindParam(":prenom", $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                        //
                        $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->bindParam(":username", $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                        //
                        $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->execute();

                        //
                        $recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $requete_de_recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe->fetch(PDO::FETCH_ASSOC);

                        //
                        $id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe = $recuperation_de_l_id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe["id"];

                        //
                        $requete_de_verification_du_code_de_recuperation_du_mot_de_passe = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT Recuperation_du_mot_de_passe.code_de_recuperation_du_mot_de_passe FROM Recuperation_du_mot_de_passe INNER JOIN Table_de_connexion_a_la_base_de_gestion_de_parc_locatif ON Recuperation_du_mot_de_passe.utilisateur = Table_de_connexion_a_la_base_de_gestion_de_parc_locatif.id WHERE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif.id = :id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe");

                        //
                        $requete_de_verification_du_code_de_recuperation_du_mot_de_passe->bindParam(":id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe", $id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                        //
                        $requete_de_verification_du_code_de_recuperation_du_mot_de_passe->execute();

                        //
                        $resultat_de_la_requete_de_verification_du_code_de_recuperation_du_mot_de_passe = $requete_de_verification_du_code_de_recuperation_du_mot_de_passe->fetch(PDO::FETCH_ASSOC);

                        //
                        $code_de_recuperation_du_mot_de_passe_depuis_la_table_Recuperation_du_mot_de_passe = $resultat_de_la_requete_de_verification_du_code_de_recuperation_du_mot_de_passe["code_de_recuperation_du_mot_de_passe"];

                        //
                        if ($code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe != $code_de_recuperation_du_mot_de_passe_depuis_la_table_Recuperation_du_mot_de_passe) {

                            //
                            header("Location: https://www.google.fr");
                            exit;

                        } else {

                            //
                            $requete_de_recuperation_du_temps_limite_pour_la_validite_du_code_de_recuperation = connexion_a_la_base_de_donnees_via_PDO::getinstance()->prepare("SELECT temps_limite_pour_la_validite_du_code_de_recuperation FROM Recuperation_du_mot_de_passe WHERE code_de_recuperation_du_mot_de_passe = :code_de_recuperation_du_mot_de_passe");

                            //
                            $requete_de_recuperation_du_temps_limite_pour_la_validite_du_code_de_recuperation->bindParam(":code_de_recuperation_du_mot_de_passe", $code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe);

                            //
                            $requete_de_recuperation_du_temps_limite_pour_la_validite_du_code_de_recuperation->execute();

                            //
                            $resultat_de_la_requete_de_recuperation_du_temps_limite_pour_la_validite_du_code_de_recuperation = $requete_de_recuperation_du_temps_limite_pour_la_validite_du_code_de_recuperation->fetch(PDO::FETCH_ASSOC);

                            //
                            $temps_limite_pour_la_validite_du_code_de_recuperation = $resultat_de_la_requete_de_recuperation_du_temps_limite_pour_la_validite_du_code_de_recuperation["temps_limite_pour_la_validite_du_code_de_recuperation"];

                            //
                            $date_et_heure_d_expiration_du_code_de_recuperation = new DateTime($temps_limite_pour_la_validite_du_code_de_recuperation);

                            //
                            $date_et_heure_d_expiration_du_code_de_recuperation_sous_forme_de_timestamp = $date_et_heure_d_expiration_du_code_de_recuperation->getTimestamp();

                            //
                            $date_et_heure_actuelles_sous_forme_de_timestamp = time();

                            //
                            if ($date_et_heure_d_expiration_du_code_de_recuperation_sous_forme_de_timestamp > $date_et_heure_actuelles_sous_forme_de_timestamp) {

                                //
                                require('vues/en_tete_du_code_HTML_de_l_application_suiviloc.html');

                                //
                                $corps_de_la_page_html = "<body class='corps_de_la_page_d_authentification'><div id='formulaire_de_changement_du_mot_de_passe' title='mot de passe oublié ?'>
                                                    <form action='recuperation_du_mot_de_passe.php' method='post'>
                                                        <input type='hidden' name='identifiant_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe' id='identifiant_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe' value='" . $id_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "'>
                                                        <input type='hidden' name='nom_de_l_uttilisateur' id='nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe' value='" . $nom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "'>
                                                        <input type='hidden' name='prenom_de_l_uttilisateur' id='prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe' value='" . $prenom_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "'>
                                                        <input type='hidden' name='login_de_l_uttilisateur' id='login_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe' value='" . $username_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "'>
                                                        <input type='hidden' name='code_de_recuperation_de_l_uttilisateur' id='code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe' value='" . $code_de_recuperation_de_l_uttilisateur_demandant_a_recuperer_son_mot_de_passe . "'>
                                                        <p>
                                                            Vous avez oublé votre mot de passe ?
                                                            Pas de problèmes: Changez-le.
                                                        </p>
                                                        <table>
                                                            <tr>
                                                                <p>
                                                                    <th>
                                                                        <label for='premiere_saisie_du_mot_de_passe' class='text-warning'>Premiére saisie du mot de passe: </label>    
                                                                    </th>
                                                                    <th>
                                                                        <input class='text-danger' type='password' id='premiere_saisie_du_mot_de_passe' name='mot_de_passe_premiere_saisie' title='Saisissez une première fois votre nouveau mot de passe dans ce champs' required>
                                                                    </th>
                                                                </p>
                                                            </tr>
                                                            <tr>
                                                                <p>
                                                                    <th>
                                                                        <label for='seconde_saisie_du_mot_de_passe' class='text-warning'>Seconde saisie du mot de passe: </label>
                                                                    </th>
                                                                    <th>
                                                                        <input class='text-danger' type='password' id='seconde_saisie_du_mot_de_passe' name='mot_de_passe_seconde_saisie' title='Saisissez une seconde fois votre nouveau mot de passe dans ce champs' required>
                                                                    </th>
                                                                </p>
                                                            </tr>
                                                            <tr>
                                                                <p>
                                                                    <th>
                                                                        <div><input class='ui-button ui-corner-all ui-widget' type='submit' name='soumission_du_formulaire_de_changement_de_mot_de_passe' value='Soumettre'></div>
                                                                    </th>
                                                                </p>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </div>";

                                //
                                $pied_de_la_page_html = "</body></html>";

                                //
                                echo $corps_de_la_page_html . $pied_de_la_page_html;

                            } //Sinon...
                            else {

                                //
                                require("vues/page_de_confirmation_de_la_peremption_du_lien_de_reconfiguration_du_mot_de_passe.html");
                            }
                        }
                    } //Sinon...
                    else {

                        //
                        header("Location: https://www.google.fr");
                        exit;
                    }
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

            } else {

                //
                header("Location: index.php");
                exit;
            }
        }
    }
