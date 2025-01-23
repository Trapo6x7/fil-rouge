<?php

final class User 
{

    private int $id;
    private string $firstname;
    private string $lastname;
    private string $pseudo;
    private string $mail;
    private string $password;
    private int $idRole;
    private ?string $companyAdress;
    private ?string $companyName;

    public function __construct(int $id, string $firstname, string $lastname, string $mail, string $password, int $idRole, ?string $companyAdress, ?string $companyName)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->mail = $mail;
        $this->password = $password;
        $this->idRole = $idRole;
        $this->companyAdress = $companyAdress;
        $this->companyName = $companyName;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setFirstname($firstname) : self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function setLastname($lastname) :self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPseudo() : string
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) : self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMail() : string
    {
        return $this->mail;
    }
 
    public function setMail($mail) : self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword($password) : self
    {
        $this->password = $password;

        return $this;
    }

    public function getIdRole() : int
    {
        return $this->idRole;
    }

    public function setIdRole($idRole) : self
    {
        $this->idRole = $idRole;

        return $this;
    }

    public function getCompanyAdress() : string
    {
        return $this->companyAdress;
    }

    public function setCompanyAdress($companyAdress) : self
    {
        $this->companyAdress = $companyAdress;

        return $this;
    }

    public function getCompanyName() : string
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName) : self
    {
        $this->companyName = $companyName;

        return $this;
    }
}