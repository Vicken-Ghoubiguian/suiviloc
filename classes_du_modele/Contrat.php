<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/03/19
 * Time: 11:30
 */

class Contrat
{

    //
    private $libelle_du_type_de_contrat;

    //
    private $date_de_debut;

    //
    private $date_de_fin;

    //
    private $montant_du_loyer;

    //
    private $encaissement_du_depot_de_garantie;

    //
    private $inclusion_EDF;

    //
    private $inclusion_eau;

    //
    private $inclusion_internet;

    //
    private $inclusion_assurance_locative;

    //
    private $inclusion_charges_immeuble;

    //
    public function __construct($libelle_du_type_de_contrat, $date_de_debut, $date_de_fin, $montant_du_loyer, $encaissement_du_depot_de_garantie, $encaissement_du_depot_de_garantie, $inclusion_EDF, $inclusion_eau, $inclusion_internet, $inclusion_assurance_locative, $inclusion_charges_immeuble)
    {

        //
        $this->libelle_du_type_de_contrat = $libelle_du_type_de_contrat;

        //
        $this->date_de_debut = $date_de_debut;

        //
        $this->date_de_fin = $date_de_fin;

        //
        $this->montant_du_loyer = $montant_du_loyer;

        //
        $this->encaissement_du_depot_de_garantie = $encaissement_du_depot_de_garantie;

        //
        $this->inclusion_EDF = $inclusion_EDF;

        //
        $this->inclusion_eau = $inclusion_eau;

        //
        $this->inclusion_internet = $inclusion_internet;

        //
        $this->inclusion_assurance_locative = $inclusion_assurance_locative;

        //
        $this->inclusion_charges_immeuble = $inclusion_charges_immeuble;
    }

    //
    public function getLibelle_du_type_de_contrat()
    {
        //
        return $this->libelle_du_type_de_contrat;
    }

    //
    public function getDate_de_debut()
    {
        //
        return $this->date_de_debut;
    }

    //
    public function getDate_de_fin()
    {
        //
        return $this->date_de_fin;
    }

    //
    public function getMontant_du_loyer()
    {
        //
        return $this->montant_du_loyer;
    }

    //
    public function getEncaissement_du_depot_de_garantie()
    {
        //
        return $this->encaissement_du_depot_de_garantie;
    }

    //
    public function getInclusion_EDF()
    {
        //
        return $this->inclusion_EDF;
    }

    //
    public function getInclusion_eau()
    {
        //
        return $this->inclusion_eau;
    }

    //
    public function getInclusion_internet()
    {
        //
        return $this->inclusion_internet;
    }

    //
    public function getInclusion_assurance_locative()
    {
        //
        return $this->inclusion_assurance_locative;
    }

    //
    public function getInclusion_charges_immeuble()
    {
        //
        return $this->inclusion_charges_immeuble;
    }

    //
    public function setLibelle_du_type_de_contrat($nouveau_libelle_du_type_de_contrat)
    {
        //
        $this->libelle_du_type_de_contrat = $nouveau_libelle_du_type_de_contrat;
    }

    //
    public function setDate_de_debut($nouvelle_date_de_debut)
    {
        //
        $this->date_de_debut = $nouvelle_date_de_debut;
    }

    //
    public function setDate_de_fin($nouvelle_date_de_fin)
    {
        //
        $this->date_de_fin = $nouvelle_date_de_fin;
    }

    //
    public function setMontant_du_loyer($nouveau_montant_du_loyer)
    {
        //
        $this->montant_du_loyer = $nouveau_montant_du_loyer;
    }

    //
    public function setEncaissement_du_depot_de_garantie($encaissement_du_depot_de_garantie)
    {
        //
        $this->encaissement_du_depot_de_garantie = $encaissement_du_depot_de_garantie;
    }

    //
    public function setInclusion_EDF($inclusion_EDF)
    {
        //
        $this->inclusion_EDF = $inclusion_EDF;
    }

    //
    public function setInclusion_eau($inclusion_eau)
    {
        //
        $this->inclusion_eau = $inclusion_eau;
    }

    //
    public function setInclusion_internet($inclusion_internet)
    {
        //
        $this->inclusion_internet = $inclusion_internet;
    }

    //
    public function setInclusion_assurance_locative($inclusion_assurance_locative)
    {
        //
        $this->inclusion_assurance_locative = $inclusion_assurance_locative;
    }

    //
    public function setInclusion_charges_immeuble($inclusion_charges_immeuble)
    {
        //
        $this->inclusion_charges_immeuble = $inclusion_charges_immeuble;
    }
}