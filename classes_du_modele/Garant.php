<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/03/19
 * Time: 11:37
 */

class Garant
{

    //
    private $nom_du_garant;

    //
    private $prenom_du_garant;

    //
    private $date_de_naissance;

    //
    private $adresse_d_habitation;

    //
    public function __construct($nom_du_garant, $prenom_du_garant, $date_de_naissance, $adresse_d_habitation)
    {

        //
        $this->nom_du_garant = $nom_du_garant;

        //
        $this->prenom_du_garant = $prenom_du_garant;

        //
        $this->date_de_naissance = $date_de_naissance;

        //
        $this->adresse_d_habitation = $adresse_d_habitation;
    }

    //
    public function setNom_du_garant($nouveau_nom_du_garant)
    {
        //
        $this->nom_du_garant = $nouveau_nom_du_garant;
    }

    //
    public function setPrenom_du_garant($nouveau_prenom_du_garant)
    {
        //
        $this->prenom_du_garant = $nouveau_prenom_du_garant;
    }

    //
    public function setAdresse_d_habitation($nouvelle_adresse_d_habitation)
    {
        //
        $this->adresse_d_habitation = $nouvelle_adresse_d_habitation;
    }

    //
    public function setDate_de_naissance($nouvelle_date_de_naissance)
    {
        //
        $this->date_de_naissance = $nouvelle_date_de_naissance;
    }

    //
    public function getNom_du_garant()
    {
        //
        return $this->nom_du_garant;
    }

    //
    public function getPrenom_du_garant()
    {
        //
        return $this->prenom_du_garant;
    }

    //
    public function getAdresse_d_habitation()
    {
        //
        return $this->adresse_d_habitation;
    }

    //
    public function getDate_de_naissance()
    {
        //
        return $this->date_de_naissance;
    }

}