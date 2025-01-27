<?php

final class Product
{

    private int $id;
    private string $name;
    private Author $author;
    private Genre $genre;
    private int $ISBN;
    private string $imageUrl;


    public function __construct(int $id, string $name, Author $author, Genre $genre, int $ISBN, string $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->genre = $genre;
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

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): self
    {
        $this->genre = $genre;

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
