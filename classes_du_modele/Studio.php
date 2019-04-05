<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/03/19
 * Time: 11:31
 */

//
class Studio
{

    //
    private $numero_du_studio;

    //
    private $surface;

    //
    public function __construct($numero_du_studio, $surface)
    {

        //
        $this->numero_du_studio = $numero_du_studio;

        //
        $this->surface = $surface;
    }

    //
    public function getNumero_du_studio()
    {
        //
        return $this->numero_du_studio;
    }

    //
    public function getSurface()
    {
        //
        return $this->surface;
    }

    //
    public function setNumero_du_studio($nouveau_numero_du_studio)
    {
        //
        $this->numero_du_studio = $nouveau_numero_du_studio;
    }

    //
    public function setSurface($nouvelle_surface)
    {
        //
        $this->surface = $nouvelle_surface;
    }
}