<?php


class Expiration_de_contrat_de_location
{

    //
    private $nom_de_famille_du_locataire;

    //
    private $prenom_du_locataire;

    //
    private $identifiant_du_studio;

    //
    private $date_du_jour;

    //
    private $date_de_fin_du_contrat;

    //
    private $identifiant_du_contrat_de_location;

    //
    private $chemin_du_fichier_genere;

    //
    public function __construct($nom_de_famille_du_locataire, $prenom_du_locataire, $identifiant_du_studio, $date_de_fin_du_contrat, $chemin_du_fichier_genere, $date_du_jour, $identifiant_du_contrat_de_location)
    {

        //
        $this->nom_de_famille_du_locataire = $nom_de_famille_du_locataire;

        //
        $this->prenom_du_locataire = $prenom_du_locataire;

        //
        $this->identifiant_du_studio = $identifiant_du_studio;

        //
        $this->date_du_jour = $date_du_jour;

        //
        $this->date_de_fin_du_contrat = $date_de_fin_du_contrat;

        //
        $this->identifiant_du_contrat_de_location = $identifiant_du_contrat_de_location;

        //
        $this->chemin_du_fichier_genere = $chemin_du_fichier_genere;

    }

    //
    public function getNom_de_famille_du_locataire()
    {

        //
        return $this->nom_de_famille_du_locataire;

    }

    //
    public function getChemin_du_fichier_genere()
    {

        //
        return $this->chemin_du_fichier_genere;

    }

    //
    public function getPrenom_du_locataire()
    {

        //
        return $this->prenom_du_locataire;

    }

    //
    public function getIdentifiant_du_studio()
    {

        //
        return $this->identifiant_du_studio;

    }

    //
    public function getDate_du_jour()
    {

        //
        return $this->date_du_jour;

    }

    //
    public function getDate_de_fin_du_contrat()
    {

        //
        return $this->date_de_fin_du_contrat;

    }

    //
    public function getIdentifiant_du_contrat_de_location()
    {

        //
        return $this->identifiant_du_contrat_de_location;

    }

    //
    public function setNom_de_famille_du_locataire($nom_de_famille_du_locataire)
    {

        //
        $this->nom_de_famille_du_locataire = $nom_de_famille_du_locataire;

    }

    //
    public function setPrenom_du_locataire($prenom_du_locataire)
    {

        //
        $this->prenom_du_locataire = $prenom_du_locataire;

    }

    //
    public function setIdentifiant_du_studio($identifiant_du_studio)
    {

        //
        $this->identifiant_du_studio = $identifiant_du_studio;

    }

    //
    public function setDate_du_jour($date_du_jour)
    {

        //
        $this->date_du_jour = $date_du_jour;

    }

    //
    public function setDate_de_fin_du_contrat($date_de_fin_du_contrat)
    {

        //
        $this->date_de_fin_du_contrat = $date_de_fin_du_contrat;

    }

    //
    public function setIdentifiant_du_contrat_de_location($identifiant_du_contrat_de_location)
    {

        //
        $this->identifiant_du_contrat_de_location = $identifiant_du_contrat_de_location;

    }

    //
    public function setChemin_du_fichier_genere($chemin_du_fichier_genere)
    {

        //
        $this->chemin_du_fichier_genere = $chemin_du_fichier_genere;

    }
}