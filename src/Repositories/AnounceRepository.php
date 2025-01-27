<?php

final class AnounceRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère une nouvelle annonce dans la base de données.
     *
     * @param Anounce $anounce
     * @return Anounce|null
     */
    public function insert(Anounce $anounce): ?Anounce
    {
        $sql = "INSERT INTO `anounce` (id, id_product, description, price, id_condition, image_url) 
                VALUES (:id, :id_product, :description, :price, :id_condition, :image_url)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $anounce->getId(),
                ':id_product' => $anounce->getIdProduct(),
                ':description' => $anounce->getDescription(),
                ':price' => $anounce->getPrice(),
                ':id_condition' => $anounce->getIdCondition(),
                ':image_url' => $anounce->getImageUrl(),
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve une annonce par son ID.
     *
     * @param int $id
     * @return Anounce|null
     */
    public function findById(int $id): ?Anounce
    {
        $sql = "SELECT * FROM `anounce` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $anounceData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $anounceData ? AnounceMapper::mapToObject($anounceData) : null;
    }

    /**
     * Récupère toutes les annonces.
     *
     * @return Anounce[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `anounce`";

        try {
            $stmt = $this->pdo->query($sql);
            $anouncesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($data) => AnounceMapper::mapToObject($data), $anouncesData);
    }

    /**
     * Met à jour une annonce existante.
     *
     * @param Anounce $anounce
     * @return bool
     */
    public function update(Anounce $anounce): bool
    {
        $sql = "UPDATE `anounce` SET id_product = :id_product, description = :description, 
                price = :price, id_condition = :id_condition, image_url = :image_url WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $anounce->getId(),
                ':id_product' => $anounce->getIdProduct(),
                ':description' => $anounce->getDescription(),
                ':price' => $anounce->getPrice(),
                ':id_condition' => $anounce->getIdCondition(),
                ':image_url' => $anounce->getImageUrl(),
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime une annonce par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `anounce` WHERE id = :id";

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
