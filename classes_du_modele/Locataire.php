<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/03/19
 * Time: 11:30
 */

//
class Locataire
{

    //
    private $nom_du_locataire;

    //
    private $prenom_du_locataire;

    //
    private $date_d_arriver;

    //
    private $adresse_mail;

    //
    private $date_de_naissance;

    //
    private $adresse_d_habitation;

    //
    private $type_de_public;

    //
    public function __construct($nom, $prenom, $date_d_arriver, $adresse_mail, $date_de_naissance, $adresse_d_habitation, $type_de_public)
    {

        //
        $this->nom_du_locataire = $nom;

        //
        $this->prenom_du_locataire = $prenom;

        //
        $this->date_d_arriver = $date_d_arriver;

        //
        $this->adresse_mail = $adresse_mail;

        //
        $this->date_de_naissance = $date_de_naissance;

        //
        $this->adresse_d_habitation = $adresse_d_habitation;

        //
        $this->type_de_public = $type_de_public;
    }

    //
    public function setNom_du_locataire($nouveau_nom_du_locataire)
    {
        //
        $this->nom_du_locataire = $nouveau_nom_du_locataire;
    }

    //
    public function setPrenom_du_locataire($nouveau_prenom_du_locataire)
    {
        //
        $this->prenom_du_locataire = $nouveau_prenom_du_locataire;
    }

    //
    public function setDate_d_arriver($nouvelle_date_d_arriver)
    {
        //
        $this->date_d_arriver = $nouvelle_date_d_arriver;
    }

    //
    public function setAdresse_mail($nouvelle_adresse_mail)
    {
        //
        $this->adresse_mail = $nouvelle_adresse_mail;
    }

    //
    public function setDate_de_naissance($nouvelle_date_de_naissance)
    {
        //
        $this->date_de_naissance = $nouvelle_date_de_naissance;
    }

    //
    public function setAdresse_d_habitation($nouvelle_adresse_d_habitation)
    {
        //
        $this->adresse_d_habitation = $nouvelle_adresse_d_habitation;
    }

    //
    public function setType_de_public($nouveau_type_de_public)
    {
        //
        $this->type_de_public = $nouveau_type_de_public;
    }

    //
    public function getNom_du_locataire()
    {
        //
        return $this->nom_du_locataire;
    }

    //
    public function getPrenom_du_locataire()
    {
        //
        return $this->prenom_du_locataire;
    }

    //
    public function getDate_d_arriver()
    {
        //
        return $this->date_d_arriver;
    }

    //
    public function getAdresse_mail()
    {
        //
        return $this->adresse_mail;
    }

    //
    public function getDate_de_naissance()
    {
        //
        return $this->date_de_naissance;
    }

    //
    public function getAdresse_d_habitation()
    {
        //
        return $this->adresse_d_habitation;
    }

    //
    public function getType_de_public()
    {
        //
        return $this->type_de_public;
    }

}