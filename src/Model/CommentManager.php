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
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`contenu`,`date_creation`, `status`,`article_id`,`user_id`) VALUES (:contenu, NOW(),  :status, :article_id, :user_id)");
        $statement->bindValue('contenu', $comment['contenu'], \PDO::PARAM_STR);
        $statement->bindValue('status', 0,\PDO::PARAM_BOOL);
        $statement->bindValue('article_id',$comment['article_id'],\PDO::PARAM_STR);
        $statement->bindValue('user_id', intval($comment['user_id']), \PDO::PARAM_INT);
        // ici fin
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

//get comments
    public function getComments(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE article_id=:id AND status=0 ORDER BY id DESC");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
//



    /**
     * @param array $comment
     * @return bool
     */
    public function update(array $comment):bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `contenu` = :contenu,`date_creation` = :date_creation, `status` = :status  WHERE id=:id");
        $statement->bindValue('id', $comment['id'], \PDO::PARAM_INT);
        $statement->bindValue('contenu', $comment['contenu'], \PDO::PARAM_STR);
        $statement->bindValue('status', 0,\PDO::PARAM_BOOL);
        $statement->bindValue('article_id',$comment['article_id'],\PDO::PARAM_STR);
        $statement->bindValue('user_id', intval($comment['user_id']), \PDO::PARAM_INT);

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

}