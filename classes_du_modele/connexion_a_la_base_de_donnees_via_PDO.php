<?php

//
class connexion_a_la_base_de_donnees_via_PDO
{

    //
    private static $cnxPDO = null;

    //Ici, toutes les constantes qui vont servir pour la connexion à la base de données sont définies
    const USER = 'residis';
    const HOST = 'localhost';
    const PWD = 'Res*1007';
    const DB_NAME = 'gestion_de_parc_locatif';

    //Définition du constructeur (privée) de la classe connexion_a_la_base_de_donnees_via_PDO
    private function __construct(){

        //
        self::$cnxPDO = new PDO('mysql:host='.self::HOST.';dbname='.self::DB_NAME , self::USER, self::PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

        //
        self::$cnxPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //
    public static function getinstance(){

        //L'attribut de la classe connexion_a_la_base_de_donnees_via_PDO, $cnxPDO, n'existe pas ou est nul, alors...
        if(!isset(self::$cnxPDO)){

            //Celui-ci est instancié par l'appel au constructeur de la classe connexion_a_la_base_de_donnees_via_PDO
            new connexion_a_la_base_de_donnees_via_PDO();

        }

        //
        return self::$cnxPDO;
    }
}