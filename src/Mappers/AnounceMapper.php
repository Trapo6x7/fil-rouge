<?php

class AnounceMapper implements MapperContract
{
    public static function mapToObject(array $data): Anounce
    {
        return new Anounce(
            $data['id'],
            $data['id_product'],
            $data['description'],
            $data['price'],
            $data['id_condition'],
            $data['image_url']
        );
    }
}