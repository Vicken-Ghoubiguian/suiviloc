<?php


class Etat_des_lieux
{

    //
    private $date_du_jour;

    //
    private $chemin_du_fichier_genere;

    //
    private $id_du_contrat_de_location;

    //
    public function __construct($date_du_jour, $chemin_du_fichier_genere, $id_du_contrat_de_location)
    {

        //
        $this->date_du_jour = $date_du_jour;

        //
        $this->chemin_du_fichier_genere = $chemin_du_fichier_genere;

        //
        $this->id_du_contrat_de_location = $id_du_contrat_de_location;

    }

    //
    public function getDate_du_jour()
    {

        //
        return $this->date_du_jour;
    }

    //
    public function getChemin_du_fichier_genere()
    {

        //
        return $this->chemin_du_fichier_genere;

    }

    //
    public function getIdentifiant_du_contrat_de_location()
    {

        //
        return $this->id_du_contrat_de_location;

    }

    //
    public function setChemin_du_fichier_genere($chemin_du_fichier_genere)
    {

        //
        $this->chemin_du_fichier_genere = $chemin_du_fichier_genere;

    }

    //
    public function setDate_du_jour($date_du_jour)
    {

        //
        $this->date_du_jour = $date_du_jour;

    }

    //
    public function setIdentifiant_du_contrat_de_location($id_du_contrat_de_location)
    {

        //
        $this->id_du_contrat_de_location = $id_du_contrat_de_location;

    }

}