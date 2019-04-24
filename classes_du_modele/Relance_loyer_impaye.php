<?php


class Relance_loyer_impaye
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
    private $montant_du;

    //
    private $id_du_contrat;

    //
    private $chemin_du_fichier_genere;

    //
    public function __construct($nom_de_famille_du_locataire, $prenom_du_locataire, $identifiant_du_studio, $date_du_jour, $montant_du, $chemin_du_fichier_genere, $id_du_contrat)
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
        $this->montant_du = $montant_du;

        //
        $this->id_du_contrat = $id_du_contrat;

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
    public function getMontant_du()
    {
        //
        return $this->montant_du;
    }

    //
    public function getId_du_contrat()
    {
        //
        return $this->id_du_contrat;
    }

    //
    public function getChemin_du_fichier_genere()
    {
        //
        return $this->chemin_du_fichier_genere;
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
    public function setMontant_du($montant_du)
    {
        //
        $this->montant_du = $montant_du;
    }

    //
    public function setId_du_contrat($id_du_contrat)
    {
        //
        $this->id_du_contrat = $id_du_contrat;
    }

    //
    public function setChemin_du_fichier_genere($chemin_du_fichier_genere)
    {
        //
        $this->chemin_du_fichier_genere = $chemin_du_fichier_genere;
    }
}