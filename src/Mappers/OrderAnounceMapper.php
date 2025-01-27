<?php

final class OrderAnounceMapper
{
    /**
     * Mappe un tableau associatif en objet OrderAnounce.
     *
     * @param array $data
     * @return OrderAnounce
     */
    public static function mapToObject(array $data): OrderAnounce
    {
        return new OrderAnounce(
            (int)$data['id'],
            (int)$data['id_order'],
            (int)$data['id_anounce']
        );
    }

}
