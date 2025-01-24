<?php



class AuthorMapper implements MapperContract
{

    public static function mapToObject(array $data): Author
    {

        return new Author(
            $data['id'],
            $data['author']
        );
    }
}
