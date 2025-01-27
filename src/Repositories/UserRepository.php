<?php

final class UserRepository extends AbstractRepository
{
    private RoleRepository $roleRepo;

    public function __construct()
    {
        parent::__construct();
        $this->roleRepo = new RoleRepository();
    }

    public function insert(User $user): User
    {
        $sql = "INSERT INTO user ( id, firstname, lastname,  pseudo,  mail,password, id_role, company_adress, company_name) VALUES (  :id, :firstname, :lastname, :pseudo, :mail, :password, :id_role, :company_adress, :company_name)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $user->getId(),
                ':firstname' => $user->getFirstname(),
                ':lastname' => $user->getLastname(),
                ':pseudo' => $user->getPseudo(),
                ':mail' => $user->getMail(),
                ':password' => $user->getPassword(),
                ':id_role' => $user->getRole()->getId(),
                ':company_adress' => $user->getCompanyAdress(),
                ':company_name' => $user->getCompanyName(),
            ]);

            return $this->findById($this->pdo->lastInsertId());
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return 0;
        }
    }

    public function findById(int $id): ?User
    {
        $sql = "SELECT * FROM `user` WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $userData['role'] = $this->roleRepo->findById($userData['id_role']);

        $user = UserMapper::mapToObject($userData);

        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function findByMail(string $mail): ?User
    {
        $sql = "SELECT * FROM `user` WHERE mail = :mail";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":mail" => $mail
            ]);

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                $userData['role'] = $this->roleRepo->findById($userData['id_role']);
                return UserMapper::mapToObject($userData);
            }

            return null; // Aucun utilisateur trouvé
        } catch (PDOException $error) {
            echo "Erreur lors de la requête : " . $error->getMessage();
            return null;
        }
    }

    public function update(User $user): User
    {
        $sql = "
        UPDATE user 
        SET firstname = :firstname, lastname = :lastname, pseudo = :pseudo,  mail = :mail,  password = :password,  id_role = :id_role,  company_adress = :company_adress,  company_name = :company_name WHERE id = :id
    ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $user->getId(),
                ':firstname' => $user->getFirstname(),
                ':lastname' => $user->getLastname(),
                ':pseudo' => $user->getPseudo(),
                ':mail' => $user->getMail(),
                ':password' => $user->getPassword(),
                ':id_role' => $user->getRole()->getId(),
                ':company_adress' => $user->getCompanyAdress(),
                ':company_name' => $user->getCompanyName(),
            ]);

            return $user;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    public function updateSeller(User $user): User
    {
        $sql = "
        UPDATE user 
        SET firstname = :firstname, lastname = :lastname, pseudo = :pseudo,  mail = :mail,  password = :password,  id_role = :id_role,  company_adress = :company_adress,  company_name = :company_name WHERE id = :id
    ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $user->getId(),
                ':firstname' => $user->getFirstname(),
                ':lastname' => $user->getLastname(),
                ':pseudo' => $user->getPseudo(),
                ':mail' => $user->getMail(),
                ':password' => $user->getPassword(),
                ':id_role' => $user->getRole()->getId(),
                ':company_adress' => $user->getCompanyAdress(),
                ':company_name' => $user->getCompanyName(),
            ]);

            return $user;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }
}
