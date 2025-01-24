<?php

final class RoleRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(Role $role): Role
    {
        $sql = "INSERT INTO `role` ( id, role) VALUES (  :id,:role)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $role->getId(),
                ':role' => $role->getRole(),
            ]);

            return $this->findById($this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return 0;
        }
    }

    public function findById(int $id): ?Role
    {
        $sql = "SELECT * FROM `role` WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $roleData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $role = RoleMapper::mapToObject($roleData);

        if ($role) {
            return $role;
        } else {
            return null;
        }
    }

    public function findAllExceptAdmin()
    {
        $query = $this->pdo->prepare('SELECT * FROM role WHERE role != :admin');
        $query->execute(['admin' => 'admin']);
        $rolesData = $query->fetchAll();

        $roles = [];
        foreach ($rolesData as $roleData) {
            $roles[] = new Role($roleData['id'], $roleData['role']);
        }

        return $roles;
    }

    public function findByRoleName(string $roleName): ?Role
    {
        $sql = "SELECT * FROM role WHERE role = :role";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':role' => $roleName]);

        $roleData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $roleData ? RoleMapper::mapToObject($roleData) : null;
    }
}
