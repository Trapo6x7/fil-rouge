<?php



class ProductMapper implements MapperContract
{

    public static function mapToObject(array $data): Product
    {

        return new Product(
            $data['id'],
            $data['name'],
            $data['author'],
            $data['genre'],
            $data['ISBN'],
            $data['image_url'],
        );
    }
}
