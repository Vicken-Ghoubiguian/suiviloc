$(document).ready(function(){

    $('#tabs_des_fonctionnalites').tabs();

    $('#fenetre_de_deconnexion').dialog({
        width: 400,
        autoOpen: false,
        modal: true,
        resizable: false,
        buttons:{
            'Oui': function(){
                $(this).dialog('close');
                document.location.href = 'deconnexion.php';
            },
            'Non': function(){
                $(this).dialog('close');
            }
        }
    });

    $('#bouton_de_deconnexion').on('click', function(){
        $('#fenetre_de_deconnexion').dialog('open');
    });

    $('#message_d_indication_de_deconnexion').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 600,
        modal: true,
        resizable: false,
        buttons:{
            'Se réauthentifier': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
            'Quitter l\'application': function(){
                $(this).dialog('close');
                document.location.href = 'https://www.google.com/';
            }
        }
    });

    $('#formulaire_de_changement_du_mot_de_passe').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },

        width: 600,
        resizable: false,
        modal: true
    });

    $('#formulaire_d_oublis_du_mot_de_passe').dialog({
        width: 600,
        autoOpen: false,
        resizable: false,
        modal: true
    });

    $('#bouton_d_oublis_de_mot_de_passe').on('click', function(e){
        e.preventDefault();
        $('#formulaire_d_oublis_du_mot_de_passe').dialog('open');
    });

    $( '#dialog_d_indication_de_connexion_refusee_pour_cause_de_mauvais_mot_de_passe').dialog({
        width: 600,
        resizable: false,
        modal: true
    });

    $( '#dialog_d_indication_de_connexion_refusee_pour_cause_d_uttilisateur_deja_connecte').dialog({
        width: 600,
        resizable: false,
        modal: true
    });

    $('#confirmation_de_l_envoi_de_lien_de_reconfiguration_via_mail').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 600,
        modal: true,
        resizable: false,
        buttons:{
            'Retourner à la page d\'accueil': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
            'Quitter l\'application': function(){
                $(this).dialog('close');
                document.location.href = 'https://www.google.com/';
            }
        }
    });

    $( '#dialog_d_indication_d_une_erreur_de_connexion').dialog({
        width: 600,
        resizable: false,
        modal: true
    });

    $('#erreur_dans_l_authentification').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 600,
        modal: true,
        resizable: false,
        buttons:{
            'Retourner à la page d\'accueil': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
            'Quitter l\'application': function(){
                $(this).dialog('close');
                document.location.href = 'https://www.google.com/';
            }
        }
    });

    $('#peremption_du_lien_de_reconfiguration').dialog({
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
            'Retourner à la page d\'accueil': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
            'Quitter l\'application': function(){
                $(this).dialog('close');
                document.location.href = 'https://www.google.com/';
            }
        }
    });

    $('#information_de_changement_de_mot_de_passe').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 600,
        modal: true,
        resizable: false,
        buttons:{
            'Retourner à la page d\'accueil': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
        }
    });

    $('#message_d_indication_d_expiration_de_la_session').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 400,
        modal: true,
        resizable: false,
        buttons:{
            'Se réauthentifier': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
            'Quitter l\'application': function(){
                $(this).dialog('close');
                document.location.href = 'https://www.google.com/';
            }
        }
    });

    $('#erreur_lors_de_l_envoi_de_lien_de_reconfiguration_via_mail').dialog({
        close: function(event, ui){

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 600,
        modal: true,
        resizable: false,
        buttons:{
            'Retourner à la page d\'accueil': function(){
                $(this).dialog('close');
                document.location.href = 'index.php';
            },
            'Quitter l\'application': function(){
                $(this).dialog('close');
                document.location.href = 'https://www.google.com/';
            }
        }
    });
});