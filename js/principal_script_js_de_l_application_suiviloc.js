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

    $('#erreur_de_connexion_PDO_dans_le_process_en_cours').dialog({
        close: function (event, ui) {

            //
            $(this).dialog('close');

            //
            document.location.href = 'index.php';
        },
        width: 600,
        modal: true,
        resizable: false
    });

    $('#confirmation_de_generation_de_document_PDF').dialog({
        width: 600,
        modal: true,
        resizable: false,
        buttons: {
            'Retourner à l\'application': function () {
                $(this).dialog('close');
                document.location.href = 'index.php';
            }
        }
    });

    $('#erreur_survenue_dans_la_soumission_des_donnees').dialog({
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

    $('.menu_en_accordeon').accordion({heightStyle: 'fill'});

    //$.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );

    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );

    $('.calendrier_pour_faire_un_choix_de_date').datepicker({
        changeYear: true,
        changeMonth: true
    });

    function choix_du_type_de_contrat_de_location()
    {
        var type_de_public_choisi = $("select#type_de_public_choisi").children("option:selected").val();

        if(type_de_public_choisi == 1 || type_de_public_choisi == 2)
        {
            $('#type_de_contrat_choisi option[value=2]').attr('disabled','disabled');
        }
        else
        {
            $('#type_de_contrat_choisi option[value=2]').removeAttr('disabled');
        }
    }

    function choix_de_l_ensemble_des_conditions_du_contrat_de_location()
    {
        var type_de_contrat_de_location_choisi = $("select#type_de_contrat_choisi").children("option:selected").val();

        if(type_de_contrat_de_location_choisi == 2)
        {
            $('#ensemble_des_conditions_du_contrat_de_location option[value=1]').attr('disabled','disabled');

            $('#ensemble_des_conditions_du_contrat_de_location option[value=2]').attr('disabled','disabled');

            $('#ensemble_des_conditions_du_contrat_de_location option[value=3]').removeAttr('disabled');
        }
        else
        {
            $('#ensemble_des_conditions_du_contrat_de_location option[value=1]').removeAttr('disabled');

            $('#ensemble_des_conditions_du_contrat_de_location option[value=2]').removeAttr('disabled');

            $('#ensemble_des_conditions_du_contrat_de_location option[value=3]').attr('disabled','disabled');
        }
    }

    $("#type_de_public_choisi").change(choix_du_type_de_contrat_de_location);

    $("#type_de_contrat_choisi").change(choix_de_l_ensemble_des_conditions_du_contrat_de_location);

    choix_du_type_de_contrat_de_location();

    choix_de_l_ensemble_des_conditions_du_contrat_de_location();

    $('.tableau_de_gestion').DataTable( {
        "searching": false,
        "scrollY":        200,
        "scrollCollapse": true,
        "jQueryUI":       true,
        "language": {
            "sProcessing": "Traitement en cours ...",
            "sLengthMenu": "Afficher _MENU_ lignes",
            "sZeroRecords": "Aucun résultat trouvé",
            "sEmptyTable": "Aucune donnée disponible",
            "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
            "sInfoEmpty": "Aucune ligne affichée",
            "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
            "sInfoPostFix": "",
            "sSearch": "Chercher:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Chargement...",
            "oPaginate": {
                "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
            }
        }
    });
});