<?php

final class OrderStateRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Trouve un état de commande par son ID.
     *
     * @param int $id
     * @return OrderState|null
     */
    public function findById(int $id): ?OrderState
    {
        $sql = "SELECT * FROM `orderstate` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $data ? OrderStateMapper::mapToObject($data) : null;
    }

    /**
     * Récupère tous les états de commande.
     *
     * @return OrderState[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `orderstate`";

        try {
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($row) => OrderStateMapper::mapToObject($row), $data);
    }

    /**
     * Insère un nouvel état de commande dans la base de données.
     *
     * @param OrderState $orderState
     * @return OrderState|null
     */
    public function insert(OrderState $orderState): ?OrderState
    {
        $sql = "INSERT INTO `orderstate` (state) VALUES (:state)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':state' => $orderState->getState()
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Met à jour un état de commande existant.
     *
     * @param OrderState $orderState
     * @return bool
     */
    public function update(OrderState $orderState): bool
    {
        $sql = "UPDATE `orderstate` SET state = :state WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $orderState->getId(),
                ':state' => $orderState->getState()
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime un état de commande par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `orderstate` WHERE id = :id";

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
