<?php



class ArticleMapper implements MapperContract
{

    public static function mapToObject(array $data): Article
    {

        return new Article(
            $data['id'],
            $data['name'],
            $data['body'],
            $data['image_url'],
        );
    }
}
