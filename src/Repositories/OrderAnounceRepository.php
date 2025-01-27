<?php

final class OrderAnounceRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Trouve une relation commande-annonce par son ID.
     *
     * @param int $id
     * @return OrderAnounce|null
     */
    public function findById(int $id): ?OrderAnounce
    {
        $sql = "SELECT * FROM `order_anounce` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $data ? OrderAnounceMapper::mapToObject($data) : null;
    }

    /**
     * Récupère toutes les relations commande-annonce.
     *
     * @return OrderAnounce[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `order_anounce`";

        try {
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($row) => OrderAnounceMapper::mapToObject($row), $data);
    }

    /**
     * Insère une nouvelle relation commande-annonce.
     *
     * @param OrderAnounce $orderAnounce
     * @return OrderAnounce|null
     */
    public function insert(OrderAnounce $orderAnounce): ?OrderAnounce
    {
        $sql = "INSERT INTO `order_anounce` (id_order, id_anounce) VALUES (:id_order, :id_anounce)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_order' => $orderAnounce->getIdOrder(),
                ':id_anounce' => $orderAnounce->getIdAnounce()
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Met à jour une relation commande-annonce existante.
     *
     * @param OrderAnounce $orderAnounce
     * @return bool
     */
    public function update(OrderAnounce $orderAnounce): bool
    {
        $sql = "UPDATE `order_anounce` SET id_order = :id_order, id_anounce = :id_anounce WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $orderAnounce->getId(),
                ':id_order' => $orderAnounce->getIdOrder(),
                ':id_anounce' => $orderAnounce->getIdAnounce()
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime une relation commande-annonce par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `order_anounce` WHERE id = :id";

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
