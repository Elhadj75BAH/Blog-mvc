<?php


namespace App\Model;


use _HumbugBox5ccdb2ccdb35\phpDocumentor\Reflection\DocBlock\Tags\Param;

class UsersManager extends AbstractManager
{

    const TABLE = 'Utilisateurs';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $user): int
    {
        //HACHAGE DU MOT DE PASS
        $motdepasse = password_hash($_POST['motdepasse'],PASSWORD_DEFAULT);

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`nom`, `prenom`,`motdepasse`, `email`,`admin`) 
        VALUES (:nom, :prenom,:motdepasse, :email, :admin)");
        $statement->bindValue('nom', $user['nom'], \PDO::PARAM_STR);
        $statement->bindValue('prenom', $user['prenom'], \PDO::PARAM_STR);
        $statement->bindValue('motdepasse',$motdepasse,  \PDO::PARAM_STR);// hachage de du mot de passe
        $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
        $statement->bindValue('admin', \PDO::PARAM_BOOL);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }

    }


    public function checkUserConnection($login)
    {
        $statement = $this->pdo->prepare("SELECT * FROM Utilisateurs WHERE email=:email");

        $statement->bindValue('email', $login['email'], \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
}