<?php

namespace App\Model;

/**
 *
 */

class CommentManager extends AbstractManager
{
    const TABLE = 'Commentaires';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $comment
     * @return int
     */
    public function insertComment(array $comment): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`contenu`,`date_creation`, `statut`,`article_id`,`utilisateur_id`) VALUES (:contenu, NOW(),  :statut, :article_id, :utilisateur_id)");
        $statement->bindValue('contenu', $comment['contenu'], \PDO::PARAM_STR);
        $statement->bindValue('statut', 0, \PDO::PARAM_BOOL);
        $statement->bindValue('article_id', $comment['article_id'], \PDO::PARAM_STR);
        $statement->bindValue('utilisateur_id', intval($comment['utilisateur_id']), \PDO::PARAM_INT);
        // ici fin
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

//get comments
    public function getComments(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM  " . static::TABLE . " WHERE article_id=:id   AND statut=1 ORDER BY id DESC");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
//

// inner join

    public function getCommentsUser(int $id)
    {
        $statement = $this->pdo->prepare("SELECT Utilisateurs.nom,Utilisateurs.prenom, Commentaires.contenu, Commentaires.Date_creation 
                                                FROM Utilisateurs 
                                                INNER JOIN Commentaires
                                                ON Commentaires.utilisateur_id = Utilisateurs.id  WHERE article_id=:id  AND statut=1 ORDER BY Commentaires.id DESC ");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    // join BlogPost

    /**
     * @param int $id
     * @return array
     */
    public function getBlogpostComment()
    {
        $statement = $this->pdo->prepare("SELECT Article.Titre,Commentaires.id, Commentaires.contenu, Commentaires.statut, Utilisateurs.email
                                                FROM Commentaires
                                                INNER JOIN Article
                                                ON Commentaires.article_id=Article.ID
                                                INNER JOIN Utilisateurs
                                                ON Commentaires.utilisateur_id=Utilisateurs.id ORDER BY Commentaires.id DESC ");
       // $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS,Commentaires::class);
    }
//ici dans Mennu Commentaires backend
    //

    /**
     * @param array $comment
     * @return bool
     */
    public function update(array $comment): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `contenu` = :contenu,`date_creation` = :date_creation, `statut` = :statut  WHERE id=:id");
        $statement->bindValue('id', $comment['id'], \PDO::PARAM_INT);
        $statement->bindValue('contenu', $comment['contenu'], \PDO::PARAM_STR);
        $statement->bindValue('statut', 0, \PDO::PARAM_BOOL);
        $statement->bindValue('article_id', $comment['article_id'], \PDO::PARAM_STR);
        $statement->bindValue('utilisateur_id', intval($comment['utilisateur_id']), \PDO::PARAM_INT);

        return $statement->execute();
    }

    // DELETE
    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    // validate a comment
    /**
     * @param int $id
     */
    public function validstatus($id)
    {
      //  $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET  `statut`=1  WHERE id=:id");
        $statement = $this->pdo->prepare("UPDATE Commentaires SET statut=1 WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }
    //fin

    /**
     * @param $id
     * @return bool
     */
    //  Deactivate a comment
    public function desactiveComments($id)
    {
        $statement = $this->pdo->prepare("UPDATE Commentaires SET statut=0 WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }
}
