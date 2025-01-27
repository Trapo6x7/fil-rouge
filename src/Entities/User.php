<?php

final class User
{

    private int $id;
    private string $firstname;
    private string $lastname;
    private string $pseudo;
    private string $mail;
    private string $password;
    private Role $role;
    private ?string $companyAdress;
    private ?string $companyName;

    public function __construct(int $id, string $firstname, string $pseudo, string $lastname, string $mail, string $password, Role $role, ?string $companyAdress, ?string $companyName)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->role = $role;
        $this->companyAdress = $companyAdress;
        $this->companyName = $companyName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname($firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname($lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail($mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setIdRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCompanyAdress(): string
    {
        return $this->companyAdress;
    }

    public function setCompanyAdress($companyAdress): self
    {
        $this->companyAdress = $companyAdress;

        return $this;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }
}
