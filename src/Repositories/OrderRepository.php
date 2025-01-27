<?php

final class OrderRepository extends AbstractRepository
{
    private UserRepository $userRepo;
    private ProductRepository $productRepo;
    private OrderStateRepository $orderStateRepo;

    public function __construct()
    {
        parent::__construct();
        $this->productRepo = new ProductRepository();
        $this->userRepo = new UserRepository();
        $this->orderStateRepo = new OrderStateRepository();
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
                ':buyer' => $order->getBuyer()->getId(),
                ':seller' => $order->getSeller()->getId(),
                ':id_product' => $order->getProduct()->getId(),
                ':purchase_at' => $order->getPurchaseAt()->format('Y-m-d H:i:s'),
                ':id_order_state' => $order->getOrderState()->getId()
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

        if (!$orderData) {
            return null;
        }

        $orderData['buyer'] = $this->userRepo->findById($orderData['buyer']);
        $orderData['seller'] = $this->userRepo->findById($orderData['seller']);
        $orderData['product'] = $this->productRepo->findById($orderData['id_product']);
        $orderData['orderState'] = $this->orderStateRepo->findById($orderData['id_order_state']);

        return OrderMapper::mapToObject($orderData);
    }

    /**
     * Récupère toutes les commandes.
     *
     * @return Order[]|null
     */
    public function findAll(): ?array
    {
        $sql = "SELECT * FROM `order`";

        try {
            $stmt = $this->pdo->query($sql);
            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        $orders['buyer'] = $this->userRepo->findById($ordersData['buyer']);
        $orders['seller'] = $this->userRepo->findById($ordersData['seller']);
        $orders['product'] = $this->productRepo->findById($ordersData['id_product']);
        $orders['orderState'] = $this->orderStateRepo->findById($ordersData['id_order_state']);
        $orders = [];
        foreach ($ordersData as $data) {
            $orders[] = OrderMapper::mapToObject($data);
        }

        return $orders;
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
                ':id_product' => $order->getProduct()->getId(),
                ':purchase_at' => $order->getPurchaseAt()->format('Y-m-d H:i:s'),
                ':id_order_state' => $order->getOrderState()->getId()
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

    /**
     * Trouve les commandes par l'ID de l'acheteur.
     *
     * @param int $buyerId
     * @return Order[]|null
     */
    public function findAllByUserId(int $buyerId): ?array
    {
        $sql = "SELECT * FROM `order` WHERE buyer = :buyer";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':buyer' => $buyerId]);
            $orderDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }


        $orders = [];

        foreach ($orderDatas as $orderData) {
            $orderData['buyer'] = $this->userRepo->findById($orderData['buyer']);
            $orderData['seller'] = $this->userRepo->findById($orderData['seller']);
            $orderData['orderState'] = $this->orderStateRepo->findById($orderData['id_order_state']);
            $orderData['product'] = $this->productRepo->findById($orderData['id_product']);

            unset($orderData['id_product']);
            unset($orderData['id_order_state']);



            $orders[] = OrderMapper::mapToObject($orderData);

        }

        return $orders;
    }

    /**
     * Trouve les commandes par l'ID du vendeur.
     *
     * @param int $sellerId
     * @return Order[]|null
     */
    public function findBySellerId(int $sellerId): ?array
    {
        $sql = "SELECT * FROM `order` WHERE seller = :seller";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':seller' => $sellerId]);
            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        $orders = [];
        foreach ($ordersData as $data) {
            $orders[] = OrderMapper::mapToObject($data);
        }

        return $orders;
    }

    /**
     * Trouve les commandes par l'ID de l'annonce.
     *
     * @param int $anounceId
     * @return Order[]|null
     */
    public function findOrdersByAnounceId(int $anounceId): ?array
    {
        $sql = "SELECT o.* 
            FROM `order` o
            INNER JOIN `order_anounce` oa ON o.id = oa.id_order
            WHERE oa.id_anounce = :id_anounce";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id_anounce' => $anounceId]);
            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        $orders = [];
        foreach ($ordersData as $data) {
            $orders[] = OrderMapper::mapToObject($data);
        }

        return $orders;
    }
}
