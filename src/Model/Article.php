<?php

namespace App\Model;

class Article
{
    private $ID;
    private $Titre;
    private $Contenu;
    private $Chapo;
    private $Date_creation;
    private $Auteur;


    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->Titre;
    }

    /**
     * @param mixed $Titre
     */
    public function setTitre($Titre)
    {
        $this->Titre = $Titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->Contenu;
    }

    /**
     * @param mixed $Contenu
     */
    public function setContenu($Contenu)
    {
        $this->Contenu = $Contenu;
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        return $this->Chapo;
    }

    /**
     * @param mixed $Chapo
     */
    public function setChapo($Chapo)
    {
        $this->Chapo = $Chapo;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->Date_creation;
    }

    /**
     * @param mixed $Date_creation
     */
    public function setDateCreation($Date_creation)
    {
        $this->Date_creation = $Date_creation;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->Auteur;
    }

    /**
     * @param mixed $Auteur
     */
    public function setAuteur($Auteur)
    {
        $this->Auteur = $Auteur;
    }

    //function hydrate
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key =>$value){
            // on récupère le nom du setter correspond à l'attribut
            $method = 'set'.ucfirst($key);
            
            // si le setter correspondant existe
            if (method_exists($this,$method)){
                // on appel le setter.
                $this->$method($value);
            }
        }
        return $this;
    }
    // End function hydrate
}