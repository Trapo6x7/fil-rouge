<?php

final class OrderMapper implements MapperContract
{
    /**
     * Mappe un tableau de données en un objet Anounce.
     *
     * @param array $data
     * @return Anounce
     */
    public static function mapToObject(array $data): Order
    {
        return new Order(
            (int)$data['id'],
            (int)$data['buyer'],
            (int)$data['seller'],
            (int)$data['id_product'],
            new DateTime($data['purchase_at']),
            (int)$data['id_order_state']
        );
    }
}
