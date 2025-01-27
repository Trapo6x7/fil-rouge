<?php

final class ProductRepository extends AbstractRepository
{

    private AuthorRepository $authorRepo;
    private GenreRepository $genreRepo;

    public function __construct()
    {
        parent::__construct();
        $this->authorRepo = new AuthorRepository();
        $this->genreRepo = new GenreRepository();
    }

    /**
     * Insère un nouveau produit dans la base de données.
     *
     * @param Product $product
     * @return Product|null
     */
    public function insert(Product $product): ?Product
    {
        $sql = "INSERT INTO `product` (id, name, id_author, id_genre, ISBN, image_url) VALUES (:id, :name, :idAuthor, :idGenre, :ISBN, :image_url)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $product->getId(),
                ':name' => $product->getName(),
                ':idAuthor' => $product->getAuthor()->getId(),
                ':idGenre' => $product->getGenre()->getId(),
                ':ISBN' => $product->getISBN(),
                ':image_url' => $product->getImageUrl(), // Ajout de l'URL de l'image
            ]);

            return $this->findById((int)$this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return null;
        }
    }

    /**
     * Trouve un produit par son ID.
     *
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        $sql = "SELECT * FROM `product` WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return null;
        }

        if(!$productData){
            return null;
        }

        $productData['author'] = $this->authorRepo->findById($productData['id_author']);
        $productData['genre'] = $this->genreRepo->findById($productData['id_genre']);


        return ProductMapper::mapToObject($productData);
    }

    /**
     * Récupère tous les produits.
     *
     * @return Product[]
     */
    public function findAll(): ?array
    {
        $sql = "SELECT * FROM `product`";

        try {
            $stmt = $this->pdo->query($sql);
            $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la requête : " . $e->getMessage();
            return [];
        }

        $products = [];

        foreach($productsData as $productData){
            $products[] = ProductMapper::mapToObject($productData);
        }

        return $products;
    }

    /**
     * Met à jour un produit existant.
     *
     * @param Product $product
     * @return bool
     */
    public function update(Product $product): bool
    {
        $sql = "UPDATE `product` SET name = :name, id_author = :idAuthor, id_genre = :idGenre, ISBN = :ISBN, image_url = :image_url WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $product->getId(),
                ':name' => $product->getName(),
                ':idAuthor' => $product->getAuthor()->getId(),
                ':idGenre' => $product->getGenre()->getId(),
                ':ISBN' => $product->getISBN(),
                ':image_url' => $product->getImageUrl(), // Mise à jour de l'URL de l'image
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime un produit par son ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `product` WHERE id = :id";

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
