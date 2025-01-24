<?php

final class AuthorRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère un nouvel auteur dans la base de données.
     *
     * @param Author $author
     * @return Author|null
     */
    public function insert(Author $author): ?Author
    {
        $sql = "INSERT INTO `author` (id, author) VALUES (:id, :author)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $author->getId(),
                ':author' => $author->getAuthor(),
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve un auteur par son ID.
     *
     * @param int $id
     * @return Author|null
     */
    public function findById(int $id): ?Author
    {
        $sql = "SELECT * FROM `author` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $authorData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $authorData ? AuthorMapper::mapToObject($authorData) : null;
    }

    /**
     * Récupère tous les auteurs sauf un auteur spécifique (par exemple, un admin).
     *
     * @param string $excludedAuthor
     * @return Author[]
     */
    public function findAllExcept(string $excludedAuthor): array
    {
        $sql = "SELECT * FROM `author` WHERE author != :excludedAuthor";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':excludedAuthor' => $excludedAuthor]);
            $authorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($data) => AuthorMapper::mapToObject($data), $authorsData);
    }

    /**
     * Trouve un auteur par son nom.
     *
     * @param string $authorName
     * @return Author|null
     */
    public function findByAuthorName(string $authorName): ?Author
    {
        $sql = "SELECT * FROM `author` WHERE author = :author";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':author' => $authorName]);
            $authorData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $authorData ? AuthorMapper::mapToObject($authorData) : null;
    }
}
