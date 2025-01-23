<?php

final class Genre
{

    private int $id;
    private string $genre;


    public function __construct(int $id, string $genre)
    {
        $this->id = $id;
        $this->genre = $genre;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getGenre() : string
    {
        return $this->genre;
    }

    public function setGenre($genre) : self
    {
        $this->genre = $genre;

        return $this;
    }
}
