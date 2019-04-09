<?php
/* Smarty version 3.1.34-dev-7, created on 2019-04-09 10:32:38
  from '/opt/lampp/htdocs/suiviloc_github/vues/page_d_authentification_en_cas_d_erreur_PDO.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5cac58a6adba77_84243282',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9368ed251ecb0b186137f20d4eb714aeff5b070' => 
    array (
      0 => '/opt/lampp/htdocs/suiviloc_github/vues/page_d_authentification_en_cas_d_erreur_PDO.html',
      1 => 1554798658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cac58a6adba77_84243282 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Suiviloc</title>
    <link rel='icon' type='image/png' href='images/logo_residence_locative.png' />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <?php echo '<script'; ?>
 src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'><?php echo '</script'; ?>
>
    <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css'>
    <?php echo '<script'; ?>
 src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='js/principal_script_js_de_l_application_suiviloc.js'><?php echo '</script'; ?>
>
    <link rel='stylesheet' href='css/jquery-ui.theme.min.css'>
    <link rel='stylesheet' href='css/jquery-ui.structure.min.css'>
    <link rel='stylesheet' href='css/jquery-ui.min.css'>
    <link href='css/feuille_de_style_principale_de_l_application_suiviloc.css' rel='stylesheet' type='text/css'>
</head>
<body class='corps_de_la_page_d_authentification'>
<div id='dialog_d_indication_d_une_erreur_de_connexion' title='Erreur survenue'>
    Erreur de connexion à la base de données, la voici: <?php echo $_smarty_tpl->tpl_vars['message_d_erreur_de_connexion_a_la_base_de_donnees']->value;?>
.
</div>
<div class='formulaire_d_authentification'>
    <form action='authentification.php' method='post'>
        <fieldset>
            <legend class='text-warning titre_du_formulaire'>Authentifiez-vous</legend>
                <table cellspacing='50'>
                    <tr>
                        <th>
                            <label for='identifiant_pour_authentification' class='text-warning'>
                                identifiant:
                            </label>
                        </th>
                        <th>
                            <input class='text-danger' type='text' id='identifiant_pour_authentification' name='champ_texte_pour_identifiant_pour_authentification' title='Entrez votre identifiant dans ce champ; celui-ci est composé de la première lettre de votre prénom en minuscule suivit de votre nom de famille en minuscule. Par exemple: Elon Musk possède comme identifiant emusk' required>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <label for='mot_de_passe_pour_authentification' class='text-warning'>
                                mot de passe:
                            </label>
                        </th>
                        <th>
                            <input class='marge_de_separation_des_elements text-danger' type='password' id='mot_de_passe_pour_authentification' name='champ_password_pour_mot_de_passe_pour_authentification' title='Entrez votre mot de passe dans ce champ; Vous pourrez modifier celui-ci avec un autre de votre choix, une fois connecté' required>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <div><input class='marge_de_separation_des_elements ui-button ui-corner-all ui-widget' type='submit' name='soumission_du_formulaire_d_authentification' value='Connectez-vous'></div>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <div><button id='bouton_d_oublis_de_mot_de_passe' class='ui-button ui-corner-all ui-widget marge_de_separation_des_elements'>Mot de passe oublié</button></div>
                        </th>
                    </tr>
                </table>
        </fieldset>
    </form>
</div>
<div id='formulaire_d_oublis_du_mot_de_passe' title='mot de passe oublié ?'>
    <form action='gestion_d_oublis_de_mot_de_passe.php' method='post'>
        <p>
            Vous avez oublé votre mot de passe ?
            Pas de problèmes: Remplissez ce formulaire à champs obligatoires.
            Un mail de confirmation avec un lien vous sera envoyé pour que vous le réinitialiser.
        </p>
        <table>
            <tr>
                <th>
                    <label for='identifiant_en_cas_d_oublis_de_mot_de_passe' class='text-warning'>identifiant: </label>
                </th>
                <th>
                    <input class='text-danger' type='text' id='identifiant_en_cas_d_oublis_de_mot_de_passe' name='champ_texte_pour_identifiant_en_cas_d_oublis_de_mot_de_passe' title='Entrez votre identifiant dans ce champs' required>
                </th>
            </tr>
            <tr>
                <th>
                    <label for='adresse_mail_pour_identification_en_cas_d_oublis_de_mot_de_passe' class='text-warning'>adresse mail: </label>
                </th>
                <th>
                    <input class='text-danger' type='email' id='adresse_mail_pour_identification_en_cas_d_oublis_de_mot_de_passe' name='adresse_mail_en_cas_d_oublis_de_mot_de_passe' title='Entrez votre adresse mail pour identification' required>
                </th>
            </tr>
            <tr>
                <th>
                    <div><input class='ui-button ui-corner-all ui-widget' type='submit' name='soumission_du_formulaire_d_oublis_de_mot_de_passe' value='Soumettre'></div>
                </th>
            </tr>
        </table>
    </form>
</div>
</body>
</html><?php }
}
