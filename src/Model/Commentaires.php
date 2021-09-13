<?php

namespace App\Model;

class Commentaires
{
    private $id;
    private $contenu;
    private $Date_creation;
    private $status;
    private $article_id;
    private $user_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * @param mixed $article_id
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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