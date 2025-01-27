<?php

final class OrderStateMapper implements MapperContract
{
    /**
     * Mappe un tableau associatif en objet OrderState.
     *
     * @param array $data
     * @return OrderState
     */
    public static function mapToObject(array $data): OrderState
    {
        return new OrderState(
            (int)$data['id'],
            $data['state']
        );
    }

}
