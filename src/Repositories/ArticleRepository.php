<?php

final class ArticleRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère un nouvel article dans la base de données.
     *
     * @param Article $article
     * @return Article|null
     */
    public function insert(Article $article): ?Article
    {
        $sql = "INSERT INTO `article` (id, name, body, image_url) VALUES (:id, :name, :body, :imageUrl)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $article->getId(),
                ':name' => $article->getName(),
                ':body' => $article->getBody(),
                ':imageUrl' => $article->getImageUrl(),
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve un article par son ID.
     *
     * @param int $id
     * @return Article|null
     */
    public function findById(int $id): ?Article
    {
        $sql = "SELECT * FROM `article` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $articleData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $articleData ? ArticleMapper::mapToObject($articleData) : null;
    }

    /**
     * Récupère tous les articles.
     *
     * @return Article[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `article`";

        try {
            $stmt = $this->pdo->query($sql);
            $articlesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($data) => ArticleMapper::mapToObject($data), $articlesData);
    }

    /**
     * Met à jour un article existant.
     *
     * @param Article $article
     * @return bool
     */
    public function update(Article $article): bool
    {
        $sql = "UPDATE `article` SET name = :name, body = :body, image_url = :imageUrl WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $article->getId(),
                ':name' => $article->getName(),
                ':body' => $article->getBody(),
                ':imageUrl' => $article->getImageUrl(),
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime un article par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `article` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
        }
    }
}
