<?php


namespace App\Model;


class UsersManager extends AbstractManager
{

    const TABLE = 'users';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $user): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`nom`, `motdepasse`, `email`,`admin`) 
        VALUES (:nom, :motdepasse, :email, :admin)");
        $statement->bindValue('nom', $user['nom'], \PDO::PARAM_STR);
        $statement->bindValue('motdepasse', $user['motdepasse'], \PDO::PARAM_STR);
        $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
        $statement->bindValue('admin', \PDO::PARAM_BOOL);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    public function checkUserConnection($login)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");

        $statement->bindValue('email', $login['email'], \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        if (!empty($result)) {
            if ($result['motdepasse'] === $login['motdepasse']) {
                return $result;
            } else {
                return "Incorrect password";
            }
        } else {
            return 'User not found';
        }
    }

}