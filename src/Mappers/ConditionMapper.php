<?php

class ConditionMapper implements MapperContract
{
    public static function mapToObject(array $data): Condition
    {
        return new Condition(
            $data['id'],
            $data['condition']
        );
    }

}