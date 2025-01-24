<?php

final class GenreRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère un nouveau genre dans la base de données.
     *
     * @param Genre $genre
     * @return Genre|null
     */
    public function insert(Genre $genre): ?Genre
    {
        $sql = "INSERT INTO `genre` (id, genre) VALUES (:id, :genre)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $genre->getId(),
                ':genre' => $genre->getGenre(),
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve un genre par son ID.
     *
     * @param int $id
     * @return Genre|null
     */
    public function findById(int $id): ?Genre
    {
        $sql = "SELECT * FROM `genre` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $genreData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $genreData ? GenreMapper::mapToObject($genreData) : null;
    }

    /**
     * Récupère tous les genres.
     *
     * @return Genre[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `genre`";

        try {
            $stmt = $this->pdo->query($sql);
            $genresData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($data) => GenreMapper::mapToObject($data), $genresData);
    }

    /**
     * Met à jour un genre existant.
     *
     * @param Genre $genre
     * @return bool
     */
    public function update(Genre $genre): bool
    {
        $sql = "UPDATE `genre` SET genre = :genre WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $genre->getId(),
                ':genre' => $genre->getGenre(),
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime un genre par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `genre` WHERE id = :id";

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
