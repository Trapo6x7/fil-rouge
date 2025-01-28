<?php



class ProductMapper implements MapperContract
{

    
    public static function mapToObject(array $data): Product
    {
        $authorRepo = new AuthorRepository;
        $genreRepo = new GenreRepository;
        $author = $authorRepo->findById($data['id_author']); // Récupérer l'auteur
        $genre = $genreRepo->findById($data['id_genre']);    // Récupérer le genre

        return new Product(
            $data['id'],
            $data['name'],
            $author,
            $genre,
            $data['ISBN'],
            $data['image_url'],
        );
    }
}
