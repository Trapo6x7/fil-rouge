<?php

final class OrderRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère une nouvelle commande dans la base de données.
     *
     * @param Order $order
     * @return Order|null
     */
    public function insert(Order $order): ?Order
    {
        $sql = "INSERT INTO `order` (buyer, seller, id_product, purchase_at, id_order_state) 
                VALUES (:buyer, :seller, :id_product, :purchase_at, :id_order_state)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':buyer' => $order->getBuyer(),
                ':seller' => $order->getSeller(),
                ':id_product' => $order->getIdProduct(),
                ':purchase_at' => $order->getPurchaseAt()->format('Y-m-d H:i:s'),
                ':id_order_state' => $order->getIdOrderState()
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve une commande par son ID.
     *
     * @param int $id
     * @return Order|null
     */
    public function findById(int $id): ?Order
    {
        $sql = "SELECT * FROM `order` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $orderData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        return $orderData ? OrderMapper::mapToObject($orderData) : null;
    }

    /**
     * Récupère toutes les commandes.
     *
     * @return Order[]
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM `order`";

        try {
            $stmt = $this->pdo->query($sql);
            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        return array_map(fn($data) => OrderMapper::mapToObject($data), $ordersData);
    }

    /**
     * Met à jour une commande existante.
     *
     * @param Order $order
     * @return bool
     */
    public function update(Order $order): bool
    {
        $sql = "UPDATE `order` 
                SET buyer = :buyer, seller = :seller, id_product = :id_product, 
                    purchase_at = :purchase_at, id_order_state = :id_order_state 
                WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $order->getId(),
                ':buyer' => $order->getBuyer(),
                ':seller' => $order->getSeller(),
                ':id_product' => $order->getIdProduct(),
                ':purchase_at' => $order->getPurchaseAt()->format('Y-m-d H:i:s'),
                ':id_order_state' => $order->getIdOrderState()
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime une commande par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `order` WHERE id = :id";

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
