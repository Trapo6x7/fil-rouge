<?php



class GenreMapper implements MapperContract
{

    public static function mapToObject(array $data): Genre
    {

        return new Genre(
            $data['id'],
            $data['genre']
        );
    }
}
