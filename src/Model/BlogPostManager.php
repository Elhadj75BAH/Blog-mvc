<?php

namespace App\Model;

/**
 *
 */
class BlogPostManager extends AbstractManager
{
    public const TABLE = 'Article';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $blogpost
     * @return int
     */
    public function insert(array $blogpost): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`titre`,`contenu`,`chapo`,`date_creation`,`auteur`) VALUES (:titre,:contenu,:chapo,NOW(),:auteur)");
        $statement->bindValue('titre', $blogpost['titre'], \PDO::PARAM_STR);
        $statement->bindValue('contenu', $blogpost['contenu'], \PDO::PARAM_STR);
        $statement->bindValue('chapo', $blogpost['chapo'], \PDO::PARAM_STR);
       // $statement->bindValue('date_creation', $blogpost['date_creation'], \PDO::PARAM_STR);
        $statement->bindValue('auteur', $blogpost['auteur'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


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


    /**
     * @param array $blogpost
     * @return bool
     */
    public function update(array $blogpost): bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `titre` = :titre,`contenu`=:contenu,`chapo` =:chapo, `date_creation`=NOW(), `auteur`=:auteur WHERE id=:id");
        $statement->bindValue('id', $blogpost['id'], \PDO::PARAM_INT);
        $statement->bindValue('titre', $blogpost['titre'], \PDO::PARAM_STR);
        $statement->bindValue('contenu', $blogpost['contenu'], \PDO::PARAM_STR);
        $statement->bindValue('chapo', $blogpost['chapo'], \PDO::PARAM_STR);
      //  $statement->bindValue('date_creation', $blogpost['date_creation'], \PDO::PARAM_STR);
        $statement->bindValue('auteur', $blogpost['auteur'], \PDO::PARAM_STR);

        return $statement->execute();
    }


    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll(\PDO::FETCH_CLASS);
    }


    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(\PDO::PARAM_INT);
    }

}
