<?php



class ProductMapper implements MapperContract
{

    public static function mapToObject(array $data): Product
    {

        return new Product(
            $data['id'],
            $data['name'],
            $data['id_author'],
            $data['id_genre'],
            $data['ISBN'],
            $data['image_url'],
        );
    }
}
