<?php



class UserMapper implements MapperContract
{

    public static function mapToObject(array $data): User
    {

        return new User(
            $data['id'],
            $data['firstname'],
            $data['lastname'],
            $data['pseudo'],
            $data['mail'],
            $data['password'],
            (int)$data['id_role'],
            $data['companyAdress'] ?? null,
            $data['companyName'] ?? null
        );
    }
}
