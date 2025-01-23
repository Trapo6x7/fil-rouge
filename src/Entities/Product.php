<?php

final class Product
{

    private int $id;
    private string $name;
    private int $idAuthor;
    private int $idGenre;
    private int $ISBN;


    public function __construct(int $id, string $name, int $idAuthor, int $idGenre, int $ISBN)
    {
        $this->id = $id;
        $this->name = $name;
        $this->idAuthor = $idAuthor;
        $this->idGenre = $idGenre;
        $this->ISBN = $ISBN;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdAuthor(): string
    {
        return $this->idAuthor;
    }

    public function setIdAuthor($idAuthor): self
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }

    public function getIdGenre(): int
    {
        return $this->idGenre;
    }

    public function setIdGenre($idGenre): self
    {
        $this->idGenre = $idGenre;

        return $this;
    }

    public function getISBN(): int
    {
        return $this->ISBN;
    }

    public function setISBN($ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }
}
