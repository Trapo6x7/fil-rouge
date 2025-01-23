<?php

final class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(User $user): User
    {
        $sql = "INSERT INTO user ( id, firstname, lastname,  pseudo,  mail,password, id_role,company_adress, company_name) VALUES (  :id,:firstname,:lastname,:pseudo,:mail,:password,:id_role,:company_adress,:company_name)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $user->getId(),
                ':firstname' => $user->getFirstname(),
                ':lastname' => $user->getLastname(),
                ':pseudo' => $user->getPseudo(),
                ':mail' => $user->getMail(),
                ':password' => $user->getPassword(),
                ':id_role' => $user->getIdRole(),
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
            return UserMapper::mapToObject($userData);
        }

        return null; // Aucun utilisateur trouvé
    } catch (PDOException $error) {
        echo "Erreur lors de la requête : " . $error->getMessage();
        return null;
    }
}

}
