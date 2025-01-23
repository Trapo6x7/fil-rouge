<?php



class RoleMapper implements MapperContract
{

    public static function mapToObject(array $data): Role
    {
        return new Role(
            $data['id'],
            $data['role'],
        );
    }
}
