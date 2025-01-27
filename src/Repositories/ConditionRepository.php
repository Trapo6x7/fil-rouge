<?php

final class ConditionRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère une nouvelle condition dans la base de données.
     *
     * @param Condition $condition
     * @return Condition|null
     */
    public function insert(Condition $condition): ?Condition
    {
        $sql = "INSERT INTO `condition` (id, condition) 
                VALUES (:id, :condition)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $condition->getId(),
                ':condition' => $condition->getCondition(),
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve une condition par son ID.
     *
     * @param int $id
     * @return Condition|null
     */
    public function findById(int $id): ?Condition
    {
        $sql = "SELECT * FROM `condition` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $conditionData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $conditionData ? ConditionMapper::mapToObject($conditionData) : null;
    }

    /**
     * Récupère toutes les conditions.
     *
     * @return Condition[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `condition`";

        try {
            $stmt = $this->pdo->query($sql);
            $conditionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($data) => ConditionMapper::mapToObject($data), $conditionsData);
    }

    /**
     * Met à jour une condition existante.
     *
     * @param Condition $condition
     * @return bool
     */
    public function update(Condition $condition): bool
    {
        $sql = "UPDATE `condition` SET condition = :condition WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $condition->getId(),
                ':condition' => $condition->getCondition(),
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime une condition par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `condition` WHERE id = :id";

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
