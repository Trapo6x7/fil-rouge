<?php

class OrderMapper implements MapperContract
{
    public static function mapToObject(array $data): Order
    {
        // var_dump($data);
        // die();
        return new Order(
            $data['id'],
            $data['buyer'],
            $data['seller'],
            new DateTime($data['purchaseAt']),
            $data['orderState'],
            $data['product'],
        );
    }
}
