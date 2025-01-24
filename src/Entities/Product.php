<?php

final class Product
{

    private int $id;
    private string $name;
    private int $idAuthor;
    private int $idGenre;
    private int $ISBN;
    private string $imageUrl;


    public function __construct(int $id, string $name, int $idAuthor, int $idGenre, int $ISBN, string $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->idAuthor = $idAuthor;
        $this->idGenre = $idGenre;
        $this->ISBN = $ISBN;
        $this->imageUrl = $imageUrl;
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

    public function getIdAuthor(): int
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

    /**
     * Get the value of imageUrl
     */ 
    public function getImageUrl() : string
    {
        return $this->imageUrl;
    }

    /**
     * Set the value of imageUrl
     *
     * @return  self
     */ 
    public function setImageUrl($imageUrl) : self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
